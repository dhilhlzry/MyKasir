@extends('layouts.navbar')

@section('content')
    <div class="app-wrapper">

        <div class="app-content pt-3 p-md-3 p-lg-4">
            <div class="container-xl">

                <div class="row g-3 mb-4 align-items-center justify-content-between">
                    <div class="col-auto">
                        <h1 class="app-page-title mb-0">Data Transaksi</h1>
                    </div>
                    <div class="col-auto">
                        <div class="page-utilities">
                            <div class="row g-2 justify-content-start justify-content-md-end align-items-center">
                                <div class="col-auto">
                                    <form action="/data_transaksi" class="table-search-form row gx-1 align-items-center">
                                        <div class="col-auto">
                                            <input type="text" name="search_transaksi" id="search_transaksi"
                                                value="{{ request('search_transaksi') }}" class="form-control search-orders"
                                                placeholder="Search">
                                        </div>
                                        <div class="col-auto">
                                            <button type="submit" class="btn app-btn-secondary">Search</button>
                                        </div>
                                    </form>

                                </div>
                                {{-- <div class="col-auto">
                                    <a href="/" class="btn app-btn-secondary">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            style="margin-right: 2px" fill="currentColor" class="bi bi-plus-circle"
                                            viewBox="0 0 16 16">
                                            <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16" />
                                            <path
                                                d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4" />
                                        </svg>
                                        Tambah Data
                                    </a>
                                </div> --}}
                            </div><!--//row-->
                        </div><!--//table-utilities-->
                    </div><!--//col-auto-->
                </div><!--//row-->

                <div class="tab-content" id="orders-table-tab-content">
                    <div class="tab-pane fade show active" id="orders-all" role="tabpanel" aria-labelledby="orders-all-tab">
                        <div class="app-card app-card-orders-table shadow-sm mb-5 p-4">
                            <div class="app-card-body">
                                <div class="table-responsive">
                                    <table class="table app-table-hover mb-0 text-left">
                                        <thead>
                                            <tr>
                                                <th class="cell">No</th>
                                                <th class="cell">Kode</th>
                                                <th class="cell">Tanggal</th>
                                                <th class="cell">Kasir</th>
                                                <th class="cell">Jumlah</th>
                                                <th class="cell">Total Bayar</th>
                                                <th class="cell">Bayar</th>
                                                <th class="cell">Kembali</th>
                                                <th class="cell"></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                @csrf
                                                <?php $no = 1; ?>
                                                <?php $ni = 1; ?>
                                                @foreach ($transaksi as $list)
                                                    <td class="cell">{{ $no++ }}</td>
                                                    <td class="cell">{{ $list->kode }}</td>
                                                    <td class="cell">{{ $list->tanggal }}</td>
                                                    <td class="cell">{{ $list->join_user->name }}</td>
                                                    <td class="cell">{{ $list->jumlah }} Barang</td>
                                                    <td class="cell">Rp. {{ $list->total_bayar }}</td>
                                                    <td class="cell">Rp. {{ $list->bayar }}</td>
                                                    <td class="cell">Rp. {{ $list->kembali }}</td>
                                                    <td class=""
                                                        style="display: flex; gap: 8px; width: auto; justify-content: center;">
                                                        <a href="/detail_transaksi/{{ $list->id }}"><span
                                                                class="status completed"><i
                                                                    class='bx bx-pointer'></i></span></a>

                                                    </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div><!--//table-responsive-->
                                
                            </div><!--//app-card-body-->
                        </div><!--//app-card-->
                        <div class="d-flex justify-content-center">{{ $transaksi->links() }}</div>
                    </div><!--//tab-pane-->
                </div><!--//tab-content-->
            </div><!--//container-fluid-->
        </div><!--//app-content-->
    </div><!--//app-wrapper-->
@endsection
