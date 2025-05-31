# Laravel Notification Channel for SMSXabar

This package makes it easy to send notifications via [SMSXabar](https://smsxabar.uz) with Laravel.

> Built with ❤️ by [Yunusali Abduraxmanov](mailto:yunusalikhakimjanovich@gmail.com)

---

## Contents

- [Installation](#installation)
- [Usage](#usage)
- [Available Message methods](#available-message-methods)
- [Changelog](#changelog)
- [Testing](#testing)
- [Security](#security)
- [Contributing](#contributing)
- [License](#license)

---

## Installation

You can install this package via Composer:

```bash
composer require khakimjanovich/smsxabar
```

Then publish the config file:

```bash
php artisan vendor:publish --tag="smsxabar-config"
```

## Configuration

Add the following environment variables to your .env file:

```dotenv
SMSXABAR_API_URL=https://your-smsxabar-endpoint/send
SMSXABAR_USERNAME=your-username
SMSXABAR_PASSWORD=your-password
```

## Usage

Routing the Notification

Make sure your notifiable model has a routeNotificationForSmsXabar method:

```php
public function routeNotificationForSmsXabar(): string
{
    return $this->phone_number;
}
```

## Sending a Notification

Here's an example notification:

```php
use Illuminate\Notifications\Notification;
use Khakimjanovich\SMSXabar\Channels\SmsXabarChannel;
use Khakimjanovich\SMSXabar\Message\SmsXabarMessage;

class AccountLoginNotification extends Notification
{
    public function via($notifiable)
    {
        return [SmsXabarChannel::class];
    }

    public function toSmsXabar($notifiable): SmsXabarMessage
    {
        return SmsXabarMessage::create(
            $notifiable->routeNotificationForSmsXabar(),
            'Your one-time login code is: 257505'
        )->from('SOMEONE');
    }
}
```

## Available Message Methods

- `create(string $recipient, string $text)`  
  Sets the recipient and message content.

- `from(string $originator)`
  Sets a custom sender name (defaults to `3700`).

## Testing

```bash
  vendor/bin/pest
```

Tests are powered by Pest and Laravel Testbench.

# Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information

# Security

If you discover any security-related issues, please email yunusalikhakimjanovich@gmail.com instead of using the issue
tracker.

# Contributing

Contributions are very welcome! Please submit a pull request or open an issue for any bug or feature request.

# License

The MIT License (MIT). Please see License File for more information.
