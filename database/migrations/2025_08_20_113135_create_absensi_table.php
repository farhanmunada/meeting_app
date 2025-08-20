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
        Schema::create('absensi', function (Blueprint $table) {
            $table->id();
            $table->foreignId('rapat_id')->constrained('rapat')->onDelete('cascade');
            $table->string('nama');
            $table->string('instansi')->nullable();
            $table->string('jabatan')->nullable();
            $table->string('kontak')->nullable();
            $table->timestamp('waktu_absen')->useCurrent();
            $table->timestamps();

            $table->unique(['rapat_id', 'nama']); // validasi duplikat
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('absensi');
    }
};
