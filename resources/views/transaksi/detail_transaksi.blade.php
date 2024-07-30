@extends('layouts.navbar')

@section('content')
    <div class="app-wrapper">

        <div class="app-content pt-3 p-md-3 p-lg-4">
            <div class="container-xl">

                <div class="row g-3 mb-4 align-items-center justify-content-between">
                    <div class="col-auto">
                        <h1 class="app-page-title mb-0">Detail Transaksi</h1>
                    </div>
                    <hr class="mb-0" />
                </div><!--//row-->

                <div class="tab-content" id="orders-table-tab-content">
                    <div class="tab-pane fade show active" id="orders-all" role="tabpanel" aria-labelledby="orders-all-tab">
                        <div class="app-card app-card-orders-table shadow-sm mb-5 p-4">
                            <div class="app-card-body">
                                <form action="roles-simpan" method="post" enctype="multipart/form-data"
                                    class="settings-form">
                                    @csrf
                                    <section style="font-weight: 600">
                                        <div class="d-flex gap-5 mb-1">
                                            <label for="setting-input-2" class="form-label" style="padding-right: 35px">No
                                                Transaksi</label>
                                            <label for="setting-input-2" class="form-label">: {{ $headtrans->kode }}</label>
                                        </div>
                                        <div class="d-flex gap-5 mb-1">
                                            <label for="setting-input-2" class="form-label">Tanggal Transaksi</label>
                                            <label for="setting-input-2" class="form-label">: {{ $headtrans->tanggal }}</label>
                                        </div>
                                        <div class="d-flex gap-5 mb-1">
                                            <label for="setting-input-2" class="form-label"
                                                style="padding-right: 45px">Nama Kasir</label>
                                            <label for="setting-input-2" class="form-label">: {{ $headtrans->join_user->name }}</label>
                                        </div>
                                    </section>
                                    
                                    <div class="tab-content" id="orders-table-tab-content">
                                        <div class="tab-pane fade show active" id="orders-all" role="tabpanel"
                                            aria-labelledby="orders-all-tab">
                                            <div class="app-card app-card-orders-table shadow-sm mb-5 p-4">
                                                <div class="app-card-body">
                                                    <div class="table-responsive">
                                                        <table class="table app-table-hover mb-0 text-left">
                                                            <thead>
                                                                <tr>
                                                                    <th class="cell">No</th>
                                                                    <th class="cell">Kode</th>
                                                                    <th class="cell">Produk</th>
                                                                    <th class="cell">Harga</th>
                                                                    <th class="cell">Qty</th>
                                                                    <th class="cell">Subtotal</th>
                                                                    <th class="cell"></th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <tr>
                                                                    @csrf
                                                                    <?php $no = 1; ?>
                                                                    <?php $ni = 1; ?>
                                                                    @foreach ($detailtrans as $list)
                                                                        <td class="cell">{{ $no++ }}</td>
                                                                        <td class="cell">{{ $list->kode_produk }}</td>
                                                                        <td class="cell">{{ $list->produk }}</td>
                                                                        <td class="cell">Rp. {{ $list->harga }}</td>
                                                                        <td class="cell">{{ $list->qty }} Barang</td>
                                                                        <td class="cell">Rp. {{ $list->subtotal }}</td>
                                                                </tr>
                                                                @endforeach
                                                            </tbody>
                                                        </table>
                                                    </div><!--//table-responsive-->

                                                </div><!--//app-card-body-->
                                            </div><!--//app-card-->
                                        </div>
                                    </div>

                                    <section class="" style="padding-right: 110px; font-weight: 600">
                                        <div class="d-flex justify-content-end gap-5 mb-1" style="margin-top: -16px">
                                            <label for="setting-input-2" class="form-label"
                                                style="padding-right: 22px">Total</label>
                                            <label for="setting-input-2" class="form-label">:
                                                {{ $headtrans->total_bayar }}</label>
                                        </div>
                                        <div class="d-flex justify-content-end gap-5 mb-1">
                                            <label for="setting-input-2" class="form-label"
                                                style="padding-right: 17px">Bayar</label>
                                            <label for="setting-input-2" class="form-label">:
                                                {{ $headtrans->bayar }}</label>
                                        </div>
                                        <div class="d-flex justify-content-end gap-5 mb-1">
                                            <label for="setting-input-2" class="form-label"
                                                style="padding-right: 0px">kembali</label>
                                            <label for="setting-input-2" class="form-label">:
                                                {{ $headtrans->kembali }}</label>
                                        </div>
                                    </section>

                                    <div class="flex">
                                        <a href="/data_transaksi" class="btn btn-secondary"
                                            style="margin-top: 10px; margin-right: 4px">
                                            Back
                                        </a>
                                        <button type="submit" class="btn app-btn-primary" style="margin-top: 10px">
                                            Cetak Invoice
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div><!--//app-card-->
                    </div><!--//tab-pane-->
                </div><!--//tab-content-->
            </div><!--//container-fluid-->
        </div><!--//app-content-->
    </div><!--//app-wrapper-->
@endsection
