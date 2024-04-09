<?php

namespace App\Http\Controllers;

use App\Models\StokProduk;
use Illuminate\Http\Request;
use App\Http\Requests\RequestStokProduk;
use App\Models\ProductColor;
use App\Models\Produk;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class StokProdukController extends Controller
{
    public function __construct() {
        $this->middleware('role.excepts:rnd,gudang')->except(['index', 'show']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $stocksData = StokProduk::query()
        ->select('stok_produks.*', 'produks.nama_produk', 'produks.kode_sku', 'product_colors.warna', 'product_colors.kode_warna')
        ->join('produks', 'produks.id', '=', 'stok_produks.produk_id')
        ->join('product_colors', 'product_colors.id', '=', 'stok_produks.warna_id')
        ->orderBy('produks.nama_produk')
        ->get();

        return view('dashboard.stocks.index', compact('stocksData'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $products = Produk::orderByDesc('id')->get();
        $colors = ProductColor::orderByDesc('id')->get();

        return view('dashboard.stocks.create', compact('products', 'colors'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RequestStokProduk $request)
    {
        $validated = $request->validated() + [
            'created_at' => now(),
        ];

        $stokWhereProductAndColor = StokProduk::where('produk_id', $validated['produk_id'])
        ->where('warna_id', $validated['warna_id'])
        ->first();

        if ($stokWhereProductAndColor) {
            return back()->with('error', 'Data stok gagal ditambahkan, karena data stok sudah ada.')->withInput()->withErrors(['warna_id' => 'Data stok sudah ada.']);
        }

        $newStok = StokProduk::create($validated);

        return redirect(route('stocks.index'))->with('success', 'Data stok berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return StokProduk::findOrFail($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $stock = StokProduk::findOrFail($id);
        $products = Produk::orderByDesc('id')->get();
        $colors = ProductColor::orderByDesc('id')->get();

        return view('dashboard.stocks.edit', compact('stock', 'products', 'colors'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(RequestStokProduk $request, $id)
    {
        $validated = $request->validated() + [
            'updated_at' => now(),
        ];

        $stock = StokProduk::findOrFail($id);
        $stock->update($validated);

        return redirect(route('stocks.index'))->with('success', 'Data stok berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $stock = StokProduk::findOrFail($id);
        $stock->delete();

        return redirect(route('stocks.index'))->with('success', 'Data stok berhasil dihapus.');
    }
}
