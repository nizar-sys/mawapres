<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StokProduk extends Model
{
    use HasFactory;

    protected $fillable = [
        'produk_id',
        'warna_id',
        'stok_minimum',
        'status',
        'stok',
        'stok_awal'
    ];

    // function boot
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($query) {
            $query->created_at = now();
        });

        static::updating(function ($query) {
            $query->status = $query->stok <= $query->stok_minimum ? 'restock' : 'stock_ok';
            $query->updated_at = now();
        });
    }

    // relation to Produk

    public function produk()
    {
        return $this->belongsTo(Produk::class, 'produk_id');
    }

    // relation to ProductColor

    public function warna()
    {
        return $this->belongsTo(ProductColor::class, 'warna_id');
    }

    protected function statusLabel() : Attribute {
        return Attribute::make(
            get: function(){
                // render as badge
                if ($this->status == 'restock') {
                    return '<span class="badge badge-danger">Restock</span>';
                } else {
                    return '<span class="badge badge-success">Stock OK</span>';
                }
            }
        );
    }

    public function stokMasuk() {
        return $this->hasMany(StockInProduct::class, 'stok_produk_id', 'id');
    }

    public function stokKeluar() {
        return $this->hasMany(StockOutProduct::class, 'stok_produk_id', 'id');
    }
}
