<?php

namespace App\Filament\Resources\RandomQuotes;

use App\Filament\Resources\RandomQuotes\Pages; 
use App\Models\RandomQuote;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Auth;

class RandomQuoteResource extends Resource
{
    protected static ?string $model = RandomQuote::class;

    protected static ?string $navigationIcon = 'heroicon-o-chat-bubble-left-right';
    protected static ?string $navigationLabel = 'Quotes';
    protected static ?string $navigationGroup = 'Manajemen Konten';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make() 
                    ->schema([
                        Forms\Components\Hidden::make('user_id')
                            ->default(fn () => Auth::id())
                            ->required(),

                        Forms\Components\TextInput::make('title')
                            ->label('Penulis / Judul')
                            ->placeholder('Contoh: Steve Jobs')
                            ->required()
                            ->maxLength(255),

                        Forms\Components\Textarea::make('content')
                            ->label('Isi Quote')
                            ->rows(4)
                            ->required()
                            ->columnSpanFull(),
                    ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->label('Penulis')
                    ->searchable(),
                
                Tables\Columns\TextColumn::make('content')
                    ->label('Isi Quote')
                    ->limit(50),

                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime('d M Y')
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListRandomQuotes::route('/'),
            'create' => Pages\CreateRandomQuote::route('/create'),
            'edit' => Pages\EditRandomQuote::route('/{record}/edit'),
        ];
    }
}