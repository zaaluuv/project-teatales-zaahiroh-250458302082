<?php

namespace App\Filament\Resources\RandomQuotes\Pages;

use App\Filament\Resources\RandomQuotes\RandomQuoteResource;
use Filament\Resources\Pages\CreateRecord;

class CreateRandomQuote extends CreateRecord
{
    protected static string $resource = RandomQuoteResource::class;
}
