<?php

namespace App\Filament\Resources\PostResource\Pages;

use Filament\Resources\Pages\ViewRecord;
use App\Filament\Resources\Posts\PostResource;
use Filament\Actions;

class ViewPost extends ViewRecord
{
    protected static string $resource = PostResource::class;
    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make()
                ->label('Moderasi Status')
                ->color('warning'),
        ];
    }
}