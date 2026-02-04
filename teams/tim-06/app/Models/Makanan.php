<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Makanan extends Model
{
    protected $fillable = [
        'nama_makanan',
        'deskripsi',
        'asal_daerah',
        'gambar'
    ];

    // Satu makanan bisa dijual di BANYAK rumah makan (relasi many-to-many melalui tabel pivot 'menus')
    public function rumahMakans()
    {
        return $this->belongsToMany(RumahMakan::class, 'menus', 'makanan_id', 'rumah_makan_id')
            ->withPivot('harga') 
            ->withTimestamps();
    }

    // Aksesor untuk mendapatkan rating rata-rata dari semua rumah makan yang menjual makanan ini
    public function getRatingRataRataAttribute()
    {
        $totalBintang = 0;
        $jumlahReview = 0;

        foreach ($this->rumahMakans as $rm) {
            foreach ($rm->reviews as $review) {
                $totalBintang += $review->rating;
                $jumlahReview++;
            }
        }

        if ($jumlahReview == 0) return 0;

        return round($totalBintang / $jumlahReview, 1);
    }

    // Aksesor untuk mendapatkan jumlah ulasan keseluruhan dari semua rumah makan yang menjual makanan ini
    public function getJumlahUlasanAttribute()
    {
        $jumlah = 0;
        foreach ($this->rumahMakans as $rm) {
            $jumlah += $rm->reviews->count();
        }
        return $jumlah;
    }
}
