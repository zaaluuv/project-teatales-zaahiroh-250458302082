<?php

namespace App\Filament\Resources\Posts;

use Filament\Forms;
use App\Models\Post;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Illuminate\Support\Str;
use Filament\Resources\Resource;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use App\Filament\Resources\Posts\Pages\EditPost;
use App\Filament\Resources\Posts\Pages\ListPosts;
use App\Filament\Resources\Posts\Pages\CreatePost;
use Filament\Forms\Set;

class PostResource extends Resource
{
    protected static ?string $model = Post::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';
    
    protected static ?string $navigationGroup = 'Manajemen Konten';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Konten Utama')->schema([
                    
                    TextInput::make('title')
                        ->label('Judul Cerita')
                        ->required()
                        ->disabled(fn (string $operation) => $operation === 'edit')
                        ->live(onBlur: true)
                        ->afterStateUpdated(fn (Set $set, ?string $state) => $set('slug', Str::slug($state ?? ''))),

                    TextInput::make('slug')
                        ->required()
                        ->readOnly(), 

                    RichEditor::make('content')
                        ->label('Isi Cerita')
                        ->required()
                        ->disabled(fn (string $operation) => $operation === 'edit')
                        ->columnSpanFull(),
                ])->columnSpan(2),

                Section::make('Meta Data')->schema([
                    
                    FileUpload::make('thumbnail')
                        ->image()
                        ->disk('public')
                        ->directory('thumbnails')
                        ->disabled(fn (string $operation) => $operation === 'edit')
                        ->downloadable(),

                    Select::make('user_id')
                        ->relationship('user', 'name')
                        ->searchable()
                        ->preload()
                        ->required()
                        ->label('Penulis')
                        ->disabled(fn (string $operation) => $operation === 'edit'),

                    Select::make('category_id')
                        ->relationship('category', 'name')
                        ->searchable()
                        ->preload()
                        ->required()
                        ->label('Kategori')
                        ->disabled(fn (string $operation) => $operation === 'edit'),

                    Select::make('status')
                        ->label('Status Moderasi')
                        ->options([
                            'draft' => 'Draft',
                            'published' => 'Published (Tayang)',
                            'hidden' => 'Hidden (Sembunyikan)',
                        ])
                        ->required()
                        ->default('draft')
                        ->selectablePlaceholder(false),

                    FileUpload::make('postImages') 
                        ->relationship('postImages', 'image')
                        ->multiple()
                        ->image()
                        ->disk('public')
                        ->directory('post-images')
                        ->label('Galeri Foto')
                        ->disabled(fn (string $operation) => $operation === 'edit'),

                ])->columnSpan(1),
            ])->columns(3);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('thumbnail')
                    ->circular(),
                
                Tables\Columns\TextColumn::make('title')
                    ->searchable()
                    ->sortable()
                    ->weight('bold')
                    ->limit(30),

                Tables\Columns\TextColumn::make('user.name')
                    ->label('Penulis')
                    ->sortable(),
                
                Tables\Columns\TextColumn::make('category.name')
                    ->label('Kategori')
                    ->badge()
                    ->color('info'),

                Tables\Columns\TextColumn::make('status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'draft' => 'gray',
                        'published' => 'success',
                        'hidden' => 'danger',
                        default => 'gray',
                    }),

                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('status')
                    ->options([
                        'draft' => 'Draft',
                        'published' => 'Published',
                        'hidden' => 'Hidden',
                    ]),
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
            'index' => ListPosts::route('/'),
            'create' => CreatePost::route('/create'),
            'edit' => EditPost::route('/{record}/edit'),
        ];
    }
}