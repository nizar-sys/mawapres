<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StockOutProduct extends Model
{
    use HasFactory;

    protected $fillable = [
        'stok_produk_id',
        'vendor_id',
        'tanggal_keluar',
        'jumlah_keluar',
        'media_penjualan',
    ];

    // function boot
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($query) {
            $query->created_at = now();
        });

        static::updating(function ($query) {
            $query->updated_at = now();
        });
    }

    // relation to Vendor
    public function vendor()
    {
        return $this->belongsTo(Vendor::class, 'vendor_id', 'id');
    }

    public function stokProduk() {
        return $this->belongsTo(StokProduk::class, 'stok_produk_id', 'id');
    }

    protected function tanggalKeluarFormatted() : Attribute {
        return Attribute::make(
            get: fn() => Carbon::parse($this->tanggal_keluar)->format('d/m/Y'),
        );
    }
}
