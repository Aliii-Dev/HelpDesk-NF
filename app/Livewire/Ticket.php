<?php

namespace App\Livewire;

use Livewire\Component;
use Filament\Forms\Form;
use Filament\Forms\Components\Select;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\FileUpload;
use App\Models\jenis_masalah;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Concerns\InteractsWithForms;

class Ticket extends Component implements HasForms
{

    use InteractsWithForms;

    public $nama_pengirim = '';
    public $email_pengirim = '';
    public $jenis_masalah_id = '';
    public $detail_masalah = '';
    public $unit_kerja_id = '';
    public $lampiran;

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Card::make()
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
                            //->relationship(name: 'jenis_masalah', titleAttribute: 'nama')
                            // ->createOptionForm([
                            //     TextInput::make('nama')
                            // ])
                            ->required(),
                        RichEditor::make('detail_masalah')
                            ->label('Detail Masalah'),
                        Select::make('unit_kerja_id')
                            ->options(jenis_masalah::all()->pluck('nama'))
                            ->label('Unit Kerja')
                            //->relationship(name: 'unit_kerja', titleAttribute: 'nama')
                            // ->createOptionForm([
                            //     TextInput::make('nama')
                            // ])
                            ->required(),
                        FileUpload::make('lampiran')
                            ->directory("lampiran")
                            ->imageEditor()
                            ->downloadable()
                            ->openable()
                            ->previewable(true)
                            ->required()
                    ])
            ])->columns(1);
    }
    public function render()
    {
        return view('livewire.ticket');
    }

    public function save(): void
    {
        $data = $this->form->validate(); // Validasi data

        $ticket = Ticket::create($data);

        // Simpan file jika ada
        if ($this->lampiran) {
            $filePath = $this->lampiran->store('lampiran');
            $ticket->lampiran = $filePath;
            $ticket->save();
        }

        // Redirect atau lakukan tindakan lain
        $this->emit('ticketSaved');
    }
}
