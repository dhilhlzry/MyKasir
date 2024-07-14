<?php

namespace App\Http\Controllers;

use App\Models\Roles;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolesController extends Controller
{
    public function index()
    {
        if (request('search_role')) {
            $data['roles'] = Role::where('name', 'like', '%' . request('search_role') . '%')->paginate();
        } else {
            $data['roles'] = Role::paginate(5)->withQueryString();
        }
        $data['title'] = "Roles";
        return view('roles.index', $data);
    }

    public function create()
    {
        $data['permission'] = Permission::all();
        $data['title'] = "Roles";
        return view('roles.create', $data);
    }

    public function store(Request $request)
    {
        $validatedata = $request->validate([
            'name' => 'required|unique:users',
            'permission' => 'required',
        ]);
        $roles = Role::create([
            'name' => $request->name,
            'guard_name' => 'web',
        ]);
        $roles->givePermissionTo($request->input('permission'));
        return redirect('/roles')->with('success', 'Tambah Data Berhasil !');
    }

    public function edit($id)
    {
        $data['roles'] = Role::find($id);
        $data['permission'] = Permission::get();
        $data['rolePermissions'] = DB::table("role_has_permissions")->where("role_has_permissions.role_id", $id)
            ->pluck('role_has_permissions.permission_id', 'role_has_permissions.permission_id')
            ->all();
        $data['title'] = "Roles";
        return view('roles.edit', $data);
    }

    public function update(Request $request, string $id)
    {
        $validatedata = $request->validate([
            'name' => 'required|unique:users',
            'permission' => 'required',
        ]);
        $roles = Role::find($id);
        $roles->update([
            'name' => $request->name,
            'guard_name' => 'web',
        ]);
        $roles->syncPermissions($request->input('permission'));
        return redirect('/roles')->with('success', 'Update Data Berhasil !');
    }

    public function destroy($id)
    {
        $role_id =  Role::findOrFail($id);
        if ($check = User::where('level', $role_id->name)->first()) {
            return redirect('/roles')->with('warning', 'Role Sedang Digunakan !');;
        } else {
            $roles = Role::find($id)->delete();
            return redirect('/roles')->with('success', 'Delete Data Berhasil !');;
        }
    }
}
