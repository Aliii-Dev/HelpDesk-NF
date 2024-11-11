<?php

namespace App\Filament\Resources\JenisMasalahResource\Pages;

use App\Filament\Resources\JenisMasalahResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListJenisMasalahs extends ListRecords
{
    protected static string $resource = JenisMasalahResource::class;

    protected static ?string $navigationLabel = 'Jenis Masalah';


    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
