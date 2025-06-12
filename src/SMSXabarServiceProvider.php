<?php

declare(strict_types=1);

namespace Khakimjanovich\SMSXabar;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

final class SMSXabarServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        $package
            ->name('smsxabar')
            ->hasConfigFile();
    }
}
