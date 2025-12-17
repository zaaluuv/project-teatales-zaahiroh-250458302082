<?php

namespace App\Filament\Resources\Posts;

use App\Models\Post;
use Filament\Tables;
use Filament\Forms\Set;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Illuminate\Support\Str;
use Filament\Resources\Resource;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\PostResource\Pages;
use App\Filament\Resources\Posts\Pages\EditPost;
use App\Filament\Resources\Posts\Pages\ListPosts;
use App\Filament\Resources\Posts\Pages\CreatePost;
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
                        ->disabled(),

                    RichEditor::make('content')
                        ->columnSpanFull()
                        ->extraAttributes([
                            'style' => 'max-width: 100%; overflow-wrap: anywhere; word-break: break-word;',
                        ]),
                    ])->columnSpanFull(),

                Section::make('Moderasi')->schema([
                    FileUpload::make('thumbnail')
                        ->image()
                        ->disk('public')
                        ->directory('thumbnails')
                        ->downloadable()
                        ->disabled(fn (string $operation) => $operation === 'edit'), 

                    Select::make('user_id')
                        ->relationship('user', 'name')
                        ->label('Penulis')
                        ->disabled(fn (string $operation) => $operation === 'edit')
                        ->dehydrated() 
                        ->required(),

                    Select::make('category_id')
                        ->relationship('category', 'name')
                        ->label('Kategori')
                        ->disabled(fn (string $operation) => $operation === 'edit')
                        ->dehydrated() 
                        ->placeholder('Tanpa Kategori'),

                    Select::make('status')
                        ->label('Status Moderasi')
                        ->options([
                            'draft' => 'Draft',
                            'published' => 'Published',
                            'hidden' => 'Hidden', 
                        ])
                        ->required()
                        ->default('published'),
                    
                    Repeater::make('postImages')
                        ->relationship()
                        ->hiddenLabel()
                        ->schema([
                            FileUpload::make('image')
                                ->label('Foto')
                                ->image()
                                ->disk('public')
                                ->directory('post-images')
                                ->required(),
                        ])
                        ->grid(2)
                        ->defaultItems(0) 
                        ->addActionLabel('Tambah Foto')
                        ->reorderableWithButtons()
                        ->disabled(fn (string $operation) => $operation === 'edit'),
                ])->columnSpanFull(), 
            ])->columns(1);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->searchable()
                    ->limit(30)
                    ->weight('bold'),
                Tables\Columns\TextColumn::make('user.name')->label('Penulis')->sortable(),
                Tables\Columns\TextColumn::make('status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'draft' => 'gray',
                        'published' => 'success',
                        'hidden' => 'danger',
                        default => 'gray',
                    }),
                Tables\Columns\TextColumn::make('created_at')->dateTime()->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('status'),
            ])
            ->actions([
                Tables\Actions\EditAction::make()
                    ->label('Moderasi')
                    ->icon('heroicon-o-adjustments-horizontal')
                    ->color('warning'),

                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
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