<?php

namespace Khakimjanovich\SMSXabar;

use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Http;

class SMSXabarChannel
{
    public function send($notifiable, Notification $notification)
    {
        if (! method_exists($notification, 'toSmsXabar')) {
            return;
        }

        /** @var SmsXabarMessage $message */
        $message = $notification->toSmsXabar($notifiable);

        $payload = [
            'messages' => [
                'recipient' => $message->recipient,
                'message-id' => $message->messageId,
                'sms' => [
                    'originator' => $message->originator,
                    'content' => [
                        'text' => $message->content,
                    ],
                ],
            ],
        ];

        Http::withBasicAuth(config('smsxabar.username'), config('smsxabar.password'))
            ->post(config('smsxabar.endpoint'), $payload);
    }
}
