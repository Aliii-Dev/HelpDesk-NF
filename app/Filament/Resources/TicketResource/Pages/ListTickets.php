<?php

namespace App\Filament\Resources\TicketResource\Pages;

use App\Filament\Resources\TicketResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Filament\Resources\Components\Tab;
use Illuminate\Database\Eloquent\Builder;

class ListTickets extends ListRecords
{
    protected static string $resource = TicketResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    public function getTabs(): array
    {
        return [
            'all' => Tab::make(),
            'ON PROGRESS' => Tab::make()
                ->modifyQueryUsing(fn(Builder $query) => $query->where('status', 'ON PROGRESS')),
            'TERBACA' => Tab::make()
                ->modifyQueryUsing(fn(Builder $query) => $query->where('status', 'TERBACA')),
            'SELESAI' => Tab::make()
                ->modifyQueryUsing(fn(Builder $query) => $query->where('status', 'SELESAI')),
            'TIDAK SELESAI' => Tab::make()
                ->modifyQueryUsing(fn(Builder $query) => $query->where('status', 'TIDAK SELESAI')),
        ];
    }
}