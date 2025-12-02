<?php

namespace App\Filament\Resources\RandomQuotes\Pages;

use App\Filament\Resources\RandomQuotes\RandomQuoteResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditRandomQuote extends EditRecord
{
    protected static string $resource = RandomQuoteResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
