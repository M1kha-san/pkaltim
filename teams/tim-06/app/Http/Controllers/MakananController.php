<?php

namespace App\Http\Controllers;
use App\Models\Makanan;
use App\Models\Review;
use Illuminate\Http\Request;

class MakananController extends Controller
{
    public function home()
    {
        // Filter untuk daftar daerah unik
        $daerahs = Makanan::select('asal_daerah')->distinct()->pluck('asal_daerah');

        // Ambil 4 makanan terbaru sebagai featured
        $featured = Makanan::with('rumahMakans.reviews')->latest()->take(4)->get();

        // Ambil semua makanan dengan relasi rumah makan dan reviewnya
        $makanans = Makanan::with('rumahMakans.reviews')->latest()->paginate(9);

        return view('home', compact('daerahs', 'featured', 'makanans'));
    }

    public function index(Request $request)
    {
        // Filter untuk daftar daerah unik
        $daerahs = Makanan::select('asal_daerah')->distinct()->pluck('asal_daerah');

        $query = Makanan::query();

        // Filter berdasarkan pencarian nama atau deskripsi
        if ($request->filled('search')) {
            $query->where('nama_makanan', 'like', '%' . $request->search . '%')
                ->orWhere('deskripsi', 'like', '%' . $request->search . '%');
        }

        // Filter berdasarkan daerah
        if ($request->filled('daerah')) {
            $query->where('asal_daerah', $request->daerah);
        }

        // Dapatkan hasil dengan relasi rumah makan dan reviewnya, dengan pagination
        $makanans = $query->with('rumahMakans.reviews')->latest()->paginate(9)->withQueryString();

        return view('makanan.index', compact('makanans', 'daerahs'));
    }

    public function show($id)
    {
        // Ambil Data Makanan + Relasi Rumah Makan + Reviewnya
        $kuliner = Makanan::with(['rumahMakans.reviews'])->findOrFail($id);

        // Kumpulkan semua review untuk ditampilkan di bawah 
        $allReviews = collect();
        foreach ($kuliner->rumahMakans as $rm) {
            foreach ($rm->reviews as $review) {
                // Tempel nama lokasi biar user tau ini review warung mana
                $review->lokasi = $rm->nama_rumah_makan;
                $allReviews->push($review);
            }
        }

        // Urutkan review dari yang terbaru (created_at atau tanggal_review)
        $allReviews = $allReviews->sortByDesc(function ($review) {
            return $review->created_at ?? $review->tanggal_review;
        });

        // Hitung Statistik untuk Header (Rating Rata-rata & Total Ulasan)
        $totalUlasan = $allReviews->count();
        $avgRating = $totalUlasan > 0 ? round($allReviews->avg('rating'), 1) : 0;

        return view('makanan.show', compact('kuliner', 'allReviews', 'avgRating', 'totalUlasan'));
    }

    public function storeReview(Request $request)
    {
        // Validasi input review
        $request->validate([
            'nama_user' => 'required|string|max:50',
            'rumah_makan_id' => 'required|exists:rumah_makans,id',
            'rating' => 'required|integer|min:1|max:5',
            'komentar' => 'required|string|max:500',
        ]);

        // Simpan ke tabel reviews
        Review::create([
            'rumah_makan_id' => $request->rumah_makan_id,
            'nama_user' => $request->nama_user,
            'rating' => $request->rating,
            'komentar' => $request->komentar,
            'tanggal_review' => now(),
        ]);

        return back()->with('success', 'Terima kasih atas review Anda!');
    }
}
