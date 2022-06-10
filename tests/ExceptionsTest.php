<?php

use IBroStudio\FilamentDynamicResourceChildren\Exceptions\BadPageParameterException;
use IBroStudio\FilamentDynamicResourceChildren\Exceptions\ChildMissingException;
use IBroStudio\FilamentDynamicResourceChildren\Exceptions\InvalidPageException;
use IBroStudio\FilamentDynamicResourceChildren\Exceptions\InvalidRelationManagerException;
use IBroStudio\FilamentDynamicResourceChildren\Facades\ChildrenRegistries;
use IBroStudio\FilamentDynamicResourceChildren\Tests\Fixtures\Resources\UserResource\Pages\ExamplePage;
use IBroStudio\FilamentDynamicResourceChildren\Tests\Fixtures\Resources\UserResource\Pages\InvalidPage;
use IBroStudio\FilamentDynamicResourceChildren\Tests\Fixtures\Resources\UserResource\RelationManagers\InvalidRelationManager;

it('fails when adding dynamic page when its parameter is not an array', function () {
    ChildrenRegistries::addPages([
        'test',
    ], 'resource');
})->throws(BadPageParameterException::class, 'Bad parameters: page submitted to registry has to provide an array parameters with a "class" and a "route" keys');

it('fails when adding dynamic page when class parameter is missing', function () {
    ChildrenRegistries::addPages([
        'test' => [
            'route' => '/example'
        ],
    ], 'resource');
})->throws(BadPageParameterException::class, 'Bad parameters: page submitted to registry has to provide an array parameters with a "class" and a "route" keys');

it('fails when adding dynamic page when route parameter is not missing', function () {
    ChildrenRegistries::addPages([
        'test' => [
            'class' => ExamplePage::class,
        ],
    ], 'resource');
})->throws(BadPageParameterException::class, 'Bad parameters: page submitted to registry has to provide an array parameters with a "class" and a "route" keys');

it('fails when adding dynamic page with a missing child class', function () {
    ChildrenRegistries::addPages([
        'test' => [
            'class' => 'InexistantClass',
            'route' => '/example'
        ],
    ], 'resource');
})->throws(ChildMissingException::class, 'Child InexistantClass does not exist');

it('fails when adding dynamic relation manager with a missing child class', function () {
    ChildrenRegistries::addRelationManagers([
        'InexistantClass'
    ], 'resource');
})->throws(ChildMissingException::class, 'Child InexistantClass does not exist');

it('fails when adding dynamic page with an invalid child class', function () {
    ChildrenRegistries::addPages([
        'test' => [
            'class' => InvalidPage::class,
            'route' => '/example'
        ],
    ], 'resource');
})->throws(InvalidPageException::class, 'InvalidPage is not a valid Page class');

it('fails when adding dynamic relation manager with an invalid child class', function () {
    ChildrenRegistries::addRelationManagers([
        InvalidRelationManager::class
    ], 'resource');
})->throws(InvalidRelationManagerException::class, 'InvalidRelationManager is not a valid RelationManager class');