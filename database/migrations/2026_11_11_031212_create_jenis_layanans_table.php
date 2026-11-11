<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('jenis_layanans', function (Blueprint $table): void {
            $table->id();
            $table->string('nama', 120);
            $table->string('kode', 8)->unique();
            $table->boolean('aktif')->default(true);
            $table->timestamps();
        });

        DB::table('jenis_layanans')->insert([
            'nama' => 'Legalisir Akreditasi',
            'kode' => 'LA',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    public function down(): void
    {
        Schema::dropIfExists('jenis_layanans');
    }
};
