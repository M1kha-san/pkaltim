<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Makanan;
use App\Models\RumahMakan;
use App\Models\Review;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        // Menghitung total data untuk statistik
        $totalMakanan = Makanan::count();
        $totalRumahMakan = RumahMakan::count();
        $totalReview = Review::count();
        $totalDaerah = DB::table('makanans')->distinct('asal_daerah')->count('asal_daerah');

        // Mendapatkan 5 rumah makan dengan rata-rata rating tertinggi
        $topRumahMakan = RumahMakan::with('reviews')->get()
                                ->sortByDesc('rata_rata_rating')
                                ->take(5);

        // Menghitung jumlah makanan per asal daerah untuk grafik
        $kulinerPerDaerah = Makanan::select('asal_daerah', DB::raw('count(*) as total'))
                                ->groupBy('asal_daerah')
                                ->get();

        return view('admin.dashboard', compact(
            'totalMakanan',
            'totalRumahMakan',
            'totalReview',
            'totalDaerah',
            'kulinerPerDaerah',
            'topRumahMakan'
        ));
    }
}
