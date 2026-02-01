<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\Admin;
use App\Models\Category;
use App\Models\Destination;
use App\Models\Review;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Seed Admin
        Admin::create([
            'username' => 'admin',
            'password' => Hash::make('password'),
        ]);

        // 2. Seed Categories
        $categories = [
            [
                'name' => 'Wisata Bahari',
                'description' => 'Keindahan laut dan pantai Kalimantan Timur'
            ],
            [
                'name' => 'Wisata Alam',
                'description' => 'Hutan, gunung, dan danau yang asri'
            ],
            [
                'name' => 'Wisata Budaya',
                'description' => 'Kekayaan budaya dan sejarah lokal'
            ]
        ];

        foreach ($categories as $cat) {
            Category::create([
                'name' => $cat['name'],
                'slug' => Str::slug($cat['name']),
                'description' => $cat['description']
            ]);
        }

        // 3. Seed Destinations
        $bahari = Category::where('slug', 'wisata-bahari')->first();
        $alam = Category::where('slug', 'wisata-alam')->first();
        $budaya = Category::where('slug', 'wisata-budaya')->first();

        $destinations = [
            [
                'category_id' => $bahari->id,
                'name' => 'Pulau Derawan',
                'slug' => 'pulau-derawan',
                'description' => 'Surga menyelam kelas dunia dengan penyu hijau raksasa.',
                'address' => 'Kepulauan Derawan, Berau',
                'price' => 50000,
                'price_note' => '/ orang',
                'opening_hours' => '24 Jam',
                'status' => 'active'
            ],
            [
                'category_id' => $alam->id,
                'name' => 'Labuan Cermin',
                'slug' => 'labuan-cermin',
                'description' => 'Danau dua rasa yang jernih sebening kristal.',
                'address' => 'Biduk-Biduk, Berau',
                'price' => 25000,
                'price_note' => '/ orang',
                'opening_hours' => '08:00 - 17:00',
                'status' => 'active'
            ],
            [
                'category_id' => $budaya->id,
                'name' => 'Desa Budaya Pampang',
                'slug' => 'desa-budaya-pampang',
                'description' => 'Melihat kehidupan suku Dayak Kenyah secara langsung.',
                'address' => 'Samarinda Utara',
                'price' => 40000,
                'price_note' => '/ orang',
                'opening_hours' => 'Minggu 14:00 - 16:00',
                'status' => 'active'
            ]
        ];

        foreach ($destinations as $dest) {
            $newDest = Destination::create($dest);

            // Seed Reviews for each destination
            Review::create([
                'destination_id' => $newDest->id,
                'visitor_name' => 'Budi Traveler',
                'rating' => 5,
                'comment' => 'Tempat yang sangat luar biasa indah!',
                'status' => 'approved'
            ]);

            Review::create([
                'destination_id' => $newDest->id,
                'visitor_name' => 'Siti Petualang',
                'rating' => 4,
                'comment' => 'Akses jalan perlu diperbaiki, tapi pemandangannya worth it.',
                'status' => 'pending'
            ]);
        }
    }
}
