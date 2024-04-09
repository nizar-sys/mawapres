<?php

namespace App\Http\Controllers;

use App\Models\StockInProduct;
use Illuminate\Http\Request;
use App\Http\Requests\RequestStockInProduct;
use App\Models\ProductColor;
use App\Models\Produk;
use App\Models\StokProduk;
use App\Models\Vendor;
use Illuminate\Support\Facades\Hash;

class StockInProductController extends Controller
{
    public function __construct() {
        $this->middleware('role.excepts:admin')->except(['index', 'show']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $stocksIn = StockInProduct::orderByDesc('id')
        ->with(['stokProduk', 'vendor'])
        ->get();

        return view('dashboard.stocks_in.index', compact('stocksIn'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $stokProducts = StokProduk::orderByDesc('id')->get();
        $colors = ProductColor::orderByDesc('id')->get();
        $vendors = Vendor::orderByDesc('id')->get();

        return view('dashboard.stocks_in.create', compact('stokProducts', 'colors', 'vendors'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RequestStockInProduct $request)
    {
        $validated = $request->validated() + [
            'created_at' => now(),
        ];

        $stokProduct = StokProduk::findOrFail($request->stok_produk_id);
        $stockIn = StockInProduct::create($validated);
        $stokProduct->update([
            'stok' => $stokProduct->stok + (int) $stockIn->jumlah_masuk - $stokProduct->stokKeluar->sum('jumlah_keluar'),
        ]);

        return redirect(route('stocks-in.index'))->with('success', 'Data stok masuk berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return StockInProduct::findOrFail($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $stockIn = StockInProduct::findOrFail($id);
        $stokProducts = StokProduk::whereId($stockIn->stok_produk_id)->get();
        $colors = ProductColor::orderByDesc('id')->get();
        $vendors = Vendor::orderByDesc('id')->get();

        return view('dashboard.stocks_in.edit', compact('stockIn', 'stokProducts', 'colors', 'vendors'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(RequestStockInProduct $request, $id)
    {
        $validated = $request->validated() + [
            'updated_at' => now(),
        ];

        $stockIn = StockInProduct::findOrFail($id);
        $stokProduct = $stockIn->stokProduk;

        $stokMasukLama = $stockIn->jumlah_masuk;
        $stokMasukBaru = $request->jumlah_masuk;
        $totalStok = $stokProduct->stok + (int) $stokMasukBaru - (int) $stokMasukLama;


        if($totalStok < 0) return back()->with('error', 'Stok tidak boleh kurang dari 0.');

        $stockIn->update($validated);
        $stokProduct->update([
            'stok' => $totalStok,
        ]);

        return redirect(route('stocks-in.index'))->with('success', 'Data stok masuk berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $stockIn = StockInProduct::findOrFail($id);
        $stokMasukLama = $stockIn->jumlah_masuk;
        $stokProduct = $stockIn->stokProduk;
        $totalStok = $stokProduct->stok - (int) $stokMasukLama;

        $stokProduct->update([
            'stok' => $totalStok,
        ]);

        $stockIn->delete();

        return redirect(route('stocks-in.index'))->with('success', 'Data stok masuk berhasil dihapus.');
    }
}
