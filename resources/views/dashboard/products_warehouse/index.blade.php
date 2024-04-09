@extends('layouts.app')
@section('title', 'Data Produk Di Gudang')

@section('title-header', 'Data Produk Di Gudang')
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
    <li class="breadcrumb-item active">Data Produk Di Gudang</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card shadow">
                <div class="card-header bg-transparent border-0 text-dark">
                    <h2 class="card-title h3">Data Produk Di Gudang</h2>
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead class="text-center">
                                <tr>
                                    <th rowspan="3">Nama Produk</th>
                                    <th rowspan="3">Kode SKU</th>
                                    <th colspan="{{ $warna->count() }}">Warna</th>
                                </tr>
                                <tr>
                                    @foreach ($warna as $item)
                                    <td>{{ $item->warna }}</td>
                                    @endforeach
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($products as $item)
                                    <tr>
                                        <td>{{ $item->nama_produk }}</td>
                                        <td>{{ $item->kode_sku }}</td>
                                        @php
                                            $stocks = explode(',', $item->stok);
                                        @endphp
                                        @foreach ($stocks as $stock)
                                            <td>{{ $stock }}</td>
                                        @endforeach
                                        @if ($warna->count() > count($stocks))
                                            @php
                                                $selisih = $warna->count() - count($stocks);
                                            @endphp
                                            @for ($i = 0; $i < $selisih; $i++)
                                                <td>0</td>
                                            @endfor
                                        @endif
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
