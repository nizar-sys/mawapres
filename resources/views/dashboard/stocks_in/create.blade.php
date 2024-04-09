@extends('layouts.app')
@section('title', 'Tambah Data Produk Masuk')

@section('title-header', 'Tambah Data Produk Masuk')
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{ route('stocks-in.index') }}">Data Produk Masuk</a></li>
    <li class="breadcrumb-item active">Tambah Data Produk Masuk</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card shadow">
                <div class="card-header bg-transparent border-0 text-dark">
                    <h5 class="mb-0">Formulir Tambah Data Produk Masuk</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('stocks-in.store') }}" method="POST" role="form"
                        enctype="multipart/form-data">
                        @csrf

                        <div class="row">
                            <div class="col-sm-12 col-md-12">
                                <div class="form-group mb-3">
                                    <label for="stok_produk_id">Nama Produk</label>
                                    <select class="form-control @error('stok_produk_id') is-invalid @enderror" id="stok_produk_id"
                                        placeholder="Nama Produk" name="stok_produk_id">
                                        <option value="">Pilih Nama Produk</option>
                                        @foreach ($stokProducts as $stok)
                                            <option value="{{ $stok->id }}" @selected(old('stok_produk_id') == $stok->id)>{{ $stok->produk->kode_sku }} | {{ $stok->produk->nama_produk }} | {{ $stok->warna->warna }}</option>
                                        @endforeach
                                    </select>

                                    @error('stok_produk_id')
                                        <div class="d-block invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-12 col-md-12">
                                <div class="form-group mb-3">
                                    <label for="vendor_id">Vendor</label>
                                    <select class="form-control @error('vendor_id') is-invalid @enderror" id="vendor_id"
                                        placeholder="Vendor" name="vendor_id">
                                        <option value="">Pilih Vendor</option>
                                        @foreach ($vendors as $vendor)
                                            <option value="{{ $vendor->id }}" @selected(old('vendor_id') == $vendor->id)>{{ $vendor->nama_vendor }}</option>
                                        @endforeach
                                    </select>

                                    @error('vendor_id')
                                        <div class="d-block invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-12 col-md-6">
                                <div class="form-group mb-3">
                                    <label for="tanggal_masuk">Tanggal Masuk Produk</label>
                                    <input type="date" class="form-control @error('tanggal_masuk') is-invalid @enderror" id="tanggal_masuk"
                                        placeholder="Tanggal Masuk Produk" value="{{ old('tanggal_masuk') }}" name="tanggal_masuk">

                                    @error('tanggal_masuk')
                                        <div class="d-block invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6">
                                <div class="form-group mb-3">
                                    <label for="jumlah_masuk">Jumlah Masuk Produk</label>
                                    <input type="number" class="form-control @error('jumlah_masuk') is-invalid @enderror" id="jumlah_masuk"
                                        placeholder="Jumlah Masuk Produk" value="{{ old('jumlah_masuk') }}" name="jumlah_masuk">

                                    @error('jumlah_masuk')
                                        <div class="d-block invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-12 col-md-6">
                                <button type="submit" class="btn btn-sm btn-primary">Tambah</button>
                                <a href="{{ route('stocks-in.index') }}" class="btn btn-sm btn-secondary">Kembali</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
