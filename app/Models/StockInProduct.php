<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StockInProduct extends Model
{
    use HasFactory;

    protected $fillable = [
        'stok_produk_id',
        'vendor_id',
        'tanggal_masuk',
        'jumlah_masuk',
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

    // relation to Produk
    public function stokProduk()
    {
        return $this->belongsTo(StokProduk::class, 'stok_produk_id', 'id');
    }

    // relation to Vendor
    public function vendor()
    {
        return $this->belongsTo(Vendor::class, 'vendor_id', 'id');
    }

    protected function tanggalMasukFormatted() : Attribute {
        return Attribute::make(
            get: fn() => Carbon::parse($this->tanggal_masuk)->format('d/m/Y'),
        );
    }

    protected function statusLabel() : Attribute {
        return Attribute::make(
            get: fn() => $this->status == 'stock_ok' ? "Stock OK" : $this->status,
        );
    }
}
