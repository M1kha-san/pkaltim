<?php

namespace App\Http\Controllers;

// package imports
use App\Models\Destination;
use App\Models\Category;
use Illuminate\Routing\Controller;
use App\Models\Review;
use Illuminate\Http\Request;

class PublicController extends Controller
{
    public function index()
    {
        // Ambil 6 wisata terbaru
        $destinations = Destination::with('images')->where('status', 'active')->latest()->take(6)->get();
        $categories = Category::all();
        
        return view('front.home', compact('destinations', 'categories'));
    }

    public function show($slug)
    {
        // Ambil detail wisata + gambar + fasilitas + review yg approved
        $destination = Destination::with(['images', 'facilities', 'approvedReviews'])
                        ->where('slug', $slug)
                        ->firstOrFail();

        return view('front.detail', compact('destination'));
    }

    public function storeReview(Request $request, $id)
    {
        $request->validate([
            'visitor_name' => 'required|string',
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'required|string',
        ]);

        Review::create([
            'destination_id' => $id,
            'visitor_name' => $request->visitor_name,
            'rating' => $request->rating,
            'comment' => $request->comment,
            'status' => 'pending' // Default pending agar dicek admin dulu
        ]);

        return back()->with('success', 'Terima kasih! Ulasan Anda menunggu persetujuan admin.');
    }
}