@extends('layouts.navbar')

@section('content')
    <div class="app-wrapper">
        <div class="app-content pt-3 p-md-3 p-lg-4">
            <div class="container-xl">
                <h1 class="app-page-title">Settings</h1>
                <div class="row gy-4">
                    <div class="col-12 col-lg-6">
                        <div class="app-card app-card-account shadow-sm d-flex flex-column align-items-start">
                            <div class="app-card-header p-3 border-bottom-0">
                                <div class="row align-items-center gx-3">
                                    <div class="col-auto">
                                        <div class="app-icon-holder">
                                            <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-person"
                                                fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd"
                                                    d="M10 5a2 2 0 1 1-4 0 2 2 0 0 1 4 0zM8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm6 5c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4zm-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10z" />
                                            </svg>
                                        </div>
                                        <!--//icon-holder-->
                                    </div>
                                    <!--//col-->
                                    <div class="col-auto">
                                        <h4 class="app-card-title">Profile</h4>
                                    </div>
                                    <!--//col-->
                                </div>
                                <!--//row-->
                            </div>
                            <!--//app-card-header-->
                            <div class="app-card-body px-4 w-100">
                                <div class="item border-bottom py-3">
                                    <div class="row justify-content-between align-items-center">
                                        <div class="col-auto">
                                            <div class="item-label mb-2">
                                                <strong>Photo</strong>
                                            </div>
                                            <div class="item-data">
                                                <img class="profile-image" src="{{ asset('images/user.png') }}"
                                                    alt="" />
                                            </div>
                                        </div>
                                        <!--//col-->
                                        <div class="col text-end">
                                            <button class="btn-sm app-btn-secondary" data-bs-toggle="modal"
                                                data-bs-target="#staticBackdrop">Change</button>
                                        </div>
                                        <!--//col-->
                                    </div>
                                    <!--//row-->
                                </div>
                                <!--//item-->
                                <div class="item border-bottom py-3">
                                    <div class="row justify-content-between align-items-center">
                                        <div class="col-auto">
                                            <div class="item-label"><strong>Name</strong></div>
                                            <div class="item-data">{{ $profile->name }}</div>
                                        </div>
                                        <!--//col-->
                                        <div class="col text-end">
                                            <button class="btn-sm app-btn-secondary" data-bs-toggle="modal"
                                                data-bs-target="#staticBackdrop">Change</button>
                                        </div>
                                        <!--//col-->
                                    </div>
                                    <!--//row-->
                                </div>
                                <!--//item-->
                                <div class="item border-bottom py-3">
                                    <div class="row justify-content-between align-items-center">
                                        <div class="col-auto">
                                            <div class="item-label"><strong>Email</strong></div>
                                            <div class="item-data">{{ $profile->email }}</div>
                                        </div>
                                        <!--//col-->
                                        <div class="col text-end">
                                            <button class="btn-sm app-btn-secondary" data-bs-toggle="modal"
                                                data-bs-target="#staticBackdrop">Change</button>
                                        </div>
                                        <!--//col-->
                                    </div>
                                    <!--//row-->
                                </div>
                                <!--//item-->
                                <div class="item border-bottom py-3">
                                    <div class="row justify-content-between align-items-center">
                                        <div class="col-auto">
                                            <div class="item-label"><strong>Role</strong></div>
                                            <div class="item-data">{{ $profile->join_roles->name }}</div>
                                        </div>
                                        <!--//col-->
                                        <div class="col text-end">
                                            <button class="btn-sm app-btn-secondary" data-bs-toggle="modal"
                                                data-bs-target="#staticBackdrop">Change</button>
                                        </div>
                                        <!--//col-->
                                    </div>
                                    <!--//row-->
                                </div>
                                <!--//item-->
                                <div class="item border-bottom py-3">
                                    <div class="row justify-content-between align-items-center">
                                        <div class="col-auto">
                                            <div class="item-label"><strong>Password</strong></div>
                                            <div class="item-data">••••••••</div>
                                        </div>
                                        <!--//col-->
                                        <div class="col text-end">
                                            <button class="btn-sm app-btn-secondary" data-bs-toggle="modal"
                                                data-bs-target="#staticBackdrop">Change</button>
                                        </div>
                                        <!--//col-->
                                    </div>
                                    <!--//row-->
                                </div>
                                <!--//item-->
                            </div>
                            <!--//app-card-body-->
                            <div class="app-card-footer p-4 mt-auto">
                                <button class="btn app-btn-secondary" data-bs-toggle="modal"
                                    data-bs-target="#staticBackdrop">Manage Profile</button>
                            </div>
                            <!--//app-card-footer-->
                        </div>
                        <!--//app-card-->
                    </div>
                    @role('Super Admin')
                        <!--//col-->
                        <div class="col-12 col-lg-6">
                            <div class="app-card app-card-account shadow-sm d-flex flex-column align-items-start">
                                <div class="app-card-header p-3 border-bottom-0">
                                    <div class="row align-items-center gx-3">
                                        <div class="col-auto">
                                            <div class="app-icon-holder">
                                                <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-sliders"
                                                    fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                                    <path fill-rule="evenodd"
                                                        d="M11.5 2a1.5 1.5 0 1 0 0 3 1.5 1.5 0 0 0 0-3zM9.05 3a2.5 2.5 0 0 1 4.9 0H16v1h-2.05a2.5 2.5 0 0 1-4.9 0H0V3h9.05zM4.5 7a1.5 1.5 0 1 0 0 3 1.5 1.5 0 0 0 0-3zM2.05 8a2.5 2.5 0 0 1 4.9 0H16v1H6.95a2.5 2.5 0 0 1-4.9 0H0V8h2.05zm9.45 4a1.5 1.5 0 1 0 0 3 1.5 1.5 0 0 0 0-3zm-2.45 1a2.5 2.5 0 0 1 4.9 0H16v1h-2.05a2.5 2.5 0 0 1-4.9 0H0v-1h9.05z" />
                                                </svg>
                                            </div>
                                            <!--//icon-holder-->
                                        </div>
                                        <!--//col-->
                                        <div class="col-auto">
                                            <h4 class="app-card-title">Preferences</h4>
                                        </div>
                                        <!--//col-->
                                    </div>
                                    <!--//row-->
                                </div>

                                <!--//app-card-header-->
                                <div class="app-card-body px-4 w-100">
                                    <div class="item border-bottom py-3">
                                        <div class="row justify-content-between align-items-center">
                                            <div class="col-auto">
                                                <div class="item-label mb-2">
                                                    <strong>Logo</strong>
                                                </div>
                                                <div class="item-data">
                                                    <img class="profile-image" src="{{ asset('images/app-logo.svg') }}"
                                                        alt="" />
                                                </div>
                                            </div>
                                            <!--//col-->
                                            <div class="col text-end">
                                                <button class="btn-sm app-btn-secondary" data-bs-toggle="modal"
                                                    data-bs-target="#modalset">Change</button>
                                            </div>
                                            <!--//col-->
                                        </div>
                                        <!--//row-->
                                    </div>
                                    <!--//item-->
                                    <div class="item border-bottom py-3">
                                        <div class="row justify-content-between align-items-center">
                                            <div class="col-auto">
                                                <div class="item-label"><strong>Nama Aplikasi</strong></div>
                                                <div class="item-data">
                                                    {{ $setting->nama }}
                                                </div>
                                            </div>
                                            <!--//col-->
                                            <div class="col text-end">
                                                <button class="btn-sm app-btn-secondary" data-bs-toggle="modal"
                                                    data-bs-target="#modalset">Change</button>
                                            </div>
                                            <!--//col-->
                                        </div>
                                        <!--//row-->
                                    </div>
                                    <!--//item-->
                                    <div class="item border-bottom py-3">
                                        <div class="row justify-content-between align-items-center">
                                            <div class="col-auto">
                                                <div class="item-label">
                                                    <strong>Alamat</strong>
                                                </div>
                                                <div class="item-data">{{ $setting->alamat }}</div>
                                            </div>
                                            <!--//col-->
                                            <div class="col text-end">
                                                <button class="btn-sm app-btn-secondary" data-bs-toggle="modal"
                                                    data-bs-target="#modalset">Change</button>
                                            </div>
                                            <!--//col-->
                                        </div>
                                        <!--//row-->
                                    </div>
                                    <!--//item-->
                                    <div class="item border-bottom py-3">
                                        <div class="row justify-content-between align-items-center">
                                            <div class="col-auto">
                                                <div class="item-label">
                                                    <strong>No Telp</strong>
                                                </div>
                                                <div class="item-data">{{ $setting->no_telp }}</div>
                                            </div>
                                            <!--//col-->
                                            <div class="col text-end">
                                                <button class="btn-sm app-btn-secondary" data-bs-toggle="modal"
                                                    data-bs-target="#modalset">Change</button>
                                            </div>
                                            <!--//col-->
                                        </div>
                                        <!--//row-->
                                    </div>
                                    <!--//item-->
                                </div>
                                <!--//app-card-body-->
                                <div class="app-card-footer p-4 mt-auto">
                                    <button class="btn app-btn-secondary" data-bs-toggle="modal"
                                        data-bs-target="#modalset">Manage Preferences</button>
                                </div>
                                <!--//app-card-footer-->
                            </div>
                            <!--//app-card-->
                        </div>
                        <!--//col-->
                    @endrole
                </div>
                <!--//row-->
            </div>
            <!--//container-fluid-->
        </div>
        <!--//app-content-->
    </div>

    <!-- Modal -->
    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Manage Profile</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="/profile-update/{{ $profile->id }}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="setting-input-1" class="form-label">Nip</label>
                            <input type="text" class="form-control" id="nip" name="nip"
                                @error('nip') is-invalid @enderror placeholder="Masukan No Nip"
                                value="{{ $profile->nip }}" readonly required />
                            @error('nip')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="setting-input-2" class="form-label">Name</label>
                            <input type="text" class="form-control" id="name" name="name"
                                placeholder="Masukan Nama" value="{{ $profile->name }}" required />
                        </div>
                        <div class="mb-3">
                            <label for="setting-input-3" class="form-label">Email Address</label>
                            <input type="email" class="form-control" id="email" name="email"
                                placeholder="Masukan Alamat Email" value="{{ $profile->email }}" required />
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

    <!-- Modal -->
    <div class="modal fade" id="modalset" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Manage Preferences</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="/setting-update/{{ $setting->id }}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="setting-input-2" class="form-label">Nama Aplikasi</label>
                            <input type="text" class="form-control" id="nama" name="nama"
                                placeholder="Masukan Nama" value="{{ $setting->nama }}" required />
                        </div>
                        <div class="mb-3">
                            <label for="setting-input-3" class="form-label">Alamat</label>
                            <input type="text" class="form-control" id="alamat" name="alamat"
                                placeholder="Masukan Alamat" value="{{ $setting->alamat }}" required />
                        </div>
                        <div class="mb-3">
                            <label for="setting-input-3" class="form-label">No Telp</label>
                            <input type="text" class="form-control" id="no_telp" name="no_telp"
                                placeholder="Masukan No Telp" value="{{ $setting->no_telp }}" required />
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
