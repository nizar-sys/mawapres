@extends('layouts.app')
@section('title', 'Data Produk Masuk')

@section('title-header', 'Data Produk Masuk')
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
    <li class="breadcrumb-item active">Data Produk Masuk</li>
@endsection

@if (!in_array(Auth::user()->role, ['admin']))
    @section('action_btn')
        <a href="{{ route('stocks-in.create') }}" class="btn btn-default">Tambah Data</a>
    @endsection
@endif

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card shadow">
                <div class="card-header bg-transparent border-0 text-dark">
                    <h2 class="card-title h3">Data Produk Masuk</h2>
                    <div class="table-responsive">
                        <table class="table table-flush table-hover" id="table-data">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Waktu</th>
                                    <th>Nama Produk</th>
                                    <th>Kode SKU</th>
                                    <th>Warna</th>
                                    <th>Kode Warna</th>
                                    <th>Vendor</th>
                                    <th>Jumlah</th>
                                    <th>Satuan</th>
                                    @if (!in_array(Auth::user()->role, ['admin']))
                                        <th>Aksi</th>
                                    @endif
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($stocksIn as $stock)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $stock->tanggal_masuk_formatted }}</td>
                                        <td>{{ $stock->stokProduk->produk->nama_produk }}</td>
                                        <td>{{ $stock->stokProduk->produk->kode_sku }}</td>
                                        <td>{{ $stock->stokProduk->warna->warna }}</td>
                                        <td>{{ $stock->stokProduk->warna->kode_warna }}</td>
                                        <td>{{ $stock->vendor->nama_vendor }}</td>
                                        <td>{{ $stock->jumlah_masuk }}</td>
                                        <td>Pcs</td>
                                        @if (!in_array(Auth::user()->role, ['admin']))
                                            <td class="d-flex jutify-content-center">
                                                <a href="{{ route('stocks-in.edit', $stock->id) }}"
                                                    class="btn btn-sm btn-warning"><i class="fas fa-pencil-alt"></i></a>
                                                <form id="delete-form-{{ $stock->id }}"
                                                    action="{{ route('stocks-in.destroy', $stock->id) }}" class="d-none"
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
                    columns: [0, 1, 2 , 3, 4, 5, 6, 7, 8]
                },
            }, ],
        });
    </script>
@endsection
