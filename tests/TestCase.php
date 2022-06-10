<?php

namespace IBroStudio\FilamentDynamicResourceChildren\Tests;

use Orchestra\Testbench\TestCase as Orchestra;
use IBroStudio\FilamentDynamicResourceChildren\FilamentDynamicResourceChildrenServiceProvider;
use Livewire\LivewireServiceProvider;

class TestCase extends Orchestra
{
    protected function getPackageProviders($app)
    {
        return [
            LivewireServiceProvider::class,
            FilamentDynamicResourceChildrenServiceProvider::class,
        ];
    }
}
