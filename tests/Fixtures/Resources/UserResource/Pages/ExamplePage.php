<?php

namespace IBroStudio\FilamentDynamicResourceChildren\Tests\Fixtures\Resources\UserResource\Pages;

use Filament\Resources\Pages\Page;

class ExamplePage extends Page
{
    protected static string $resource = CustomerResource::class;

    protected static string $view = 'filament.resources.customer-resource.pages.example-page';
}
