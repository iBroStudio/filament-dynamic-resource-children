<?php

use IBroStudio\FilamentDynamicResourceChildren\Tests\Fixtures\Resources\UserResource;
use IBroStudio\FilamentDynamicResourceChildren\Tests\Fixtures\Resources\UserResource\Pages\ExamplePage;
use IBroStudio\FilamentDynamicResourceChildren\Tests\Fixtures\Resources\UserResource\RelationManagers\TestRelationManager;
use Illuminate\Support\Collection;

it('can define registry key')
    ->expect(fn () => UserResource::getRegistryKey())
    ->toBe('userresource');

it('can retrieve a registry')
    ->expect(fn () => UserResource::getChildrenRegistry())
    ->toBeInstanceOf(Collection::class);

it('add dynamic page', function () {
    expect(count(UserResource::getPages()))->toBe(1);

    UserResource::addDynamicPages([
        'test' => [
            'class' => ExamplePage::class,
            'route' => '/example',
        ],
    ]);

    expect(count(UserResource::getPages()))->toBe(2);
});

it('get dynamic page', function () {
    expect(count(UserResource::getDynamicPages()))->toBe(0);

    UserResource::addDynamicPages([
        'test' => [
            'class' => ExamplePage::class,
            'route' => '/example',
        ],
    ]);

    expect(UserResource::getDynamicPages())->toMatchArray([
        'test' => [
            'class' => ExamplePage::class,
            'route' => '/example',
        ],
    ]);
});

it('add dynamic relation manger', function () {
    expect(count(UserResource::getRelations()))->toBe(0);

    UserResource::addDynamicRelationManagers([
        TestRelationManager::class,
    ]);

    expect(count(UserResource::getRelations()))->toBe(1);
});

it('get dynamic relation manger', function () {
    expect(count(UserResource::getDynamicRelationManagers()))->toBe(0);

    UserResource::addDynamicRelationManagers([
        TestRelationManager::class,
    ]);

    expect(UserResource::getDynamicRelationManagers())
        ->toMatchArray([TestRelationManager::class]);
});
