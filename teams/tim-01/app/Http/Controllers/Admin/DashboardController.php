<?php

namespace App\Http\Controllers\Admin;

// package imports
use Illuminate\Routing\Controller;
use App\Models\Destination;
use App\Models\Category;
use App\Models\Review;
use App\Models\Admin;

class DashboardController extends Controller
{
    public function index()
    {
        // Menghitung total data untuk widget di dashboard
        $totalDestinations = Destination::count();
        $totalCategories = Category::count();
        
        // Hitung review yang masih pending (butuh tindakan admin)
        $pendingReviews = Review::where('status', 'pending')->count();
        
        // Ambil 5 review terbaru untuk ditampilkan di list dashboard
        $latestReviews = Review::with('destination')->latest()->take(5)->get();

        return view('admin.dashboard', compact(
            'totalDestinations', 
            'totalCategories', 
            'pendingReviews',
            'latestReviews'
        ));
    }
}