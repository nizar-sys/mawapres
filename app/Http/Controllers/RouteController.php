<?php

namespace App\Http\Controllers;

use App\Models\ProductColor;
use App\Models\Produk;
use App\Models\StockInProduct;
use App\Models\StockOutProduct;
use App\Models\StokProduk;
use App\Models\User;
use App\Models\Vendor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RouteController extends Controller
{
    public function dashboard()
    {
        $products = StokProduk::query()
                ->join('produks', 'produks.id', 'stok_produks.produk_id')
                ->select('produks.nama_produk', 'produks.kode_sku', DB::raw('GROUP_CONCAT(COALESCE(stok_produks.stok, 0)) as stok'))
                ->groupBy('produks.nama_produk', 'produks.kode_sku')
                ->get();

        $warna = ProductColor::select('warna', 'kode_warna')
                ->get();

        $totalStokMasukProduct = StockInProduct::selectRaw('stok_produk_id, SUM(jumlah_masuk) as total_jumlah_masuk, nama_produk, kode_sku')
                ->join('stok_produks', 'stok_produks.id', 'stock_in_products.stok_produk_id')
                ->leftJoin('produks', 'produks.id', 'stok_produks.produk_id')
                ->groupBy('stok_produk_id')
                ->get();

        $trenProdukMasuk = StockInProduct::selectRaw('tanggal_masuk, SUM(jumlah_masuk) as total_jumlah_masuk')
                ->groupBy('tanggal_masuk')
                ->orderBy('tanggal_masuk')
                ->get();

        $totalStokKeluarProduct = StockOutProduct::selectRaw('stok_produk_id, SUM(jumlah_keluar) as total_jumlah_keluar, nama_produk, kode_sku')
        ->join('stok_produks', 'stok_produks.id', 'stock_out_products.stok_produk_id')
        ->leftJoin('produks', 'produks.id', 'stok_produks.produk_id')
        ->groupBy('stok_produk_id')
        ->get();

        $trenProdukKeluar = StockOutProduct::selectRaw('tanggal_keluar, SUM(jumlah_keluar) as total_jumlah_keluar')
                ->groupBy('tanggal_keluar')
                ->orderBy('tanggal_keluar')
                ->get();

        $countData = [
            'pengguna' => User::count(),
            'produk' => Produk::count(),
            'warna_produk' => ProductColor::count(),
            'vendor' => Vendor::count(),
            'total_stok_produk' => StokProduk::sum('stok'),
            'total_stok_masuk' => StockInProduct::sum('jumlah_masuk'),
            'total_stok_keluar' => StockOutProduct::sum('jumlah_keluar'),
        ];

        return view('dashboard.index', compact('products', 'warna', 'totalStokMasukProduct' , 'trenProdukMasuk', 'totalStokKeluarProduct', 'trenProdukKeluar', 'countData'));
    }
}
