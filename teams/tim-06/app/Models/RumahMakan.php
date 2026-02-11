<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RumahMakan extends Model
{
    protected $fillable = [
        'nama_rumah_makan',
        'alamat',
        'latitude',
        'longitude',
        'no_telpon'
    ];

    // Satu rumah makan menjual BANYAK makanan (relasi many-to-many melalui tabel pivot 'menus')
    public function makanans()
    {
        return $this->belongsToMany(Makanan::class, 'menus', 'rumah_makan_id', 'makanan_id')
            ->withPivot('harga')
            ->withTimestamps();
    }

    // Satu rumah makan bisa memiliki banyak menu (relasi one-to-many)
    // public function menus()
    // {
    //     return $this->hasMany(Menu::class);
    // }

    // Satu rumah makan bisa memiliki banyak ulasan (relasi one-to-many)
    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    // Fitur Helper: Hitung rata-rata rating otomatis
    public function getRataRataRatingAttribute()
    {
        return round($this->reviews()->avg('rating'), 1); 
    }
}
