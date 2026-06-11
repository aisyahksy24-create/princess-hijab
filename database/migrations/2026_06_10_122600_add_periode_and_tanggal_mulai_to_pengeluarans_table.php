<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('pengeluarans', function (Blueprint $table) {
            $table->string('periode')->default('harian');
            $table->date('tanggal_mulai')->nullable();
        });

        // Set default value retroactively for existing records:
        // periode = 'harian', tanggal_mulai = tanggal
        DB::table('pengeluarans')->update([
            'periode' => 'harian',
            'tanggal_mulai' => DB::raw('tanggal')
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pengeluarans', function (Blueprint $table) {
            $table->dropColumn(['periode', 'tanggal_mulai']);
        });
    }
};
