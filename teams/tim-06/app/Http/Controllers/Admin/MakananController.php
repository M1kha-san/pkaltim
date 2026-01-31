<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Makanan;
use App\Models\RumahMakan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MakananController extends Controller
{
    public function index(Request $request)
    {
        // Menampilkan daftar makanan untuk admin dengan pagination
        $makanans = Makanan::latest()->paginate(10);
        return view("admin.makanan.index", compact("makanans"));
    }

    public function create()
    {
        return view("admin.makanan.create");
    }

    public function store(Request $request)
    {
        // Validasi data input
        $request->validate([
            'nama_makanan' => 'required',
            'gambar' => 'image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // Simpan gambar jika ada
        $imagePath = null;
        if ($request->hasFile('gambar')) {
            $imagePath = $request->file('gambar')->store('makanan', 'public');
        }

        // Buat data makanan baru
        Makanan::create([
            'nama_makanan' => $request->nama_makanan,
            'deskripsi' => $request->deskripsi,
            'asal_daerah' => $request->asal_daerah,
            'gambar' => $imagePath,
        ]);

        return redirect()->route('admin.makanan.index')->with('success', 'Data berhasil ditambahkan');
    }

    public function edit(Makanan $makanan)
    {
        // Ambil semua data rumah makan untuk ditampilkan di dropdown pilihan
        $rumahMakans = RumahMakan::all();

        return view('admin.makanan.edit', compact('makanan', 'rumahMakans'));
    }

    public function update(Request $request, Makanan $makanan)
    {
        // Validasi
        $validatedData = $request->validate([
            'nama_makanan' => 'required|string|max:255',
            'deskripsi'    => 'required|string',
            'asal_daerah'  => 'required|string|max:255',
            'gambar'       => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
        ]);

        // Cek apakah user upload gambar baru
        if ($request->hasFile('gambar')) {
            // Hapus gambar lama jika ada
            if ($makanan->gambar && Storage::disk('public')->exists($makanan->gambar)) {
                Storage::disk('public')->delete($makanan->gambar);
            }

            // Simpan gambar baru
            $validatedData['gambar'] = $request->file('gambar')->store('makanan', 'public');
        }

        // Update data (menggunakan data yang sudah divalidasi)
        $makanan->update($validatedData);

        return redirect()->route('admin.makanan.index')->with('success', 'Data berhasil diupdate');
    }

    public function destroy(Makanan $makanan)
    {
        // Hapus gambar dari storage jika ada
        if ($makanan->gambar && Storage::disk('public')->exists($makanan->gambar)) {
            Storage::disk('public')->delete($makanan->gambar);
        }

        $makanan->delete();
        return redirect()->route('admin.makanan.index')->with('success', 'Data berhasil dihapus');
    }

    public function destroyRumahMakan(Makanan $makanan, $rumahMakanId)
    {
        // Lepas hubungan makanan dengan rumah makan tertentu
        $makanan->rumahMakans()->detach($rumahMakanId);

        return back()->with('success', 'Rumah makan berhasil dihapus dari makanan');
    }

    public function attachRumahMakan(Request $request, Makanan $makanan)
    {
        // Validasi dan lampirkan rumah makan ke makanan dengan harga
        $request->validate([
            // Pastikan ID-nya beneran ada di tabel rumah_makans
            'rumah_makan_id' => 'required|exists:rumah_makans,id',
            'harga' => 'required|numeric|min:0'
        ]);

        // Kalau makanan ini sudah ada di rumah makan tersebut, update harganya saja
        if ($makanan->rumahMakans()->where('rumah_makan_id', $request->rumah_makan_id)->exists()) {
            $makanan->rumahMakans()->updateExistingPivot($request->rumah_makan_id, ['harga' => $request->harga]);
            $pesan = 'Harga berhasil diperbarui!';
        } else {
            // Kalau belum ada, baru attach (tambah baru)
            $makanan->rumahMakans()->attach($request->rumah_makan_id, ['harga' => $request->harga]);
            $pesan = 'Rumah makan berhasil ditambahkan!';
        }

        return back()->with('success', $pesan);
    }
}
