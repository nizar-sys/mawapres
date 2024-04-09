<?php

namespace App\Http\Controllers;

use App\Models\StockOutProduct;
use Illuminate\Http\Request;
use App\Http\Requests\RequestStockOutProduct;
use App\Models\ProductColor;
use App\Models\Produk;
use App\Models\StokProduk;
use App\Models\Vendor;
use Illuminate\Support\Facades\Hash;

class StockOutProductController extends Controller
{
    public function __construct() {
        $this->middleware('role.excepts:gudang')->except(['index', 'show']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $stocksOut = StockOutProduct::orderByDesc('id')
        ->with(['stokProduk','vendor'])
        ->get();

        return view('dashboard.stocks_out.index', compact('stocksOut'));
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

        return view('dashboard.stocks_out.create', compact('stokProducts', 'colors', 'vendors'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RequestStockOutProduct $request)
    {
        $validated = $request->validated() + [
            'created_at' => now(),
        ];

        $stokProduct = StokProduk::findOrFail($request->stok_produk_id);
        $totalStok = $stokProduct->stok - (int) $request->jumlah_keluar;

        if ($stokProduct->stok < $request->jumlah_keluar) {
            return redirect(route('stocks-out.create'))->with('error', 'Stok produk tidak mencukupi.')->withInput()->withErrors(['jumlah_keluar' => 'Stok produk tidak mencukupi.']);
        }

        StockOutProduct::create($validated);

        $stokProduct->update([
            'stok' => $totalStok,
        ]);

        return redirect(route('stocks-out.index'))->with('success', 'Data stok keluar berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return StockOutProduct::findOrFail($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $stockOut = StockOutProduct::findOrFail($id);
        $stokProducts = StokProduk::whereId($stockOut->stok_produk_id)->get();
        $colors = ProductColor::orderByDesc('id')->get();
        $vendors = Vendor::orderByDesc('id')->get();

        return view('dashboard.stocks_out.edit', compact('stockOut', 'stokProducts', 'colors', 'vendors'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(RequestStockOutProduct $request, $id)
    {
        $validated = $request->validated() + [
            'updated_at' => now(),
        ];

        $stockOut = StockOutProduct::findOrFail($id);

        $stokKeluarLama = $stockOut->jumlah_keluar;
        $stokKeluarBaru = $request->jumlah_keluar;

        $stokProduct = $stockOut->stokProduk;
        $totalStok = $stokProduct->stok - ($stokKeluarBaru - $stokKeluarLama);

        if ($stokProduct->stok < ($stokKeluarBaru - $stokKeluarLama)) {
            return redirect(route('stocks-out.edit', $id))->with('error', 'Stok produk tidak mencukupi.')->withInput()->withErrors(['jumlah_keluar' => 'Stok produk tidak mencukupi.']);
        }

        $stockOut->update($validated);

        $stokProduct->update([
            'stok' => $totalStok,
        ]);

        return redirect(route('stocks-out.index'))->with('success', 'Data stok keluar berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $stockOut = StockOutProduct::findOrFail($id);

        $stokProduct = $stockOut->stokProduk;

        $stokProduct->update([
            'stok' => $stokProduct->stok + (int) $stockOut->jumlah_keluar,
        ]);
        $stockOut->delete();

        return redirect(route('stocks-out.index'))->with('success', 'Data stok keluar berhasil dihapus.');
    }
}
