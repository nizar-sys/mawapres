@extends('layouts.app')
@section('title', 'Tambah Data Warna Produk')

@section('title-header', 'Tambah Data Warna Produk')
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{ route('colors.index') }}">Data Warna Produk</a></li>
    <li class="breadcrumb-item active">Tambah Data Warna Produk</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card shadow">
                <div class="card-header bg-transparent border-0 text-dark">
                    <h5 class="mb-0">Formulir Tambah Data Warna Produk</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('colors.store') }}" method="POST" role="form" enctype="multipart/form-data">
                        @csrf

                        <div class="row">
                            <div class="col-sm-12 col-md-6">
                                <div class="form-group mb-3">
                                    <label for="warna">Warna Produk</label>
                                    <input type="text" class="form-control @error('warna') is-invalid @enderror" id="warna"
                                        placeholder="Warna Produk" value="{{ old('warna') }}" name="warna">

                                    @error('warna')
                                        <div class="d-block invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6">
                                <div class="form-group mb-3">
                                    <label for="kode_warna">Kode Warna Produk</label>
                                    <input type="text" class="form-control @error('kode_warna') is-invalid @enderror" id="kode_warna"
                                        placeholder="Kode Warna Produk" value="{{ old('kode_warna') }}" name="kode_warna">

                                    @error('kode_warna')
                                        <div class="d-block invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-12 col-md-6">
                                <button type="submit" class="btn btn-sm btn-primary">Tambah</button>
                                <a href="{{route('colors.index')}}" class="btn btn-sm btn-secondary">Kembali</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
