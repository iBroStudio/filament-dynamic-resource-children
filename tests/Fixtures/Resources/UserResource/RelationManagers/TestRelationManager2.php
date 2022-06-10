<?php

namespace IBroStudio\FilamentDynamicResourceChildren\Tests\Fixtures\Resources\UserResource\RelationManagers;

use Filament\Resources\RelationManagers\HasManyRelationManager;

class TestRelationManager2 extends HasManyRelationManager
{
    protected static string $relationship = 'test2';
}
