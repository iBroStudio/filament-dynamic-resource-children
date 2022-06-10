<?php

namespace IBroStudio\FilamentDynamicResourceChildren\Facades;

use Illuminate\Support\Facades\Facade;

class ChildrenRegistries extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'children-registries';
        return \IBroStudio\FilamentDynamicResourceChildren\ChildrenRegistries::class;
    }
}
