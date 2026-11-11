<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('urutan_antrean', function (Blueprint $table): void {
            $table->foreignId('jenis_layanan_id')->constrained('jenis_layanans')->restrictOnDelete();
            $table->date('tanggal');
            $table->unsignedSmallInteger('urutan')->default(0);
            $table->primary(['jenis_layanan_id', 'tanggal']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('urutan_antrean');
    }
};
