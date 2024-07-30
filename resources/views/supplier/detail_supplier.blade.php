@extends('layouts.navbar')

@section('content')
    <div class="app-wrapper">

        <div class="app-content pt-3 p-md-3 p-lg-4">
            <div class="container-xl">

                <div class="row g-3 mb-4 align-items-center justify-content-between">
                    <div class="col-auto">
                        <h1 class="app-page-title mb-0">Detail Supplier {{ $supplier->supplier }}</h1>
                    </div>
                    <hr class="mb-0" />
                </div><!--//row-->

                <div class="tab-content" id="orders-table-tab-content">
                    <div class="tab-pane fade show active" id="orders-all" role="tabpanel" aria-labelledby="orders-all-tab">
                        <div class="app-card app-card-orders-table shadow-sm mb-5 p-4">
                            <div class="app-card-body">
                                
                                <div class="tab-content" id="orders-table-tab-content">
                                    <div class="tab-pane fade show active" id="orders-all" role="tabpanel"
                                        aria-labelledby="orders-all-tab">
                                        <div class="app-card app-card-orders-table shadow-sm mb-2 p-4">
                                            <div class="app-card-body">
                                                <div class="table-responsive">
                                                    <table class="table app-table-hover mb-0 text-left">
                                                        <thead>
                                                            <tr>
                                                                <th class="cell">No</th>
                                                                <th class="cell">Kode</th>
                                                                <th class="cell">Produk</th>
                                                                <th class="cell">Satuan</th>
                                                                <th class="cell">Stok</th>
                                                                <th class="cell">Harga</th>
                                                                <th class="cell">Kategori</th>
                                                                <th class="cell"></th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                @csrf
                                                                <?php $no = 1; ?>
                                                                <?php $ni = 1; ?>
                                                                @foreach ($detail as $list)
                                                                    <td class="cell">{{ $no++ }}</td>
                                                                    <td class="cell">{{ $list->kode }}</td>
                                                                    <td class="cell">{{ $list->produk }}</td>
                                                                    <td class="cell">{{ $list->satuan }}</td>
                                                                    <td class="cell">{{ $list->stok }}</td>
                                                                    <td class="cell">Rp. {{ $list->hargajual }}</td>
                                                                    <td class="cell">{{ $list->join_kategori->kategori }}</td>
                                                            </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                </div><!--//table-responsive-->

                                            </div><!--//app-card-body-->
                                        </div><!--//app-card-->
                                    </div>
                                </div>
                                <a href="/supplier" class="btn app-btn-primary"
                                style="margin-top: 10px; margin-right: 4px">
                                Back
                            </a>
                            </div>
                        </div><!--//app-card-->
                    </div><!--//tab-pane-->
                </div><!--//tab-content-->
                <div class="d-flex justify-content-center">{{ $detail->links() }}</div>
            </div><!--//container-fluid-->
        </div><!--//app-content-->
    </div><!--//app-wrapper-->
@endsection
