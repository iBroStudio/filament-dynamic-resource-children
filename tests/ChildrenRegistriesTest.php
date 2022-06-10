<?php

use IBroStudio\FilamentDynamicResourceChildren\Facades\ChildrenRegistries as ChildrenRegistriesFacade;
use IBroStudio\FilamentDynamicResourceChildren\ChildrenRegistries;
use IBroStudio\FilamentDynamicResourceChildren\Tests\Fixtures\Resources\UserResource\Pages\ExamplePage;
use IBroStudio\FilamentDynamicResourceChildren\Tests\Fixtures\Resources\UserResource\Pages\ExamplePage2;
use IBroStudio\FilamentDynamicResourceChildren\Tests\Fixtures\Resources\UserResource\Pages\ExamplePage3;
use IBroStudio\FilamentDynamicResourceChildren\Tests\Fixtures\Resources\UserResource\RelationManagers\TestRelationManager;
use IBroStudio\FilamentDynamicResourceChildren\Tests\Fixtures\Resources\UserResource\RelationManagers\TestRelationManager2;
use IBroStudio\FilamentDynamicResourceChildren\Tests\Fixtures\Resources\UserResource\RelationManagers\TestRelationManager3;
use Illuminate\Support\Collection;

test('facade accessor is working', function () {
    expect(ChildrenRegistriesFacade::getFacadeRoot())->toBeInstanceOf(ChildrenRegistries::class);
});

test('instance is a singleton', function () {
    $registryOne = $this->app->make(ChildrenRegistries::class);
    $registryTwo = $this->app->make(ChildrenRegistries::class);

    expect(spl_object_hash($registryOne))->toBe(spl_object_hash($registryTwo));
});

it('get a registry')
    ->expect(fn() => ChildrenRegistriesFacade::getRegistry('test'))
    ->toBeInstanceOf(Collection::class);

it('get registries')
    ->expect(fn() => ChildrenRegistriesFacade::getRegistries())
    ->toBeInstanceOf(Collection::class);

it('get pages')
    ->expect(fn() => ChildrenRegistriesFacade::getPages('test'))
    ->toBeInstanceOf(Collection::class);

it('get relation managers')
    ->expect(fn() => ChildrenRegistriesFacade::getRelationManagers('test'))
    ->toBeInstanceOf(Collection::class);

it('add pages', function () {
    expect(count(ChildrenRegistriesFacade::getRegistries()))->toBe(0);

    ChildrenRegistriesFacade::addPages([
        'test' => [
            'class' => ExamplePage::class,
            'route' => '/example'
        ],
        'test2' => [
            'class' => ExamplePage2::class,
            'route' => '/example2'
        ],
        'test3' => [
            'class' => ExamplePage3::class,
            'route' => '/example3'
        ],
    ], 'resource');

ChildrenRegistriesFacade::addPages([
        'test' => [
            'class' => ExamplePage3::class,
            'route' => '/example3'
        ],
    ], 'otherresource');

    expect(ChildrenRegistriesFacade::getRegistries()->toArray())
        ->toMatchArray([
            'resource' => [
                'pages' => [
                    'test' => [
                        'class' => ExamplePage::class,
                        'route' => '/example'
                    ],
                    'test2' => [
                        'class' => ExamplePage2::class,
                        'route' => '/example2'
                    ],
                    'test3' => [
                        'class' => ExamplePage3::class,
                        'route' => '/example3'
                    ],
                ],
                'relations' => [],
            ],
            'otherresource' => [
                'pages' => [
                    'test' => [
                        'class' => ExamplePage3::class,
                        'route' => '/example3'
                    ],
                ],
                'relations' => [],
            ]
        ]);
});

it('add relation mangers', function () {
    expect(count(ChildrenRegistriesFacade::getRegistries()))->toBe(0);

    ChildrenRegistriesFacade::addRelationManagers([
        TestRelationManager::class,
        TestRelationManager2::class,
        TestRelationManager3::class,
    ], 'resource');

    ChildrenRegistriesFacade::addRelationManagers([
        TestRelationManager3::class,
    ], 'otherresource');

    expect(ChildrenRegistriesFacade::getRegistries()->toArray())
        ->toMatchArray([
            'resource' => [
                'pages' => [],
                'relations' => [
                    TestRelationManager::class,
                    TestRelationManager2::class,
                    TestRelationManager3::class,
                ],
            ],
            'otherresource' => [
                'pages' => [],
                'relations' => [
                    TestRelationManager3::class,
                ],
            ]
        ]);
});