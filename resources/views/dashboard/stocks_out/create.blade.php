@extends('layouts.app')
@section('title', 'Tambah Data Produk Keluar')

@section('title-header', 'Tambah Data Produk Keluar')
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{ route('stocks-out.index') }}">Data Produk Keluar</a></li>
    <li class="breadcrumb-item active">Tambah Data Produk Keluar</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card shadow">
                <div class="card-header bg-transparent border-0 text-dark">
                    <h5 class="mb-0">Formulir Tambah Data Produk Keluar</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('stocks-out.store') }}" method="POST" role="form"
                        enctype="multipart/form-data">
                        @csrf

                        <div class="row">
                            <div class="col-sm-12 col-md-12">
                                <div class="form-group mb-3">
                                    <label for="stok_produk_id">Nama Produk</label>
                                    <select class="form-control @error('stok_produk_id') is-invalid @enderror"
                                        id="stok_produk_id" placeholder="Nama Produk" name="stok_produk_id">
                                        <option value="">Pilih Nama Produk</option>
                                        @foreach ($stokProducts as $stok)
                                            <option value="{{ $stok->id }}" @selected(old('stok_produk_id') == $stok->id)>
                                                {{ $stok->produk->kode_sku }} | {{ $stok->produk->nama_produk }} |
                                                {{ $stok->warna->warna }}</option>
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
                                            <option value="{{ $vendor->id }}" @selected(old('vendor_id') == $vendor->id)>
                                                {{ $vendor->nama_vendor }}</option>
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
                                    <label for="tanggal_keluar">Tanggal Keluar Produk</label>
                                    <input type="date" class="form-control @error('tanggal_keluar') is-invalid @enderror"
                                        id="tanggal_keluar" placeholder="Tanggal Keluar Produk"
                                        value="{{ old('tanggal_keluar') }}" name="tanggal_keluar">

                                    @error('tanggal_keluar')
                                        <div class="d-block invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6">
                                <div class="form-group mb-3">
                                    <label for="jumlah_keluar">Jumlah Keluar Produk</label>
                                    <input type="number" class="form-control @error('jumlah_keluar') is-invalid @enderror"
                                        id="jumlah_keluar" placeholder="Jumlah Keluar Produk"
                                        value="{{ old('jumlah_keluar') }}" name="jumlah_keluar">

                                    @error('jumlah_keluar')
                                        <div class="d-block invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-12 col-md-12">
                                <div class="form-group mb-3">
                                    <label for="media_penjualan">Media Penjualan</label>
                                    <select class="form-control @error('media_penjualan') is-invalid @enderror"
                                        id="media_penjualan" placeholder="Media Penjualan" name="media_penjualan">
                                        <option value="">Pilih Media Penjualan</option>
                                        @php
                                            $statuses = ['offline', 'online'];
                                        @endphp
                                        @foreach ($statuses as $media_penjualan)
                                            <option value="{{ $media_penjualan }}" @selected(old('media_penjualan') == $media_penjualan)>
                                                {{ $media_penjualan == 'online' ? 'Online' : 'Offline' }}</option>
                                        @endforeach
                                    </select>

                                    @error('media_penjualan')
                                        <div class="d-block invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-12 col-md-6">
                                <button type="submit" class="btn btn-sm btn-primary">Tambah</button>
                                <a href="{{ route('stocks-out.index') }}" class="btn btn-sm btn-secondary">Kembali</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
