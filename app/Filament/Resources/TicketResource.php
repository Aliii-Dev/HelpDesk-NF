<?php

namespace App\Filament\Resources;

use stdClass;
use Filament\Forms;
use Filament\Tables;
use App\Models\Ticket;
use Filament\Forms\Form;
use App\Models\unit_kerja;
use Filament\Tables\Table;
use App\Models\jenis_masalah;
use Filament\Resources\Resource;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Tables\Actions\BulkAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Illuminate\Database\Eloquent\Collection;
use Filament\Tables\Columns\ImageColumn;
use Filament\Forms\Components\FileUpload;
use Illuminate\Database\Eloquent\Builder;
use Filament\Tables\Actions\Contracts\HasTable;
use App\Filament\Resources\TicketResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\RichEditor;
use App\Filament\Resources\TicketResource\RelationManagers;

class TicketResource extends Resource
{
    protected static ?string $model = Ticket::class;

    protected static ?string $navigationIcon = 'heroicon-o-ticket';

    protected static ?string $navigationGroup = 'Menu';

    protected static ?string $slug = 'ticket';


    protected static ?string $navigationLabel = 'Ticket';

    // protected static ?int $navigationSort = 5;


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('nama_pengirim')
                    ->label('Nama Pengirim'),
                TextInput::make('email_pengirim')
                    ->label('Email Pengirim'),
                TextInput::make('judul')
                    ->label('Judul'),
                Select::make('jenis_masalah_id')
                    ->options(jenis_masalah::all()->pluck('nama', 'id'))
                    ->label('Jenis Masalah')
                    ->relationship(name: 'jenis_masalah', titleAttribute: 'nama')
                    ->createOptionForm([
                        Forms\Components\TextInput::make('nama')
                    ])
                    ->required(),
                RichEditor::make('detail_masalah')
                    ->label('Detail Masalah'),
                Select::make('unit_kerja_id')
                    ->options(jenis_masalah::all()->pluck('nama'))
                    ->label('Unit Kerja')
                    ->relationship(name: 'unit_kerja', titleAttribute: 'nama')
                    ->createOptionForm([
                        Forms\Components\TextInput::make('nama')
                    ])
                    ->required(),
                FileUpload::make('lampiran')
                    ->directory("lampiran")
                    ->imageEditor()
                    ->downloadable()
                    ->openable()
                    ->previewable(true)
                    ->required()
            ])->columns(1);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                // TextColumn::make('no')->state(
                //     static function (HasTable $livewire, stdClass $rowLoop): string {
                //         return (string) ($rowLoop->iteration +
                //             ($livewire->getTableRecordsPerPage() * ($livewire->getTablePage() - 1
                //             ))
                //         );
                //     }
                // ),
                TextColumn::make('nama_pengirim')
                    ->label('Nama Pengirim')
                    ->searchable(),
                TextColumn::make('email_pengirim')
                    ->label('Email Pengirim')
                    ->searchable(),
                TextColumn::make('jenis_masalah.nama')
                    ->label('Jenis Masalah')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('unit_kerja.nama')
                    ->label('Unit Kerja')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('status')
                    ->toggleable(isToggledHiddenByDefault: false)
                    ->badge()
                    ->color(fn(string $state): string => match ($state) {
                        'ON PROGRESS' => 'primary',
                        'TERBACA' => 'warning',
                        'SELESAI' => 'success',
                        'TIDAK SELESAI' => 'danger',
                    })
                    ->formatStateUsing(fn(string $state): string => ucwords("{$state}"))
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    BulkAction::make('Change Status')
                        ->icon('heroicon-m-check')
                        ->requiresConfirmation()
                        ->form([
                            Select::make('Status')
                                ->label('Status')
                                ->options(['TERBACA' => 'Terbaca', 'ON PROGRESS' => 'On Progress', 'SELESAI' => 'Selesai', 'TIDAK SELESAI' => 'Tidak Selesai'])
                                ->required(),
                        ])
                        ->action(function (Collection $records, array $data) {
                            $records->each(function ($record) use ($data) {
                                Ticket::where('id', $record->id)->update(['status' => $data['Status']]);
                            });
                        }),
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
            'index' => Pages\ListTickets::route('/'),
            'create' => Pages\CreateTicket::route('/create'),
            'edit' => Pages\EditTicket::route('/{record}/edit'),
        ];
    }
}