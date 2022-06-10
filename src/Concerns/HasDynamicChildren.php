<?php

namespace IBroStudio\FilamentDynamicResourceChildren\Concerns;

use IBroStudio\FilamentDynamicResourceChildren\Facades\ChildrenRegistries;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;

trait HasDynamicChildren {

    public static function addDynamicPages(array $routes): void
    {
        ChildrenRegistries::addPages($routes, self::getRegistryKey());
    }

    public static function addDynamicRelationManagers(array $classes): void
    {
        ChildrenRegistries::addRelationManagers($classes, self::getRegistryKey());
    }

    public static function getDynamicPages(): array
    {
        return ChildrenRegistries::getPages(self::getRegistryKey())->toArray();
    }

    public static function getDynamicRelationManagers(): array
    {
        return ChildrenRegistries::getRelationManagers(self::getRegistryKey())->toArray();
    }

    public static function getChildrenRegistry(): Collection
    {
        return ChildrenRegistries::getRegistry(self::getRegistryKey());
    }

    public static function getRegistryKey(): string
    {
        return Str::lower(class_basename(get_class()));
    }
}