<?php

namespace App\Filament\Resources\Categories;

use App\Filament\Resources\Categories\Pages;
use App\Models\Category;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Str;
use Filament\Forms\Set;

// Import komponen form & table agar lebih rapi dan editor mengenali
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Section;
use Filament\Tables\Columns\TextColumn;

class CategoryResource extends Resource
{
    protected static ?string $model = Category::class;

    // PERBAIKAN UTAMA: Gunakan string langsung untuk ikon, jangan object Heroicon
    // Ini mengatasi error "Type mismatch"
    protected static ?string $navigationIcon = 'heroicon-o-tag';
    
    // Opsional: Masukkan ke grup yang sama dengan Post agar menu rapi
    protected static ?string $navigationGroup = 'Manajemen Konten';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Informasi Kategori')->schema([
                    
                    TextInput::make('name')
                        ->label('Nama Kategori')
                        ->required()
                        ->live(onBlur: true) // Update slug saat user selesai ketik nama
                        ->afterStateUpdated(fn (Set $set, ?string $state) => $set('slug', Str::slug($state ?? ''))),

                    TextInput::make('slug')
                        ->required()
                        ->readOnly() // User tidak perlu edit slug manual
                        ->unique(ignoreRecord: true), // Validasi unik (kecuali data ini sendiri saat edit)
                        
                ])->columns(2), // Tampilkan 2 kolom (Nama di kiri, Slug di kanan)
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label('Nama Kategori')
                    ->searchable()
                    ->sortable()
                    ->weight('bold'),

                TextColumn::make('slug')
                    ->label('Slug URL')
                    ->searchable()
                    ->color('gray')
                    ->icon('heroicon-o-link'),
                
                TextColumn::make('created_at')
                    ->label('Dibuat Pada')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                // Tidak ada filter khusus untuk kategori sederhana
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
        // Pastikan file Pages/ListCategories.php, CreateCategory.php, EditCategory.php ada
        return [
            'index' => Pages\ListCategories::route('/'),
            'create' => Pages\CreateCategory::route('/create'),
            'edit' => Pages\EditCategory::route('/{record}/edit'),
        ];
    }
}