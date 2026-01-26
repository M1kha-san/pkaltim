<?php

namespace App\Http\Controllers\Admin;

// package imports
use Illuminate\Routing\Controller;
use App\Models\Destination;
use App\Models\Category;
use App\Models\Facility;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class DestinationController extends Controller
{
    public function index()
    {
        $destinations = Destination::with('category')->latest()->paginate(10);
        return view('admin.destinations.index', compact('destinations'));
    }

    public function create()
    {
        $categories = Category::all();
        $facilities = Facility::all();
        return view('admin.destinations.create', compact('categories', 'facilities'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'description' => 'required',
            'category_id' => 'required',
            'images.*' => 'image|mimes:jpeg,png,jpg|max:2048', // Validasi foto
        ]);

        // 1. Simpan Data Utama
        $destination = Destination::create([
            'category_id' => $request->category_id,
            'name' => $request->name,
            'slug' => Str::slug($request->name), // Bikin slug otomatis
            'description' => $request->description,
            'address' => $request->address,
            'price' => $request->price,
            'price_note' => $request->price_note,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
            'opening_hours' => $request->opening_hours,
        ]);

        // 2. Simpan Fasilitas (Pivot Table)
        if ($request->has('facilities')) {
            $destination->facilities()->attach($request->facilities);
        }

        // 3. Upload Gambar
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $index => $image) {
                $path = $image->store('destinations', 'public');
                
                $destination->images()->create([
                    'image_path' => $path,
                    'is_primary' => $index == 0 ? true : false, // Gambar pertama jadi cover
                ]);
            }
        }

        return redirect()->route('destinations.index')->with('success', 'Wisata berhasil ditambahkan');
    }

    public function edit(Destination $destination)
    {
        $categories = Category::all();
        $facilities = Facility::all();
        return view('admin.destinations.edit', compact('destination', 'categories', 'facilities'));
    }

    public function update(Request $request, Destination $destination)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'description' => 'required',
            'category_id' => 'required',
            'images.*' => 'image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // 1. Update Data Utama
        $destination->update([
            'category_id' => $request->category_id,
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'description' => $request->description,
            'address' => $request->address,
            'price' => $request->price,
            'price_note' => $request->price_note,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
            'opening_hours' => $request->opening_hours,
        ]);

        // 2. Update Fasilitas (Pivot Table)
        if ($request->has('facilities')) {
            $destination->facilities()->sync($request->facilities);
        }

        // 3. Upload Gambar Baru
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $index => $image) {
                $path = $image->store('destinations', 'public');
                
                $destination->images()->create([
                    'image_path' => $path,
                    'is_primary' => false,
                ]);
            }
        }

        return redirect()->route('destinations.index')->with('success', 'Wisata berhasil diperbarui');
    }

    public function destroy(Destination $destination)
    {
        // 1. Hapus Fasilitas
        $destination->facilities()->detach();

        // 2. Hapus Gambar dari Storage
        foreach ($destination->images as $image) {
            Storage::disk('public')->delete($image->image_path);
            $image->delete();
        }

        // 3. Hapus Data Wisata
        $destination->delete();

        return redirect()->route('destinations.index')->with('success', 'Wisata berhasil dihapus');
    }
}