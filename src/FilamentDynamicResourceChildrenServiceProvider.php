<?php

namespace IBroStudio\FilamentDynamicResourceChildren;

use Filament\PluginServiceProvider;
use Spatie\LaravelPackageTools\Package;

class FilamentDynamicResourceChildrenServiceProvider extends PluginServiceProvider
{
    public function configurePackage(Package $package): void
    {
        $this->packageConfiguring($package);

        $package->name('filament-dynamic-resource-children');
    }

    public function packageConfigured(Package $package): void
    {
        $this->app->singleton(ChildrenRegistries::class, function () {
            return new ChildrenRegistries();
        });
    }

    public function packageRegistered(): void
    {
        parent::packageRegistered();

        $this->app->bind('children-registries', function () {
            return new ChildrenRegistries();
        });

        $this->app->singleton(ChildrenRegistries::class, function () {
            return new ChildrenRegistries();
        });
    }
}
