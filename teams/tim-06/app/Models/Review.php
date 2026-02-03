<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $fillable = [
        'rumah_makan_id',
        'nama_user',
        'rating',
        'komentar',
        'tanggal_review'
    ];

    // Satu ulasan milik satu rumah makan (relasi many-to-one)
    public function rumahMakan()
    {
        return $this->belongsTo(RumahMakan::class);
    }
}
