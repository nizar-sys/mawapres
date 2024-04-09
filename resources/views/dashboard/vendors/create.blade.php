@extends('layouts.app')
@section('title', 'Tambah Data Vendor')

@section('title-header', 'Tambah Data Vendor')
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{ route('vendors.index') }}">Data Vendor</a></li>
    <li class="breadcrumb-item active">Tambah Data Vendor</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card shadow">
                <div class="card-header bg-transparent border-0 text-dark">
                    <h5 class="mb-0">Formulir Tambah Data Vendor</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('vendors.store') }}" method="POST" role="form" enctype="multipart/form-data">
                        @csrf

                        <div class="row">
                            <div class="col-sm-12 col-md-6">
                                <div class="form-group mb-3">
                                    <label for="nama_vendor">Nama Vendor</label>
                                    <input type="text" class="form-control @error('nama_vendor') is-invalid @enderror" id="nama_vendor"
                                        placeholder="Nama Vendor" value="{{ old('nama_vendor') }}" name="nama_vendor">

                                    @error('nama_vendor')
                                        <div class="d-block invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6">
                                <div class="form-group mb-3">
                                    <label for="kontak">Kontak</label>
                                    <input type="text" class="form-control @error('kontak') is-invalid @enderror" id="kontak"
                                        placeholder="Kontak" value="{{ old('kontak') }}" name="kontak">

                                    @error('kontak')
                                        <div class="d-block invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-12 col-md-6">
                                <button type="submit" class="btn btn-sm btn-primary">Tambah</button>
                                <a href="{{route('vendors.index')}}" class="btn btn-sm btn-secondary">Kembali</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
