<?php

namespace VendorName\Skeleton;

use Filament\PluginServiceProvider;
use Spatie\LaravelPackageTools\Package;
use VendorName\Skeleton\Commands\SkeletonCommand;

class SkeletonServiceProvider extends PluginServiceProvider
{
    protected array $pages = [
    ];

    protected array $resources = [
    ];

    protected array $widgets = [
    ];

    protected array $styles = [
        //'skeleton-styles' => __DIR__ . '/../dist/app.css',
    ];

    protected array $scripts = [
        //'skeleton-scripts' => __DIR__ . '/../dist/app.js',
    ];

    public function configurePackage(Package $package): void
    {
        $package
            ->name('skeleton')
            ->hasConfigFile()
            ->hasViews()
            ->hasMigration('create_skeleton_table')
            ->hasCommand(SkeletonCommand::class);
    }
    /*
    public function packageConfiguring(Package $package): void
    {
        Event::listen(ServingFilament::class, [$this, 'registerStuff']);
    }

    protected function registerStuff(ServingFilament $event): void
    {
        // ...
    }
    */
    protected function getScriptData(): array
    {
        return [
            //'someDataKey' => 'someDataValue'
        ];
    }

    protected function getUserMenuItems(): array
    {
        return [
            /*
            UserMenuItem::make()
                ->label('Settings')
                ->url(route('filament.pages.settings'))
                ->icon('heroicon-s-cog'),
            */
        ];
    }
}
