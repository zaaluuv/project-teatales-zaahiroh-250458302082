<?php

namespace App\Filament\Resources\RandomQuotes\Pages;

use App\Filament\Resources\RandomQuotes\RandomQuoteResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListRandomQuotes extends ListRecords
{
    protected static string $resource = RandomQuoteResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
