<?php

namespace Khakimjanovich\SMSXabar;

use Illuminate\Support\Str;

class SMSXabarMessage
{
    public string $recipient;

    public string $message_id;

    public string $originator = '3700';

    public string $content;

    public static function create(string $recipient, string $text): self
    {
        $instance = new self;
        $instance->recipient = $recipient;
        $instance->message_id = Str::uuid()->toString();
        $instance->content = $text;

        return $instance;
    }

    public function from(string $originator): self
    {
        $this->originator = $originator;

        return $this;
    }
}
