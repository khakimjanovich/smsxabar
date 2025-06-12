<?php

declare(strict_types=1);

use Illuminate\Notifications\Notifiable;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Http;
use Khakimjanovich\SMSXabar\SMSXabarChannel;
use Khakimjanovich\SMSXabar\SMSXabarMessage;

it('sends SMS via SmsXabarChannel', function () {
    Http::fake([
        'https://fake-smsxabar.test/send' => Http::response('Request is received', 200),
    ]);

    $notifiable = new class
    {
        use Notifiable;

        public function routeNotificationForSmsXabar(): string
        {
            return '998933843338';
        }
    };

    $notification = new class extends Notification
    {
        public function via($notifiable): array
        {
            return [SMSXabarChannel::class];
        }

        public function toSmsXabar($notifiable): SMSXabarMessage
        {
            return SMSXabarMessage::create($notifiable->routeNotificationForSmsXabar(), 'Test message');
        }
    };

    $notifiable->notify($notification);

    Http::assertSent(function ($request) {
        return $request->url() === 'https://fake-smsxabar.test/send'
            && $request->hasHeader('Authorization')
            && $request['messages']['recipient'] === '998933843338'
            && $request['messages']['sms']['content']['text'] === 'Test message';
    });
});
