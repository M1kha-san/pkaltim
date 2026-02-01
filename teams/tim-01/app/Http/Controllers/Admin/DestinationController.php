<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Destination;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class DestinationController extends Controller
{
    public function index()
    {
        // Pastikan di Model Destination fungsinya bernama 'categories'
        $destinations = Destination::with('categories')->latest()->paginate(10);
        $categories = Category::all();

        $totalDestinations = Destination::count();
        $totalReviews = 0;

        return view('admin.Index', compact('destinations', 'categories', 'totalDestinations', 'totalReviews'));
    }

    public function store(Request $request)
    {
        // 1. Validasi
        $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required',
            'description' => 'required',
            'price' => 'required|numeric',
            'address' => 'required|string', // Validasi input 'address'
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // 2. Upload Gambar
        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('destinations', 'public');
        }

        // 3. Simpan ke Database
        Destination::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'category_id' => $request->category_id,
            'description' => $request->description,
            'price' => $request->price,

            // --- BAGIAN YANG DIPERBAIKI ---
            'address' => $request->address, // Dulu $request->location (salah)
            // ------------------------------

            'image' => $imagePath,
        ]);

        return redirect()->back()->with('success', 'Destinasi berhasil ditambahkan!');
    }

    public function update(Request $request, $id)
    {
        $destination = Destination::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required',
            'description' => 'required',
            'price' => 'required|numeric',
            'address' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $data = [
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'category_id' => $request->category_id,
            'description' => $request->description,
            'price' => $request->price,

            // --- BAGIAN YANG DIPERBAIKI ---
            'address' => $request->address, // Dulu $request->location (salah)
            // ------------------------------
        ];

        // Cek jika ganti gambar
        if ($request->hasFile('image')) {
            if ($destination->image) {
                Storage::disk('public')->delete($destination->image);
            }
            $data['image'] = $request->file('image')->store('destinations', 'public');
        }

        $destination->update($data);

        return redirect()->back()->with('success', 'Destinasi berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $destination = Destination::findOrFail($id);

        if ($destination->image) {
            Storage::disk('public')->delete($destination->image);
        }

        $destination->delete();

        return redirect()->back()->with('success', 'Destinasi berhasil dihapus!');
    }
}