<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_produk',
        'kode_sku',
    ];

    // function boot
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($produk) {
            $produk->created_at = now();
        });

        static::updating(function ($produk) {
            $produk->updated_at = now();
        });
    }
}
