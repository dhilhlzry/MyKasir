<?php

namespace App\Http\Controllers;

use App\Models\Headtrans;
use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function index()
    {
        if (request('search_user')) {
            $data['user'] = User::where('name', 'like', '%' . request('search_user') . '%')->paginate(5);
        } else {
            $data['user'] = User::with('join_roles')->paginate(5);
        }
        $data['roles'] = Role::all();
        $data['title'] = "User";
        return view('users.index', $data);
    }

    public function store(Request $request)
    {
        $validatedata = $request->validate([
            'nip' => 'required|unique:users',
            'name' => 'required|unique:users',
            'email' => 'required',
            'password' => 'required',
            'status' => 'required',
            'level' => 'required'
        ]);

        $user = User::create($validatedata);

        $query = Role::where('id', $request->level)->first();
        $user->assignRole($query->id);

        return redirect('/user')->with('success', 'Tambah Data Berhasil !');
    }

    public function update(Request $request, string $id)
    {
        $validatedata = $request->validate([
            'nip' => 'required',
            'name' => 'required',
            'email' => 'required',
            'status' => 'required',
            'level' => 'required'
        ]);
        $user = user::find($id);
        $user->update($validatedata);

        $query = Role::where('id', $request->level)->first();
        $user->syncRoles($query->id);

        return redirect('/user')->with('success', 'Update Data Berhasil !');
    }

    public function delete(Request $request, string $id)
    {
        $delete = User::findOrFail($id);
        if ($check = Headtrans::where('user', $delete->id)->first()) {
            return redirect('/user')->with('warning', 'User Important !');;
        } else {
            $user = User::find($id)->delete();
            return redirect('/user')->with('success', 'Delete Data Berhasil !');;
        }
    }
}
