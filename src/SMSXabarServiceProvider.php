<?php

namespace Khakimjanovich\SMSXabar;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class SMSXabarServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        $package
            ->name('smsxabar')
            ->hasConfigFile();
    }
}
