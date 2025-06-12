<?php

declare(strict_types=1);

use Illuminate\Support\Str;
use Khakimjanovich\SMSXabar\SmsXabarMessage;

it('creates a message with recipient and content', function () {
    $recipient = '998909998760';
    $text = 'Test SMS content';

    $message = SmsXabarMessage::create($recipient, $text);

    expect($message)->toBeInstanceOf(SmsXabarMessage::class)
        ->and($message->recipient)->toBe($recipient)
        ->and($message->content)->toBe($text)
        ->and(Str::isUuid($message->message_id))->toBeTrue()
        ->and($message->originator)->toBe('3700'); // default originator
});

it('allows setting a custom originator', function () {
    $message = SmsXabarMessage::create('998909998760', 'Custom originator test')
        ->from('MyService');

    expect($message->originator)->toBe('MyService');
});
