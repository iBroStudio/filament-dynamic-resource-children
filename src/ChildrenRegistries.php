<?php

namespace IBroStudio\FilamentDynamicResourceChildren;

use Filament\Pages\Page;
use Filament\Resources\RelationManagers\RelationManager;
use IBroStudio\FilamentDynamicResourceChildren\Exceptions\BadPageParameterException;
use IBroStudio\FilamentDynamicResourceChildren\Exceptions\ChildMissingException;
use IBroStudio\FilamentDynamicResourceChildren\Exceptions\InvalidPageException;
use IBroStudio\FilamentDynamicResourceChildren\Exceptions\InvalidRelationManagerException;
use Illuminate\Support\Collection;

class ChildrenRegistries
{
    protected Collection $registries;

    public function __construct()
    {
        $this->registries = collect();
    }

    public function addRegistry($key): void
    {
        $this->registries->put($key, collect([
            'pages' => collect(),
            'relations' => collect(),
        ]));
    }

    public function getRegistries(): Collection
    {
        return $this->registries;
    }

    public function getRegistry($key): Collection
    {
        return $this->registries[$key] ?? collect();
    }

    public function ensureRegistry($key): void
    {
        if ($this->registries->keys()->doesntContain($key)) {
            $this->addRegistry($key);
        }
    }

    public function addPages(array $pages, string $key): void
    {
        $this->ensureRegistry($key);

        foreach ($pages as $name => $page) {
            if (! is_array($page) || ! array_key_exists('class', $page) || ! array_key_exists('route', $page)) {
                throw new BadPageParameterException();
            }

            if (! class_exists($page['class'])) {
                throw new ChildMissingException($page['class']);
            }

            if (! is_subclass_of($page['class'], Page::class)) {
                throw new InvalidPageException($page['class']);
            }
            /* @phpstan-ignore-next-line */
            $this->registries[$key]['pages']->put($name, $page['class']::route($page['route']));
        }
    }

    public function addRelationManagers(array $relationManagers, string $key): void
    {
        $this->ensureRegistry($key);

        foreach ($relationManagers as $relationManager) {
            if (! class_exists($relationManager)) {
                throw new ChildMissingException($relationManager);
            }

            if (! is_subclass_of($relationManager, RelationManager::class)) {
                throw new InvalidRelationManagerException($relationManager);
            }

            $this->registries[$key]['relations']->push($relationManager);
        }
    }

    public function getPages($key): Collection
    {
        return $this->registries[$key]['pages'] ?? collect();
    }

    public function getRelationManagers($key): Collection
    {
        return $this->registries[$key]['relations'] ?? collect();
    }
}
