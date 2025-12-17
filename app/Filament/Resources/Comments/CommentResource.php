<?php

namespace App\Filament\Resources\Comments;

use App\Filament\Resources\Comments\Pages;
use App\Models\Comment;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Section;
use Filament\Tables\Columns\TextColumn;

class CommentResource extends Resource
{
    protected static ?string $model = Comment::class;

    protected static ?string $navigationIcon = 'heroicon-o-chat-bubble-left-right';

    protected static ?string $navigationGroup = 'Manajemen Konten';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Detail Komentar')->schema([
                    
                    // postingan mana yang dikomentari
                    Select::make('post_id')
                        ->relationship('post', 'title')
                        ->searchable()
                        ->preload()
                        ->required()
                        ->label('Postingan'),

                    // user siapa yang ksh komen
                    Select::make('user_id')
                        ->relationship('user', 'name')
                        ->searchable()
                        ->preload()
                        ->required()
                        ->label('Pengguna'),

                    // Iisi Komentar
                    Textarea::make('content')
                        ->label('Isi Komentar')
                        ->required()
                        ->columnSpanFull(),
                        
                ])->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('user.name')
                    ->label('Pengguna')
                    ->sortable()
                    ->searchable(),

                TextColumn::make('post.title')
                    ->label('Postingan')
                    ->sortable()
                    ->searchable()
                    ->limit(30),

                TextColumn::make('content')
                    ->label('Komentar')
                    ->limit(50)
                    ->searchable(),

                TextColumn::make('created_at')
                    ->label('Waktu')
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
            'index' => Pages\ListComments::route('/'),
            'create' => Pages\CreateComment::route('/create'),
            'edit' => Pages\EditComment::route('/{record}/edit'),
        ];
    }
}