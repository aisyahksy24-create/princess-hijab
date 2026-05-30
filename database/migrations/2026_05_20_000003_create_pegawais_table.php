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
    Schema::create('pegawais', function (Blueprint $table) {
        $table->id(); // ID Pegawai otomatis
        $table->string('nama_pegawai');
        $table->text('alamat');
        $table->string('no_telp');
        $table->string('username')->unique();
$table->string('password');
$table->string('role')->default('pegawai');
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pegawais');
    }
};
