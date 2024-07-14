@extends('layouts.navbar')

@section('content')
    <div class="app-wrapper">

        <div class="app-content pt-3 p-md-3 p-lg-4">
            <div class="container-xl">

                <div class="row g-3 mb-4 align-items-center justify-content-between">
                    <div class="col-auto">
                        <h1 class="app-page-title mb-0">Input Penjualan</h1>
                    </div>
                    <div class="col-auto">
                        <div class="page-utilities">
                            <div class="row g-2 justify-content-start justify-content-md-end align-items-center">
                                <div class="col-auto">
                                    <div class="table-search-form row gx-1 align-items-center">
                                        <div class="col-auto">
                                            <input type="text" name="search_produk" id="search_produk"
                                                class="form-control search-orders" placeholder="" style="font-weight: 600"
                                                value="TRS{{ $kodeauto->invoice }}" disabled>
                                        </div>
                                    </div>

                                </div>
                                <div class="col-auto">
                                    <a class="btn app-btn-secondary" data-bs-toggle="modal"
                                        data-bs-target="#staticBackdrop">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            style="margin-right: 2px" fill="currentColor" class="bi bi-plus-circle"
                                            viewBox="0 0 16 16">
                                            <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16" />
                                            <path
                                                d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4" />
                                        </svg>
                                        Tambah Produk
                                    </a>
                                </div>
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
                                                @foreach ($keranjang as $list)
                                                    <td class="cell">{{ $list->kode }}</td>
                                                    <td class="cell">{{ $list->produk }}</td>
                                                    <td class="cell">Rp. {{ $list->harga }}</td>
                                                    <td class="cell">{{ $list->qty }}</td>
                                                    <td class="cell">Rp. {{ $list->subtotal }}</td>
                                                    <td class=""
                                                        style="display: flex; gap: 8px; width: auto; justify-content: center;">
                                                        <a data-bs-toggle="modal"
                                                            data-bs-target="#modaledit{{ $list->id }}"><span
                                                                class="status completed" style="cursor: pointer;"><i
                                                                    class='bx bxs-edit'></i></span></a>
                                                        <form action="/delete_keranjang/{{ $list->id }}" method="post">
                                                            @csrf
                                                            @method('delete')
                                                            <button type="submit" style="border: 0px; border-radius: 60px;"
                                                                onclick="return confirm('Apakah Yakin Mau Hapus Data?')"><span
                                                                    class="status pending"><i
                                                                        class='bx bxs-trash'></i></span>
                                                            </button>
                                                        </form>

                                                    </td>
                                            </tr>

                                            <!-- Modal -->
                                            <div class="modal fade" id="modaledit{{ $list->id }}"
                                                data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
                                                aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-scrollable">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Edit Produk</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                                aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form action="/keranjang-update/{{ $list->id }}"
                                                                method="post" enctype="multipart/form-data">
                                                                @csrf
                                                                @method('PUT')
                                                                <div class="mb-3">
                                                                    <label for="setting-input-1"
                                                                        class="form-label">Kode</label>
                                                                    <input type="text" class="form-control"
                                                                        id="kode" name="kode"
                                                                        @error('kode') is-invalid @enderror
                                                                        placeholder="Masukan No Kode"
                                                                        value="{{ $list->kode }}" readonly />
                                                                    @error('kode')
                                                                        <div class="invalid-feedback">
                                                                            {{ $message }}
                                                                        </div>
                                                                    @enderror
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label for="setting-input-2"
                                                                        class="form-label">Produk</label>
                                                                    <input type="text" class="form-control"
                                                                        id="produk" name="produk"
                                                                        placeholder="Masukan Produk"
                                                                        value="{{ $list->produk }}" readonly />
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label for="setting-input-2"
                                                                        class="form-label">Qty</label>
                                                                    <input type="text" class="form-control"
                                                                        id="qty" name="qty"
                                                                        placeholder="Masukan Jumlah Qty"
                                                                        value="{{ $list->qty }}" required />
                                                                </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <a href="" class="btn btn-secondary"
                                                                data-bs-dismiss="modal">Close</a>
                                                            <button type="submit" class="btn btn-primary"
                                                                style="color: white">Save
                                                                changes</button>
                                                        </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- endModal -->
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div><!--//table-responsive-->

                                @if ($untuk_total != null)
                                    <div class="table-search-form row gx-1 justify-content-end mt-4">
                                        <div class="col-auto d-flex">
                                            {{-- <label for="setting-input-2" class="form-label">Total :</label> --}}
                                            <input type="text" name="total" id="total"
                                                class="form-control search-orders" style="font-weight: 600"
                                                value="Rp. {{ $jumlah->total }}" disabled>
                                        </div>
                                    </div>
                                @endif


                            </div><!--//app-card-body-->
                        </div><!--//app-card-->

                        <form action="keranjang-simpan" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="table-search-form row gx-1 justify-content-end" style="margin-top: -20px">
                                <div class="col-auto">
                                    <label for="setting-input-2" class="form-label">Bayar :</label>
                                    <input type="text" name="bayar" id="bayar"
                                        class="form-control search-orders mb-1">
                                    <label for="setting-input-2" class="form-label">Kembali :</label>
                                    <input type="text" name="fake_kembali" id="fake_kembali"
                                        class="form-control search-orders ">
                                    <input type="text" name="kembali" id="kembali"
                                        class="form-control search-orders " style="display: none">
                                    <button type="submit" value="Simpan" class="btn app-btn-secondary mt-2"
                                        style="width: 300px" onclick="return confirm('Apakah Yakin Mau Input Transaksi?')"> Buat
                                        Transaksi </button>
                                </div>
                            </div>
                        </form>

                    </div><!--//tab-pane-->
                </div><!--//tab-content-->
            </div><!--//container-fluid-->
        </div><!--//app-content-->
    </div><!--//app-wrapper-->

    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Produk</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="app-card app-card-orders-table shadow-sm mb-5 p-4">
                        <div class="app-card-body">
                            <div class="table-responsive">
                                <table class="table app-table-hover mb-0 text-left">
                                    <thead>
                                        <tr>
                                            <th class="cell">No</th>
                                            <th class="cell">Kode</th>
                                            <th class="cell">Produk</th>
                                            <th class="cell">Satuan</th>
                                            <th class="cell">Kategori</th>
                                            <th class="cell">Supplier</th>
                                            <th class="cell">Stok</th>
                                            <th class="cell">Harga</th>
                                            <th class="cell"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            @csrf
                                            <?php $no = 1; ?>
                                            <?php $ni = 1; ?>
                                            @foreach ($produk as $list)
                                                <td class="cell">{{ $no++ }}</td>
                                                <td class="cell">{{ $list->kode }}</td>
                                                <td class="cell">{{ $list->produk }}</td>
                                                <td class="cell">{{ $list->satuan }}</td>
                                                <td class="cell">{{ $list->kategori }}</td>
                                                <td class="cell">{{ $list->supplier }}</td>
                                                <td class="cell">{{ $list->stok }}</td>
                                                <td class="cell">{{ $list->hargajual }}</td>
                                                <td class=""
                                                    style="display: flex; gap: 8px; width: auto; justify-content: center;">
                                                    <a href="/tmbh_keranjang/{{ $list->id }}"><span
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
                    <div class="d-flex justify-content-center">{{ $produk->links() }}</div>
                </div>
                <div class="modal-footer" style="margin-top: -35px">
                    <a href="" class="btn btn-secondary" data-bs-dismiss="modal">Close</a>
                </div>
            </div>
        </div>
    </div>

    <script>
        let total
        let bayar
        document.getElementById("bayar").oninput = function() {
            // total = document.getElementById("total").value;
            bayar = document.getElementById("bayar").value;
            const jumlah = bayar - {{ $jumlah->total }};
            if (document.getElementById("kembali").value = `${jumlah}` < 0) {
                document.getElementById("kembali").value = ``
            } else {
                document.getElementById("fake_kembali").value = `Rp. ${jumlah}`
                document.getElementById("kembali").value = `${jumlah}`
            }
        }
    </script>
@endsection
