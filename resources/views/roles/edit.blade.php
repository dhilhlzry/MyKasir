@extends('layouts.navbar')

@section('content')
    <div class="app-wrapper">
        <div class="app-content pt-3 p-md-3 p-lg-4">
            <div class="container-xl">
                <h1 class="app-page-title">Edit Roles</h1>
                <hr class="mb-4" />
                <div class="row g-4 settings-section">
                    <div class="col-12 col-md-8">
                        <div class="app-card app-card-settings shadow-sm p-4">
                            <div class="app-card-body">
                                <form action="/roles-update/{{ $roles->id }}" method="post" enctype="multipart/form-data"
                                    class="settings-form">
                                    @csrf
                                    @method('PUT')
                                    <div class="mb-3">
                                        <label for="setting-input-2" class="form-label">Role Name</label>
                                        <input type="text" class="form-control" name="name" id="setting-input-2"
                                            placeholder="Masukan Nama Role" value="{{ $roles->name }}" required />
                                    </div>
                                    <label for="setting-input-3" class="form-label" style="margin-bottom: 10px">Permission
                                        Access :</label>
                                    @foreach ($permission as $value)
                                        <div class="form-check mb-3" style="margin-left: 10px">
                                            <input class="form-check-input" type="checkbox" @if (in_array($value->id, $rolePermissions)) checked @endif 
                                            name="permission[]" value="{{ $value->name }}" id="settings-checkbox-1" />
                                            <label class="form-check-label" for="settings-checkbox-1">
                                                {{ $value->name }}
                                            </label>
                                        </div>
                                    @endforeach
                                    <div class="flex">
                                        <a href="/roles" class="btn btn-secondary"
                                            style="margin-top: 10px; margin-right: 4px">
                                            Back
                                        </a>
                                        <button type="submit" class="btn app-btn-primary" style="margin-top: 10px">
                                            Save Changes
                                        </button>
                                    </div>
                                </form>
                            </div>
                            <!--//app-card-body-->
                        </div>
                        <!--//app-card-->
                    </div>
                </div>
                <hr class="my-4" />
            </div>
            <!--//container-fluid-->
        </div>
        <!--//app-content-->
    </div>
@endsection
