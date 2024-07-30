@extends('layouts.navbar')

@section('content')
    <div class="app-wrapper">

        <div class="app-content pt-3 p-md-3 p-lg-4">
            <div class="container-xl">

                <div class="row g-3 mb-4 align-items-center justify-content-between">
                    <div class="col-auto">
                        <h1 class="app-page-title mb-0">Data Users</h1>
                    </div>
                    <div class="col-auto">
                        <div class="page-utilities">
                            <div class="row g-2 justify-content-start justify-content-md-end align-items-center">
                                <div class="col-auto">
                                    <form action="/user" class="table-search-form row gx-1 align-items-center">
                                        <div class="col-auto">
                                            <input type="text" name="search_user" id="search_user"
                                                value="{{ request('search_user') }}" class="form-control search-orders"
                                                placeholder="Search">
                                        </div>
                                        <div class="col-auto">
                                            <button type="submit" class="btn app-btn-secondary">Search</button>
                                        </div>
                                    </form>

                                </div><!--//col-->
                                @can('users-create')
                                    <div class="col-auto">
                                        <button class="btn app-btn-secondary" data-bs-toggle="modal"
                                            data-bs-target="#staticBackdrop">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                style="margin-right: 2px" fill="currentColor" class="bi bi-plus-circle"
                                                viewBox="0 0 16 16">
                                                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16" />
                                                <path
                                                    d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4" />
                                            </svg>
                                            Tambah Data
                                        </button>
                                    </div>
                                @endcan
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
                                                <th class="cell">nip</th>
                                                <th class="cell">Name</th>
                                                <th class="cell">email</th>
                                                <th class="cell">Created At</th>
                                                <th class="cell">Status</th>
                                                <th class="cell">Role</th>
                                                @can('users-edit')
                                                @can('users-delete')
                                                <th class="cell"></th>
                                                @endcan
                                                @endcan
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                @csrf
                                                <?php $no = 1; ?>
                                                <?php $ni = 1; ?>
                                                @foreach ($user as $list)
                                                    <td class="cell">{{ $no++ }}</td>
                                                    <td class="cell">{{ $list->nip }}</td>
                                                    <td class="cell">{{ $list->name }}</td>
                                                    <td class="cell">{{ $list->email }}</td>
                                                    <td class="cell">{{ $list->created_at }}</td>
                                                    <td class="cell">
                                                        @if ($list->status == 'Active')
                                                            <span class="badge bg-success">{{ $list->status }}</span>
                                                        @endif
                                                        @if ($list->status == 'Inactive')
                                                            <span class="badge bg-danger">{{ $list->status }}</span>
                                                        @endif
                                                    </td>
                                                    <td class="cell">{{ $list->join_roles->name }}</td>
                                                    @can('users-edit')
                                                    @can('users-delete')
                                                    <td class=""
                                                        style="display: flex; gap: 8px; width: auto; justify-content: center;">
                                                        {{-- <a href=""><span class="status process"><i
                                                                    class='bx bxs-show'></i></span></a> --}}
                                                        @can('users-edit')
                                                            <a data-bs-toggle="modal"
                                                                data-bs-target="#modaledit{{ $list->id }}"><span
                                                                    class="status completed" style="cursor: pointer;"><i
                                                                        class='bx bxs-edit'></i></span></a>
                                                        @endcan
                                                        @can('users-delete')
                                                            <form action="/delete_user/{{ $list->id }}" method="post">
                                                                @csrf
                                                                @method('delete')
                                                                <button type="submit" style="border: 0px; border-radius: 60px;"
                                                                    onclick="return confirm('Apakah Yakin Mau Hapus Data?')"><span
                                                                        class="status pending"><i
                                                                            class='bx bxs-trash'></i></span>
                                                                </button>
                                                            </form>
                                                        @endcan
                                                    </td>
                                                    @endcan
                                                    @endcan
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
                                                            <form action="/user-update/{{ $list->id }}" method="post"
                                                                enctype="multipart/form-data">
                                                                @csrf
                                                                @method('PUT')
                                                                <div class="mb-3">
                                                                    <label for="setting-input-1"
                                                                        class="form-label">Nip</label>
                                                                    <input type="text" class="form-control"
                                                                        id="nip" name="nip"
                                                                        @error('nip') is-invalid @enderror
                                                                        placeholder="Masukan No Nip"
                                                                        value="{{ $list->nip }}" required readonly />
                                                                    @error('nip')
                                                                        <div class="invalid-feedback">
                                                                            {{ $message }}
                                                                        </div>
                                                                    @enderror
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label for="setting-input-2"
                                                                        class="form-label">Name</label>
                                                                    <input type="text" class="form-control"
                                                                        id="name" name="name"
                                                                        placeholder="Masukan Nama"
                                                                        value="{{ $list->name }}" required />
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label for="setting-input-3" class="form-label">Email
                                                                        Address</label>
                                                                    <input type="email" class="form-control"
                                                                        id="email" name="email"
                                                                        placeholder="Masukan Alamat Email"
                                                                        value="{{ $list->email }}" required />
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label for="setting-input-2"
                                                                        class="form-label">Status</label>
                                                                    <select name="status" id="status"
                                                                        class="form-control">
                                                                        <option value="Active"
                                                                            {{ old('status', @$list->status) == 'Active' ? 'selected' : '' }}>
                                                                            Active</option>
                                                                        <option value="Inactive"
                                                                            {{ old('status', @$list->status) == 'Inactive' ? 'selected' : '' }}>
                                                                            Inactive</option>
                                                                    </select>
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label for="setting-input-2"
                                                                        class="form-label">Role</label>
                                                                    <select name="level" id="level"
                                                                        class="form-control" style="height: 50px">
                                                                        @foreach ($roles as $role)
                                                                            <option value="{{ $role->id }}"
                                                                                {{ old('level', @$role->id) == $list->level ? 'selected' : '' }}>
                                                                                {{ $role->name }}</option>
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
                        <div class="d-flex justify-content-center">{{ $user->links() }}</div>
                    </div><!--//tab-pane-->
                </div><!--//tab-content-->
            </div><!--//container-fluid-->
        </div><!--//app-content-->
    </div><!--//app-wrapper-->

    <!-- Modal -->
    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Data</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="user-simpan" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="setting-input-1" class="form-label">Nip</label>
                            <input type="text" class="form-control" id="nip" name="nip"
                                @error('nip') is-invalid @enderror placeholder="Masukan No Nip" required />
                            @error('nip')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="setting-input-2" class="form-label">Name</label>
                            <input type="text" class="form-control" id="name" name="name"
                                placeholder="Masukan Nama" required />
                        </div>
                        <div class="mb-3">
                            <label for="setting-input-3" class="form-label">Email Address</label>
                            <input type="email" class="form-control" id="email" name="email"
                                placeholder="Masukan Alamat Email" required />
                        </div>
                        <div class="mb-3">
                            <label for="setting-input-2" class="form-label">Password</label>
                            <input type="password" class="form-control" id="password" name="password"
                                placeholder="Masukan Password" required />
                        </div>
                        <div class="mb-3">
                            <label for="setting-input-2" class="form-label">Status</label>
                            <select name="status" id="status" class="form-control" style="height: 50px">
                                <option value="Active">Active</option>
                                <option value="Inactive">Inactive</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="setting-input-2" class="form-label">Role</label>
                            <select name="level" id="level" class="form-control" style="height: 50px">
                                @foreach ($roles as $list)
                                    <option value="{{ $list->id }}">{{ $list->name }}</option>
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
