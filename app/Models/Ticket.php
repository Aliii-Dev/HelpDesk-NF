<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    protected $guarded = [];

    public function jenis_masalah()
    {
        return $this->belongsTo(jenis_masalah::class);
    }

    public function unit_kerja()
    {
        return $this->belongsTo(unit_kerja::class);
    }
}