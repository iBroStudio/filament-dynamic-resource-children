<?php

namespace IBroStudio\FilamentDynamicResourceChildren\Tests;

use IBroStudio\FilamentDynamicResourceChildren\FilamentDynamicResourceChildrenServiceProvider;
use Livewire\LivewireServiceProvider;
use Orchestra\Testbench\TestCase as Orchestra;

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
