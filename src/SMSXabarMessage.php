<?php

namespace Khakimjanovich\SMSXabar;

class SMSXabarMessage
{
    public string $recipient;
    public string $messageId;
    public string $originator = '3700';
    public string $content;

    public static function create(string $recipient, string $text): self
    {
        $instance = new self();
        $instance->recipient = $recipient;
        $instance->messageId = (string) \Str::uuid();
        $instance->content = $text;

        return $instance;
    }

    public function from(string $originator): self
    {
        $this->originator = $originator;
        return $this;
    }
}
