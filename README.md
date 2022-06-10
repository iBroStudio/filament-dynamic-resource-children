# Filament Dynamic Resource Children

[![Latest Version on Packagist](https://img.shields.io/packagist/v/ibrostudio/filament-dynamic-resource-children.svg?style=flat-square)](https://packagist.org/packages/ibrostudio/filament-dynamic-resource-children)
[![GitHub Tests Action Status](https://img.shields.io/github/workflow/status/ibrostudio/filament-dynamic-resource-children/run-tests?label=tests)](https://github.com/ibrostudio/filament-dynamic-resource-children/actions?query=workflow%3Arun-tests+branch%3Amain)
[![GitHub Code Style Action Status](https://img.shields.io/github/workflow/status/ibrostudio/filament-dynamic-resource-children/Check%20&%20fix%20styling?label=code%20style)](https://github.com/ibrostudio/filament-dynamic-resource-children/actions?query=workflow%3A"Check+%26+fix+styling"+branch%3Amain)

This package allows [Filament](https://filamentphp.com/) plugins developer to register pages or relation managers in a resource living at the app level or in an another plugin.


## Installation

You can install the package via composer:

```bash
composer require ibrostudio/filament-dynamic-resource-children
```

## Usage

#### Prepare your resource

Add the trait ```CanHaveDynamicChildren``` to your resource class.

```php
use IBroStudio\FilamentDynamicResourceChildren\Concerns\HasDynamicChildren;

class ExampleParentResource extends Resource
{
    use HasDynamicChildren;
}
```

Then, in that resource class, modify ```getRelations()``` and ```getPages()``` methods:

Before:
```php
    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListExampleParents::route('/'),
            'create' => Pages\CreateExampleParent::route('/create'),
            'view' => Pages\ViewExampleParent::route('/{record}'),
            'edit' => Pages\EditExampleParent::route('/{record}/edit'),
        ];
    }
```

After:
```php
    public static function getRelations(): array
    {
        return array_merge(
            [],
            self::getDynamicRelationManagers()
        );
    }

    public static function getPages(): array
    {
        return array_merge(
            [
                'index' => Pages\ListExampleParents::route('/'),
                'create' => Pages\CreateExampleParent::route('/create'),
                'view' => Pages\ViewExampleParent::route('/{record}'),
                'edit' => Pages\EditExampleParent::route('/{record}/edit'),
            ],
            self::getDynamicPages()
        );
    }
```

#### Link your children with their parent

Create your page or relation manager as usual in your plugin.

Then register it in your plugin service provider like this:
```php
use App\Filament\Resources\ExampleParentResource;
use Filament\PluginServiceProvider;
use Spatie\LaravelPackageTools\Package;
use VendorName\MyPlugin\Filament\Resources\ExampleParentResource\Pages\MyFirstPage;
use VendorName\MyPlugin\Filament\Resources\ExampleParentResource\Pages\MySecondPage;
use VendorName\MyPlugin\Filament\Resources\ExampleParentResource\RelationManagers\MyFirstRelationManager;
use VendorName\MyPlugin\Filament\Resources\ExampleParentResource\RelationManagers\MySecondRelationManager;

class MyPluginServiceProvider extends PluginServiceProvider
{
    protected array $pages = [
        MyFirstPage::class,
        MySecondPage::class,
    ];

    protected array $relationManagers = [
        MyFirstRelationManager::class,
        MySecondRelationManager::class,
    ];

    public function configurePackage(Package $package): void
    {
        $this->packageConfiguring($package);

        $package
            ->name('my-plugin')
            ->hasViews();
    }

    public function packageRegistered(): void
    {
        parent::packageRegistered();

        $this->app->resolving('filament', function () {

            ExampleParentResource::addDynamicPages([
                'first-page-key' => [
                    'class' => MyFirstPage::class,
                    'route' => '/first-page-slug'
                ],
                'second-page-key' => [
                    'class' => MySecondPage::class,
                    'route' => '/second-page-slug'
                ],
            ]);

            ExampleParentResource::addDynamicRelationManagers([
                MyFirstRelationManager::class,
                MySecondRelationManager::class,
            ]);

        });
    }
}
```

## Testing

```bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](https://github.com/spatie/.github/blob/main/CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

- [iBroStudio](https://github.com/iBroStudio)
- [The Filament team](https://filamentphp.com/), thanks to them for their work

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
