<?php

namespace App\Filament\Resources\RandomQuotes;

use App\Filament\Resources\RandomQuotes\Pages;
use App\Models\RandomQuote;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Section;
use Filament\Tables\Columns\TextColumn;

class RandomQuoteResource extends Resource
{
    protected static ?string $model = RandomQuote::class;

    protected static ?string $navigationIcon = 'heroicon-o-chat-bubble-bottom-center-text';

    protected static ?string $navigationGroup = 'Manajemen Konten';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Detail Kutipan')->schema([
                    
                    Select::make('user_id')
                        ->relationship('user', 'name')
                        ->searchable()
                        ->preload()
                        ->required()
                        ->label('Pemilik Kutipan'),

                    TextInput::make('title')
                        ->label('Judul (Opsional)')
                        ->maxLength(255),

                    Textarea::make('content')
                        ->label('Isi Kutipan')
                        ->required()
                        ->columnSpan('full'), 
                        
                ])->columns(1),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('user.name')
                    ->label('Pemilik')
                    ->sortable()
                    ->searchable(),

                TextColumn::make('title')
                    ->label('Judul')
                    ->searchable()
                    ->placeholder('- Tanpa Judul -'),

                TextColumn::make('content')
                    ->label('Isi')
                    ->limit(50)
                    ->searchable(),

                TextColumn::make('created_at')
                    ->label('Dibuat Pada')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
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