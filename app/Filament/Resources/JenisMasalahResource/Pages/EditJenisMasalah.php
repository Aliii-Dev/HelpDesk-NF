<?php

namespace App\Filament\Resources\JenisMasalahResource\Pages;

use App\Filament\Resources\JenisMasalahResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditJenisMasalah extends EditRecord
{
    protected static string $resource = JenisMasalahResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
