@extends('layouts.app')
@section('title', 'Dashboard')
@php
    $auth = Auth::user();
@endphp

@section('breadcrumb')
    <li class="breadcrumb-item active"><a href="{{ route('home') }}">Dashboard</a></li>
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="row">
                <a class="col-lg-4 col-md-6 col-12 text-dark" href="{{ route('users.index', []) }}">
                    <div class="card  mb-4">
                        <div class="card-body p-3">
                            <div class="row">
                                <div class="col-8">
                                    <div class="numbers">
                                        <p class="text-sm mb-0 text-uppercase font-weight-bold">Total Pengguna</p>
                                        <h3 class="font-weight-bolder">
                                            {{ $countData['pengguna'] }}
                                        </h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
                <a class="col-lg-4 col-md-6 col-12 text-dark" href="{{ route('products.index', []) }}">
                    <div class="card  mb-4">
                        <div class="card-body p-3">
                            <div class="row">
                                <div class="col-8">
                                    <div class="numbers">
                                        <p class="text-sm mb-0 text-uppercase font-weight-bold">Total Produk</p>
                                        <h3 class="font-weight-bolder">
                                            {{ $countData['produk'] }}
                                        </h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
                <a class="col-lg-4 col-md-6 col-12 text-dark" href="{{ route('colors.index', []) }}">
                    <div class="card  mb-4">
                        <div class="card-body p-3">
                            <div class="row">
                                <div class="col-8">
                                    <div class="numbers">
                                        <p class="text-sm mb-0 text-uppercase font-weight-bold">Total Warna Produk</p>
                                        <h3 class="font-weight-bolder">
                                            {{ $countData['warna_produk'] }}
                                        </h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="row">
                <a class="col-lg-3 col-md-6 col-12 text-dark" href="{{ route('vendors.index', []) }}">
                    <div class="card  mb-4">
                        <div class="card-body p-3">
                            <div class="row">
                                <div class="col-8">
                                    <div class="numbers">
                                        <p class="text-sm mb-0 text-uppercase font-weight-bold">Total Vendor</p>
                                        <h3 class="font-weight-bolder">
                                            {{ $countData['vendor'] }}
                                        </h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
                <a class="col-lg-3 col-md-6 col-12 text-dark" href="{{ route('stocks.index', []) }}">
                    <div class="card  mb-4">
                        <div class="card-body p-3">
                            <div class="row">
                                <div class="col-8">
                                    <div class="numbers">
                                        <p class="text-sm mb-0 text-uppercase font-weight-bold">Total Stok Produk Keseluruhan</p>
                                        <h3 class="font-weight-bolder">
                                            {{ $countData['total_stok_produk'] }}
                                        </h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
                <a class="col-lg-3 col-md-6 col-12 text-dark" href="{{ route('stocks-in.index', []) }}">
                    <div class="card  mb-4">
                        <div class="card-body p-3">
                            <div class="row">
                                <div class="col-8">
                                    <div class="numbers">
                                        <p class="text-sm mb-0 text-uppercase font-weight-bold">Total Produk Masuk Keseluruhan</p>
                                        <h3 class="font-weight-bolder">
                                            {{ $countData['total_stok_masuk'] }}
                                        </h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
                <a class="col-lg-3 col-md-6 col-12 text-dark" href="{{ route('stocks-out.index', []) }}">
                    <div class="card  mb-4">
                        <div class="card-body p-3">
                            <div class="row">
                                <div class="col-8">
                                    <div class="numbers">
                                        <p class="text-sm mb-0 text-uppercase font-weight-bold">Total Produk Keluar Keseluruhan</p>
                                        <h3 class="font-weight-bolder">
                                            {{ $countData['total_stok_keluar'] }}
                                        </h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-12 col-md-6">
            <div class="card shadow">
                <div class="card-body">
                    <div class="chart" id="chart-sales-dark">
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-12 col-md-6">
            <div class="card shadow">
                <div class="card-body">
                    <div class="chart" id="chart-sales-dark-2">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-12 col-md-6">
            <div class="card shadow">
                <div class="card-body">
                    <div class="chart" id="chart-sales-dark-3">
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-12 col-md-6">
            <div class="card shadow">
                <div class="card-body">
                    <div class="chart" id="chart-sales-dark-4">
                    </div>
                </div>
            </div>
        </div>
    </div>

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

