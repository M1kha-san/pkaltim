<?php

namespace App\Http\Controllers\Admin;

use App\Models\Review;
use App\Models\RumahMakan;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RumahMakanController extends Controller
{
    public function index()
    {
        // Menampilkan daftar rumah makan untuk admin dengan pagination
        $rumahMakans = RumahMakan::latest()->paginate(10);
        return view("admin.rumah_makan.index", compact("rumahMakans"));
    }

    public function create()
    {
        return view('admin.rumah_makan.create');
    }

    public function store(Request $request)
    {
        // Validasi dan simpan rumah makan baru
        $request->validate([
            'nama_rumah_makan' => 'required|string|max:255',
            'alamat' => 'required|string',
            'no_telpon' => 'required|string|max:20',
            'latitude' => 'required|string',
            'longitude' => 'required|string'
        ]);

        // Buat data rumah makan baru
        RumahMakan::create($request->all());

        return redirect()->route('admin.rumah-makan.index')->with('success', 'Mitra Rumah Makan berhasil ditambahkan');
    }

    public function edit(RumahMakan $rumahMakan)
    {
        return view('admin.rumah_makan.edit', compact('rumahMakan'));
    }

    public function update(Request $request, RumahMakan $rumahMakan)
    {
        // Validasi dan update rumah makan
        $request->validate([
            'nama_rumah_makan' => 'required|string|max:255',
            'alamat' => 'required|string',
            'no_telpon' => 'required|string|max:20',
            'latitude' => 'required|string',
            'longitude' => 'required|string'
        ]);

        // Update data rumah makan yang tervalidasi
        $rumahMakan->update($request->all());

        return redirect()->route('admin.rumah-makan.index')->with('success', 'Data Rumah Makan berhasil diupdate');
    }

    public function destroy(RumahMakan $rumahMakan)
    {
        // Hapus relasi (pivot) biar bersih
        $rumahMakan->makanans()->detach();

        $rumahMakan->delete();

        return redirect()->route('admin.rumah-makan.index')->with('success', 'Data berhasil dihapus');
    }

    public function storeReview(Request $request, RumahMakan $rumahMakan)
    {
        // Validasi input review
        $request->validate([
            'nama_user' => 'required|string',
            'rating' => 'required|integer|min:1|max:5',
            'komentar' => 'required|string',
            'tanggal_review' => 'nullable|date',
        ]);

        // Simpan review terkait rumah makan
        $rumahMakan->reviews()->create($request->all());

        return back()->with('success', 'Review berhasil ditambahkan!');
    }

    public function destroyReview(Review $review)
    {
        $review->delete();
        return back()->with('success', 'Review dihapus.');
    }
}
