@extends('layouts.navbar')

@section('content')
    <div class="app-wrapper">

        <div class="app-content pt-3 p-md-3 p-lg-4">
            <div class="container-xl">

                <div class="row g-3 mb-4 align-items-center justify-content-between">
                    <div class="col-auto">
                        <h1 class="app-page-title mb-0">Data Produk</h1>
                    </div>
                    <div class="col-auto">
                        <div class="page-utilities">
                            <div class="row g-2 justify-content-start justify-content-md-end align-items-center">
                                <div class="col-auto">
                                    <form action="/produk" class="table-search-form row gx-1 align-items-center">
                                        <div class="col-auto">
                                            <input type="text" name="search_produk" id="search_produk"
                                                value="{{ request('search_produk') }}" class="form-control search-orders"
                                                placeholder="Search">
                                        </div>
                                        <div class="col-auto">
                                            <button type="submit" class="btn app-btn-secondary">Search</button>
                                        </div>
                                    </form>

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
                                        Tambah Data
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
                                                <th class="cell">No</th>
                                                <th class="cell">Kode</th>
                                                <th class="cell">Produk</th>
                                                <th class="cell">Satuan</th>
                                                <th class="cell">Kategori</th>
                                                <th class="cell">Supplier</th>
                                                <th class="cell">Stok</th>
                                                <th class="cell">Harga Beli</th>
                                                <th class="cell">Harga Jual</th>
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
                                                    <td class="cell">{{ $list->hargabeli }}</td>
                                                    <td class="cell">{{ $list->hargajual }}</td>
                                                    <td class=""
                                                        style="display: flex; gap: 8px; width: auto; justify-content: center;">
                                                        <a data-bs-toggle="modal"
                                                            data-bs-target="#modaledit{{ $list->id }}"><span
                                                                class="status completed" style="cursor: pointer;"><i
                                                                    class='bx bxs-edit'></i></span></a>
                                                        <form action="/delete_produk/{{ $list->id }}" method="post">
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
                                                            <h5 class="modal-title" id="exampleModalLabel">Edit Data</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                                aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form action="/produk-update/{{ $list->id }}" method="post"
                                                                enctype="multipart/form-data">
                                                                @csrf
                                                                @method('PUT')
                                                                <div class="mb-3">
                                                                    <label for="setting-input-1"
                                                                        class="form-label">Kode</label>
                                                                    <input type="text" class="form-control"
                                                                        id="kode" name="kode"
                                                                        @error('kode') is-invalid @enderror
                                                                        placeholder="Masukan No Kode" value="{{ $list->kode }}" required />
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
                                                                        placeholder="Masukan Produk" value="{{ $list->produk }}" required />
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label for="setting-input-3"
                                                                        class="form-label">Satuan</label>
                                                                    <input type="text" class="form-control"
                                                                        id="satuan" name="satuan"
                                                                        placeholder="Masukan Satuan" value="{{ $list->satuan }}" required />
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label for="setting-input-2"
                                                                        class="form-label">Kategori</label>
                                                                        <select name="kategori" id="kategori"
                                                                        class="form-control" style="height: 50px">
                                                                        @foreach ($kategori as $select)
                                                                            <option value="{{ $select->kategori }}"
                                                                                {{ old('level', @$select->kategori) == $list->kategori ? 'selected' : '' }}>
                                                                                {{ $select->kategori }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label for="setting-input-2"
                                                                        class="form-label">Stok</label>
                                                                    <input type="text" class="form-control"
                                                                        id="stok" name="stok"
                                                                        placeholder="Masukan Stok" value="{{ $list->stok }}" required />
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label for="setting-input-2" class="form-label">Harga
                                                                        Beli</label>
                                                                    <input type="text" class="form-control"
                                                                        id="hargabeli" name="hargabeli"
                                                                        placeholder="Masukan Harga Beli" value="{{ $list->hargabeli }}" required />
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label for="setting-input-2" class="form-label">Harga
                                                                        Jual</label>
                                                                    <input type="text" class="form-control"
                                                                        id="hargajual" name="hargajual"
                                                                        placeholder="Masukan Harga Jual" value="{{ $list->hargajual }}" required />
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label for="setting-input-2"
                                                                        class="form-label">Keterangan</label>
                                                                    <input type="text" class="form-control"
                                                                        id="keterangan" name="keterangan"
                                                                        placeholder="Masukan Keterangan" value="{{ $list->keterangan }}" required />
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label for="setting-input-2"
                                                                        class="form-label">Supplier</label>
                                                                        <select name="supplier" id="supplier"
                                                                        class="form-control" style="height: 50px">
                                                                        @foreach ($supplier as $select)
                                                                            <option value="{{ $select->supplier }}"
                                                                                {{ old('level', @$select->supplier) == $list->supplier ? 'selected' : '' }}>
                                                                                {{ $select->supplier }}</option>
                                                                        @endforeach
                                                                    </select>
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

                            </div><!--//app-card-body-->
                        </div><!--//app-card-->
                        <div class="d-flex justify-content-center">{{ $produk->links() }}</div>
                    </div><!--//tab-pane-->
                </div><!--//tab-content-->
            </div><!--//container-fluid-->
        </div><!--//app-content-->
    </div><!--//app-wrapper-->

    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Data</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="produk-simpan" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="setting-input-1" class="form-label">Kode</label>
                            <input type="text" class="form-control" id="kode" name="kode"
                                @error('kode') is-invalid @enderror placeholder="Masukan No Kode" value="BRG{{ $kodeauto->invoice }}" readonly />
                            @error('kode')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="setting-input-2" class="form-label">Produk</label>
                            <input type="text" class="form-control" id="produk" name="produk"
                                placeholder="Masukan Produk" required />
                        </div>
                        <div class="mb-3">
                            <label for="setting-input-3" class="form-label">Satuan</label>
                            <input type="text" class="form-control" id="satuan" name="satuan"
                                placeholder="Masukan Satuan" required />
                        </div>
                        <div class="mb-3">
                            <label for="setting-input-2" class="form-label">Kategori</label>
                            <select name="kategori" id="kategori" class="form-control" style="height: 50px">
                                @foreach ($kategori as $list)
                                    <option value="{{ $list->kategori }}">{{ $list->kategori }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="setting-input-2" class="form-label">Stok</label>
                            <input type="text" class="form-control" id="stok" name="stok"
                                placeholder="Masukan Stok" required />
                        </div>
                        <div class="mb-3">
                            <label for="setting-input-2" class="form-label">Harga Beli</label>
                            <input type="text" class="form-control" id="hargabeli" name="hargabeli"
                                placeholder="Masukan Harga Beli" required />
                        </div>
                        <div class="mb-3">
                            <label for="setting-input-2" class="form-label">Harga Jual</label>
                            <input type="text" class="form-control" id="hargajual" name="hargajual"
                                placeholder="Masukan Harga Jual" required />
                        </div>
                        <div class="mb-3">
                            <label for="setting-input-2" class="form-label">Keterangan</label>
                            <input type="text" class="form-control" id="keterangan" name="keterangan"
                                placeholder="Masukan Keterangan" required />
                        </div>
                        <div class="mb-3">
                            <label for="setting-input-2" class="form-label">Supplier</label>
                            <select name="supplier" id="supplier" class="form-control" style="height: 50px">
                                @foreach ($supplier as $list)
                                    <option value="{{ $list->supplier }}">{{ $list->supplier }}</option>
                                @endforeach
                            </select>
                        </div>
                </div>
                <div class="modal-footer">
                    <a href="" class="btn btn-secondary" data-bs-dismiss="modal">Close</a>
                    <button type="submit" class="btn btn-primary" style="color: white">Save
                        changes</button>
                </div>
                </form>
            </div>
        </div>
    </div>
@endsection
