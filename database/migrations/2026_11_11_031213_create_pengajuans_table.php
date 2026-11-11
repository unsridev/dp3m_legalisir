<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pengajuans', function (Blueprint $table): void {
            $table->id();
            $table->foreignId('jenis_layanan_id')->constrained('jenis_layanans')->restrictOnDelete();
            $table->string('nomor_antrean', 20)->unique();
            $table->string('nim', 30);
            $table->string('nama_lengkap', 150);
            $table->string('email');
            $table->string('whatsapp', 25);
            $table->date('tanggal_wisuda');
            $table->text('keperluan');
            $table->string('status', 20)->default('dalam_antrean');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pengajuans');
    }
};
