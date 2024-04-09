<?php

namespace App\Http\Controllers;

use App\Models\ProductColor;
use Illuminate\Http\Request;
use App\Http\Requests\RequestProductColor;
use Illuminate\Support\Facades\Hash;

class ProductColorController extends Controller
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
        $colors = ProductColor::orderByDesc('id')->get();

        return view('dashboard.colors.index', compact('colors'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.colors.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RequestProductColor $request)
    {
        $validated = $request->validated() + [
            'created_at' => now(),
        ];

        $color = ProductColor::create($validated);

        return redirect(route('colors.index'))->with('success', 'Data warna produk berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return ProductColor::findOrFail($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $color = ProductColor::findOrFail($id);

        return view('dashboard.colors.edit', compact('color'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(RequestProductColor $request, $id)
    {
        $validated = $request->validated() + [
            'updated_at' => now(),
        ];

        $color = ProductColor::findOrFail($id);

        $color->update($validated);

        return redirect(route('colors.index'))->with('success', 'Data warna produk berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $color = ProductColor::findOrFail($id);
        $color->delete();

        return redirect(route('colors.index'))->with('success', 'Data warna produk berhasil dihapus.');
    }
}
