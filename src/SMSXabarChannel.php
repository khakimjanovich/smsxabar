<?php

declare(strict_types=1);

namespace Khakimjanovich\SMSXabar;

use Illuminate\Http\Client\ConnectionException;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Http;
use Khakimjanovich\SMSXabar\Exceptions\SMSXabarException;

final class SMSXabarChannel
{
    /**
     * @throws SMSXabarException
     */
    public function send($notifiable, Notification $notification): void
    {
        if (! method_exists($notification, 'toSmsXabar')) {
            return;
        }

        /** @var SmsXabarMessage $message */
        $message = $notification->toSmsXabar($notifiable);

        $payload = [
            'messages' => [
                'recipient' => $message->recipient,
                'message-id' => $message->message_id,
                'sms' => [
                    'originator' => $message->originator,
                    'content' => [
                        'text' => $message->content,
                    ],
                ],
            ],
        ];

        try {
            Http::withBasicAuth(config('smsxabar.username'), config('smsxabar.password'))
                ->contentType('application/json')
                ->timeout(10)
                ->connectTimeout(10)
                ->post(config('smsxabar.endpoint'), $payload);
        } catch (ConnectionException $e) {
            throw SMSXabarException::connectionException($e);
        }
    }
}
