<?php

namespace IBroStudio\FilamentDynamicResourceChildren\Tests\Fixtures\Resources\UserResource\Pages;

use Filament\Resources\Pages\ListRecords;
use IBroStudio\FilamentDynamicResourceChildren\Tests\Fixtures\Resources\UserResource;

class ListUsers extends ListRecords
{
    protected static string $resource = UserResource::class;
}