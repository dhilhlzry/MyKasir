@extends('layouts.navbar')

@section('content')
    <div class="app-wrapper">

        <div class="app-content pt-3 p-md-3 p-lg-4">
            <div class="container-xl">

                <div class="row g-3 mb-4 align-items-center justify-content-between">
                    <div class="col-auto">
                        <h1 class="app-page-title mb-0">Data Roles</h1>
                    </div>
                    <div class="col-auto">
                        <div class="page-utilities">
                            <div class="row g-2 justify-content-start justify-content-md-end align-items-center">
                                <div class="col-auto">
                                    <form action="/roles" class="table-search-form row gx-1 align-items-center">
                                        <div class="col-auto">
                                            <input type="text" name="search_role" id="search_role"
                                                value="{{ request('search_role') }}" class="form-control search-orders"
                                                placeholder="Search">
                                        </div>
                                        <div class="col-auto">
                                            <button type="submit" class="btn app-btn-secondary">Search</button>
                                        </div>
                                    </form>

                                </div>
                                <div class="col-auto">
                                    <a href="/create_roles" class="btn app-btn-secondary">
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
                                                <th class="cell">Name</th>
                                                <th class="cell">Created At</th>
                                                <th class="cell"></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                @csrf
                                                <?php $no = 1; ?>
                                                <?php $ni = 1; ?>
                                                @foreach ($roles as $list)
                                                    <td class="cell">{{ $no++ }}</td>
                                                    <td class="cell">{{ $list->name }}</td>
                                                    <td class="cell">{{ $list->created_at }}</td>
                                                    @if ($list->name == 'Super Admin')
                                                    <td></td>
                                                    @else
                                                        <td class=""
                                                            style="display: flex; gap: 8px; width: auto; justify-content: center;">
                                                            <a href="/edit_roles/{{ $list->id }}"><span
                                                                    class="status completed"><i
                                                                        class='bx bxs-edit'></i></span></a>
                                                            <form action="/delete_roles/{{ $list->id }}" method="post">
                                                                @csrf
                                                                @method('delete')
                                                                <button type="submit"
                                                                    style="border: 0px; border-radius: 60px;"
                                                                    onclick="return confirm('Apakah Yakin Mau Hapus Data?')"><span
                                                                        class="status pending"><i
                                                                            class='bx bxs-trash'></i></span>
                                                                </button>
                                                            </form>

                                                        </td>
                                                    @endif
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div><!--//table-responsive-->

                            </div><!--//app-card-body-->
                        </div><!--//app-card-->

                    </div><!--//tab-pane-->
                </div><!--//tab-content-->
            </div><!--//container-fluid-->
        </div><!--//app-content-->
    </div><!--//app-wrapper-->
@endsection