@section('script')
    <script>
        var totalStokMasukProduct = @json($totalStokMasukProduct);
        var trenProdukMasuk = @json($trenProdukMasuk);
        var totalStokKeluarProduct = @json($totalStokKeluarProduct);
        var trenProdukKeluar = @json($trenProdukKeluar);
    </script>
    <script>
        var optionsStockIn = {
            series: [{
                name: 'Jml Produk Masuk',
                data: totalStokMasukProduct.map((item) => {
                    return parseInt(item.total_jumlah_masuk)
                })
            }],
            chart: {
                type: 'bar',
                height: 350,
                stacked: true,
                toolbar: {
                    show: true
                },
                zoom: {
                    enabled: true
                }
            },
            plotOptions: {
                bar: {
                    horizontal: false,
                },
            },
            dataLabels: {
                enabled: true,
            },
            legend: {
                show: true
            },
            title: {
                text: 'Jumlah Keseluruhan Produk Masuk',
            },
            colors: ['#1abc9c'],
            xaxis: {
                categories: totalStokMasukProduct.map(item => item.nama_produk),
            },
            tooltip: {
                y: {
                    formatter: function(val) {
                        return val + " pcs"
                    }
                }
            }
        };
        var chartStockIn = new ApexCharts(document.querySelector("#chart-sales-dark"), optionsStockIn);
        chartStockIn.render();

        var optionsTrenProdukMasuk = {
            chart: {
                type: 'line',
                height: 350,
                stacked: true,
                toolbar: {
                    show: true
                },
                zoom: {
                    enabled: true
                }
            },
            series: [{
                name: 'Jml Produk Masuk',
                data: trenProdukMasuk.map((item) => {
                    return parseInt(item.total_jumlah_masuk)
                })
            }],
            dataLabels: {
                enabled: true
            },
            stroke: {
                curve: 'smooth'
            },
            title: {
                text: 'Tren Produk Masuk Keseluruhan',
            },
            colors: ['#1abc9c'],
            xaxis: {
                categories: trenProdukMasuk.map(item => item.tanggal_masuk),
            },
            tooltip: {
                y: {
                    formatter: function(val) {
                        return val + " pcs"
                    }
                }
            }
        }
        var chartTrenProdukMasuk = new ApexCharts(document.querySelector("#chart-sales-dark-2"), optionsTrenProdukMasuk);
        chartTrenProdukMasuk.render();

        var optionsStockOut = {
            series: [{
                name: 'Jml Produk Keluar',
                data: totalStokKeluarProduct.map((item) => {
                    return parseInt(item.total_jumlah_keluar)
                })
            }],
            chart: {
                type: 'bar',
                height: 350,
                stacked: true,
                toolbar: {
                    show: true
                },
                zoom: {
                    enabled: true
                }
            },
            plotOptions: {
                bar: {
                    horizontal: false,
                },
            },
            dataLabels: {
                enabled: true,
            },
            legend: {
                show: true
            },
            title: {
                text: 'Jumlah Keseluruhan Produk Keluar',
            },
            colors: ['#1abc9c'],
            xaxis: {
                categories: totalStokKeluarProduct.map(item => item.nama_produk),
            },
            tooltip: {
                y: {
                    formatter: function(val) {
                        return val + " pcs"
                    }
                }
            }
        };
        var chartStockOut = new ApexCharts(document.querySelector("#chart-sales-dark-3"), optionsStockOut);
        chartStockOut.render();

        var optionsTrenProdukKeluar = {
            chart: {
                type: 'line',
                height: 350,
                stacked: true,
                toolbar: {
                    show: true
                },
                zoom: {
                    enabled: true
                }
            },
            series: [{
                name: 'Jml Produk Keluar',
                data: trenProdukKeluar.map((item) => {
                    return parseInt(item.total_jumlah_keluar)
                })
            }],
            dataLabels: {
                enabled: true
            },
            stroke: {
                curve: 'smooth'
            },
            title: {
                text: 'Tren Produk Keluar Keseluruhan',
            },
            colors: ['#1abc9c'],
            xaxis: {
                categories: trenProdukKeluar.map(item => item.tanggal_keluar),
            },
            tooltip: {
                y: {
                    formatter: function(val) {
                        return val + " pcs"
                    }
                }
            }
        }
        var chartTrenProdukKeluar = new ApexCharts(document.querySelector("#chart-sales-dark-4"), optionsTrenProdukKeluar);
        chartTrenProdukKeluar.render();
    </script>
@endsection
