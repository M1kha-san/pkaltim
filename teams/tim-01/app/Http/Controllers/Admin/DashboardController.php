<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Destination; // ✅ Import Model Destination
use App\Models\Category;    // ✅ Import Model Category
// use App\Models\Review;   // ⚠️ Buka komentar ini jika sudah punya model Review

class DashboardController extends Controller
{
    public function index()
    {
        // 1. Ambil Data ASLI dari Database (Bukan Dummy)
        $totalDestinations = Destination::count();
        
        // 2. Jika belum punya tabel reviews, kita bisa pakai Category dulu atau set 0
        // $totalReviews = Review::count(); 
        $totalReviews = 0; // Ganti baris ini dengan Review::count() jika model sudah ada
        
        // 3. Kirim data ke View baru
        return view('admin.Dashboard', compact('totalDestinations', 'totalReviews'));
    }
}