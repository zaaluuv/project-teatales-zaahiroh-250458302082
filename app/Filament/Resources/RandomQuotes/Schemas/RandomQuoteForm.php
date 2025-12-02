<?php

namespace App\Filament\Resources\RandomQuotes\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class RandomQuoteForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('user_id')
                    ->required()
                    ->numeric(),
                TextInput::make('title')
                    ->default(null),
                Textarea::make('content')
                    ->required()
                    ->columnSpanFull(),
            ]);
    }
}
