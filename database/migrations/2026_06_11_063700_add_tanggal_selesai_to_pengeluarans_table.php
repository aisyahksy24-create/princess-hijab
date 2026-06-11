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
            $table->date('tanggal_selesai')->nullable()->after('tanggal_mulai');
        });

        // Set retroaktif untuk record lama berdasarkan periode yang sudah ada
        // Harian: tanggal_selesai = tanggal_mulai
        DB::table('pengeluarans')
            ->where('periode', 'harian')
            ->update(['tanggal_selesai' => DB::raw('tanggal_mulai')]);

        // Mingguan: tanggal_selesai = tanggal_mulai + 6 hari (PostgreSQL syntax)
        DB::table('pengeluarans')
            ->where('periode', 'mingguan')
            ->update(['tanggal_selesai' => DB::raw("tanggal_mulai + INTERVAL '6 days'")]);

        // Bulanan: tanggal_selesai = hari terakhir bulan tanggal_mulai (PostgreSQL syntax)
        DB::table('pengeluarans')
            ->where('periode', 'bulanan')
            ->update(['tanggal_selesai' => DB::raw("(DATE_TRUNC('month', tanggal_mulai) + INTERVAL '1 month' - INTERVAL '1 day')::date")]);

        // Tahunan: tanggal_selesai = 31 Des tahun tanggal_mulai (PostgreSQL syntax)
        DB::table('pengeluarans')
            ->where('periode', 'tahunan')
            ->update(['tanggal_selesai' => DB::raw("(DATE_TRUNC('year', tanggal_mulai) + INTERVAL '1 year' - INTERVAL '1 day')::date")]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pengeluarans', function (Blueprint $table) {
            $table->dropColumn('tanggal_selesai');
        });
    }
};
