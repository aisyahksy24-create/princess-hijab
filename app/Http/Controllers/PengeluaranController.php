<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pengeluaran;
use App\Models\ItemPengeluaran;
use Illuminate\Support\Facades\DB;

class PengeluaranController extends Controller
{
    /**
     * Tampilkan list semua pengeluaran
     */
    public function index(Request $request)
    {
        $kategori_filter = $request->input('kategori');
        $tanggal_filter = $request->input('tanggal');

        $query = Pengeluaran::with('items')->orderBy('tanggal', 'desc')->orderBy('id', 'desc');

        if ($kategori_filter) {
            $query->where('kategori', $kategori_filter);
        }
        if ($tanggal_filter) {
            $query->whereDate('tanggal', $tanggal_filter);
        }

        $data_pengeluaran = $query->get();

        return view('pengeluaran.index', compact('data_pengeluaran', 'kategori_filter', 'tanggal_filter'));
    }

    /**
     * Pilih kategori pengeluaran sebelum tambah
     */
    public function pilihKategori()
    {
        return view('pengeluaran.pilih-kategori');
    }

    /**
     * Tampilkan form tambah pengeluaran dengan kategori tertentu
     */
    public function tambah(Request $request)
    {
        $kategori = $request->query('kategori');
        if (!$kategori) {
            return redirect('/pengeluaran/kategori');
        }

        // Tentukan nomor pengeluaran otomatis berikutnya
        // Misalkan format nomor pengeluaran adalah incremental integer
        $last_id = Pengeluaran::max('id') ?? 0;
        $next_number = $last_id + 1;

        return view('pengeluaran.tambah', compact('kategori', 'next_number'));
    }

    /**
     * Simpan pengeluaran dan detail item
     */
    public function store(Request $request)
    {
        $request->validate([
            'nomor_pengeluaran' => 'required',
            'tanggal' => 'required|date',
            'kategori' => 'required',
            'items' => 'required', // JSON string berisi list item
        ]);

        try {
            DB::beginTransaction();

            $items = json_decode($request->input('items'), true);

            if (empty($items)) {
                return redirect()->back()->withInput()->with('error', 'Item pengeluaran harus diisi minimal 1 item!');
            }

            // Hitung total pengeluaran dari list item
            $total_pengeluaran = 0;
            foreach ($items as $item) {
                $total_pengeluaran += $item['jumlah'] * $item['tarif'];
            }

            // Simpan header pengeluaran
            $pengeluaran = Pengeluaran::create([
                'nomor_pengeluaran' => $request->input('nomor_pengeluaran'),
                'tanggal' => $request->input('tanggal'),
                'kategori' => $request->input('kategori'),
                'total' => $total_pengeluaran,
            ]);

            // Simpan detail item
            foreach ($items as $item) {
                ItemPengeluaran::create([
                    'pengeluaran_id' => $pengeluaran->id,
                    'nama' => $item['nama'],
                    'jumlah' => $item['jumlah'],
                    'tarif' => $item['tarif'],
                    'total' => $item['jumlah'] * $item['tarif'],
                ]);
            }

            DB::commit();

            return redirect('/pengeluaran')->with('sukses', 'Data pengeluaran berhasil disimpan!');

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withInput()->with('error', 'Gagal menyimpan pengeluaran: ' . $e->getMessage());
        }
    }

    /**
     * Tampilkan form edit pengeluaran
     */
    public function edit($id)
    {
        try {
            $pengeluaran = Pengeluaran::with('items')->findOrFail($id);
            return view('pengeluaran.edit', compact('pengeluaran'));
        } catch (\Exception $e) {
            return redirect('/pengeluaran')->with('error', 'Data pengeluaran tidak ditemukan!');
        }
    }

    /**
     * Update data pengeluaran dan detail item
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nomor_pengeluaran' => 'required',
            'tanggal' => 'required|date',
            'kategori' => 'required',
            'items' => 'required', // JSON string berisi list item
        ]);

        try {
            DB::beginTransaction();

            $pengeluaran = Pengeluaran::findOrFail($id);
            $items = json_decode($request->input('items'), true);

            if (empty($items)) {
                return redirect()->back()->withInput()->with('error', 'Item pengeluaran harus diisi minimal 1 item!');
            }

            // Hitung total pengeluaran baru dari list item
            $total_pengeluaran = 0;
            foreach ($items as $item) {
                $total_pengeluaran += $item['jumlah'] * $item['tarif'];
            }

            // Update header pengeluaran
            $pengeluaran->update([
                'nomor_pengeluaran' => $request->input('nomor_pengeluaran'),
                'tanggal' => $request->input('tanggal'),
                'kategori' => $request->input('kategori'),
                'total' => $total_pengeluaran,
            ]);

            // Hapus detail item lama, lalu masukkan yang baru
            $pengeluaran->items()->delete();
            foreach ($items as $item) {
                ItemPengeluaran::create([
                    'pengeluaran_id' => $pengeluaran->id,
                    'nama' => $item['nama'],
                    'jumlah' => $item['jumlah'],
                    'tarif' => $item['tarif'],
                    'total' => $item['jumlah'] * $item['tarif'],
                ]);
            }

            DB::commit();

            return redirect('/pengeluaran')->with('sukses', 'Data pengeluaran berhasil diperbarui!');

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withInput()->with('error', 'Gagal memperbarui pengeluaran: ' . $e->getMessage());
        }
    }

    /**
     * Hapus data pengeluaran
     */
    public function hapus($id)
    {
        try {
            $pengeluaran = Pengeluaran::findOrFail($id);
            $pengeluaran->delete(); // Ini otomatis menghapus item_pengeluarans karena cascade constraint di DB
            return redirect('/pengeluaran')->with('sukses', 'Data pengeluaran berhasil dihapus!');
        } catch (\Exception $e) {
            return redirect('/pengeluaran')->with('error', 'Gagal menghapus data: ' . $e->getMessage());
        }
    }
}
