@extends('layouts.app')
@section('title', 'Data Stok Produk')

@section('title-header', 'Data Stok Produk')
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
    <li class="breadcrumb-item active">Data Stok Produk</li>
@endsection

@if (!in_array(Auth::user()->role, ['rnd', 'gudang']))

    @section('action_btn')
        <a href="{{ route('stocks.create') }}" class="btn btn-default">Tambah Data</a>
    @endsection
@endif

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card shadow">
                <div class="card-header bg-transparent border-0 text-dark">
                    <h2 class="card-title h3">Data Stok Produk</h2>
                    <div class="table-responsive">
                        <table class="table table-flush table-hover" id="table-data">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Jenis Produk</th>
                                    <th>SKU Produk</th>
                                    <th>Warna</th>
                                    <th>Kode Warna</th>
                                    <th>Stok Saat Ini <div class="text-small">(pcs)</div>
                                    </th>
                                    <th>Stok Minimum <div class="text-small">(pcs)</div>
                                    </th>
                                    <th>Status</th>
                                    @if (!in_array(Auth::user()->role, ['rnd', 'gudang']))
                                        <th>Aksi</th>
                                    @endif
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($stocksData as $stock)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $stock->nama_produk }}</td>
                                        <td>{{ $stock->kode_sku }}</td>
                                        <td>{{ $stock->warna }}</td>
                                        <td>{{ $stock->kode_warna }}</td>
                                        <td>{{ $stock->stok }}</td>
                                        <td>{{ $stock->stok_minimum }}</td>
                                        <td>{!! $stock->status_label !!}</td>
                                        @if (!in_array(Auth::user()->role, ['rnd', 'gudang']))
                                            <td class="d-flex jutify-content-center">
                                                <a href="{{ route('stocks.edit', $stock->id) }}"
                                                    class="btn btn-sm btn-warning"><i class="fas fa-pencil-alt"></i></a>
                                                <form id="delete-form-{{ $stock->id }}"
                                                    action="{{ route('stocks.destroy', $stock->id) }}" class="d-none"
                                                    method="post">
                                                    @csrf
                                                    @method('DELETE')
                                                </form>
                                                <button onclick="deleteForm('{{ $stock->id }}')"
                                                    class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></button>
                                            </td>
                                        @endif
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3">Tidak ada data</td>
                                    </tr>
                                @endforelse
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
        function deleteForm(id) {
            Swal.fire({
                title: 'Hapus data',
                text: "Anda akan menghapus data!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                cancelButtonText: 'Batal!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $(`#delete-form-${id}`).submit()
                }
            })
        }

        var tabledata = $('#table-data').DataTable({
            language: {
                search: "_INPUT_",
                searchPlaceholder: "Cari Data",
                lengthMenu: "Menampilkan _MENU_ data",
                zeroRecords: "Data tidak ditemukan",
                infoEmpty: "Menampilkan 0 sampai 0 dari 0 data",
                infoFiltered: "(disaring dari _MAX_ data)",
                paginate: {
                    previous: '<i class="fa fa-angle-left"></i>',
                    next: "<i class='fa fa-angle-right'></i>",
                }
            },
            dom: 'Bflrtip',
            buttons: [{
                    extend: 'pdfHtml5',
                    text: '<i class="fas fa-file-pdf"></i> PDF',
                    className: 'btn btn-sm btn-danger',
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4, 5, 6, 7]
                    },
                },
                @if (Auth::user()->role == 'admin')
                    {
                        text: '<i class="fas fa-file"></i> Surat PO',
                        className: 'btn btn-sm btn-dark',
                        action: function(e, dt, node, config) {
                            window.open(
                                'https://docs.google.com/spreadsheets/d/1aD_74GHEe8OkNjZi7cNv3eqV4OAeItqUdeb03O2Q8RQ/edit?usp=drive_web&ouid=102947323619147234435',
                                '_blank');
                        }
                    },
                @endif
            ],
        });
    </script>
@endsection
