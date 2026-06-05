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
        Schema::create('pengeluarans', function (Blueprint $table) {
            $table->id();
            $table->string('nomor_pengeluaran');
            $table->date('tanggal');
            $table->string('kategori');
            $table->bigInteger('total')->default(0);
            $table->timestamps();
        });

        Schema::create('item_pengeluarans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pengeluaran_id')->constrained('pengeluarans')->onDelete('cascade');
            $table->string('nama');
            $table->integer('jumlah');
            $table->bigInteger('tarif');
            $table->bigInteger('total');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('item_pengeluarans');
        Schema::dropIfExists('pengeluarans');
    }
};
