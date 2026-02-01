<?php

namespace App\Http\Controllers;

use App\Models\Destination;
use App\Models\Category;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class PublicController extends Controller
{
    /**
     * 1. Halaman Utama / Landing Page (Home)
     * URL: /
     */
    public function landing()
    {
        // Mengambil 4 data destinasi terbaru untuk section "Destinasi Ikonik"
        $destinations = Destination::with('images')
            ->where('status', 'active')
            ->latest()
            ->take(4) // Cukup ambil 4 untuk tampilan awal
            ->get();

        // Mengirim data ke LandingPage.blade.php
        return view('public.LandingPage', compact('destinations'));
    }

    /**
     * 2. Halaman List Semua Wisata (Destination)
     * URL: /destination
     * Diakses saat tombol "Lihat Semua" diklik
     */
    public function index()
    {
        // Mengambil SEMUA data wisata yang aktif
        // Kita hapus 'take(6)' agar user bisa melihat semua data
        $destinations = Destination::with('images')
            ->where('status', 'active')
            ->latest()
            ->get();

        $categories = Category::all();

        // Mengirim data ke Destination.blade.php
        return view('public.Destination', compact('destinations', 'categories'));
    }

    /**
     * 3. Halaman Detail Wisata
     * URL: /destination/{slug}
     */
    public function show($slug)
    {
        // Ambil detail wisata + gambar + fasilitas + review yg approved
        $destination = Destination::with(['images', 'facilities', 'approvedReviews'])
            ->where('slug', $slug)
            ->firstOrFail();

        // SAYA UBAH: dari 'front.detail' ke 'public.detail' agar konsisten satu folder
        return view('public.detail', compact('destination'));
    }

    /**
     * 4. Proses Kirim Review
     * URL: /review/{id} (POST)
     */
    public function storeReview(Request $request, $id)
    {
        // 1. Cek apakah user sudah pernah review di destinasi ini (via Cookie)
        $cookieName = 'reviewed_destination_' . $id;
        if ($request->hasCookie($cookieName)) {
            return back()->with('error', 'Anda hanya bisa mengirimkan 1 komentar per destinasi.');
        }

        $request->validate([
            'visitor_name' => 'required|string|max:255',
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'required|string',
        ]);

        // Validasi apakah ID destinasi valid
        $destination = Destination::findOrFail($id);

        Review::create([
            'destination_id' => $destination->id,
            'visitor_name' => $request->visitor_name,
            'rating' => $request->rating,
            'comment' => $request->comment,
            'status' => 'pending' // Default pending agar dicek admin dulu
        ]);

        // 2. Buat cookie agar user tidak bisa review lagi (berlaku 1 tahun)
        // 525600 menit = 1 tahun
        $cookie = cookie($cookieName, 'true', 525600);

        return back()
            ->withCookie($cookie)
            ->with('success', 'Komentarmu sedang dalam proses, terimakasih atas komentarnya!');
    }
}