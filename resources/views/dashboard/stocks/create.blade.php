@extends('layouts.app')
@section('title', 'Tambah Data Stok Produk')

@section('title-header', 'Tambah Data Stok Produk')
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{ route('stocks.index') }}">Data Stok Produk</a></li>
    <li class="breadcrumb-item active">Tambah Data Stok Produk</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card shadow">
                <div class="card-header bg-transparent border-0 text-dark">
                    <h5 class="mb-0">Formulir Tambah Data Stok Produk</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('stocks.store') }}" method="POST" role="form" enctype="multipart/form-data">
                        @csrf

                        <div class="row">
                            <div class="col-sm-12 col-md-12">
                                <div class="form-group mb-3">
                                    <label for="produk_id">Jenis Produk</label>
                                    <select class="form-control @error('produk_id') is-invalid @enderror" id="produk_id"
                                        name="produk_id">
                                        <option value="" selected>Pilih Jenis Produk</option>
                                        @foreach ($products as $product)
                                            <option value="{{ $product->id }}" @selected(old('produk_id'))>
                                                {{ $product->nama_produk }} | {{ $product->kode_sku }}
                                            </option>
                                        @endforeach
                                    </select>

                                    @error('produk_id')
                                        <div class="d-block invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-12 col-md-12">
                                <div class="form-group mb-3">
                                    <label for="warna_id">Warna Produk</label>
                                    <select class="form-control @error('warna_id') is-invalid @enderror" id="warna_id"
                                        name="warna_id">
                                        <option value="" selected>Pilih Warna Produk</option>
                                        @foreach ($colors as $color)
                                            <option value="{{ $color->id }}" @selected(old('warna_id'))>
                                                {{ $color->warna }} | {{ $color->kode_warna }}
                                            </option>
                                        @endforeach
                                    </select>

                                    @error('warna_id')
                                        <div class="d-block invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-12 col-md-12">
                                <div class="form-group mb-3">
                                    <label for="stok_minimum">Stok Minimum Produk</label>
                                    <input type="number" class="form-control @error('stok_minimum') is-invalid @enderror" id="stok_minimum"
                                        placeholder="Stok Minimum Produk" value="{{ old('stok_minimum') }}" name="stok_minimum">

                                    @error('stok_minimum')
                                        <div class="d-block invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-12 col-md-6">
                                <button type="submit" class="btn btn-sm btn-primary">Tambah</button>
                                <a href="{{ route('stocks.index') }}" class="btn btn-sm btn-secondary">Kembali</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
