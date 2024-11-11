<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tickets', function (Blueprint $table) {
            $table->id();
            $table->string('nama_pengirim');
            $table->string('email_pengirim');
            $table->string('judul');
            $table->foreignId('jenis_masalah_id')->constrained('jenis_masalahs')->cascadeOnDelete();
            $table->text('detail_masalah');
            $table->foreignId('unit_kerja_id')->constrained('unit_kerjas')->cascadeOnDelete();
            $table->string('lampiran')->nullable();
            $table->enum('status', ['TERBACA', 'ON PROGRESS', 'SELESAI', 'TIDAK SELESAI'])->default('ON PROGRESS');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tickets');
    }
};
