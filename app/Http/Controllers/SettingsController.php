<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use App\Models\User;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    public function index()
    {
        $iduser = auth()->user()->id;
        $data['profile'] = User::with('join_roles')->where('id', $iduser)->first();
        $data['setting'] = Setting::where('id', 1)->first();
        $data['title'] = "Setting";
        return view('settings.setting', $data);
    }

    public function notification()
    {
        $iduser = auth()->user()->id;
        $data['title'] = "Notification";
        return view('notification.notification', $data);
    }

    public function update_profile(Request $request, string $id)
    {
        $validatedata = $request->validate([
            'name' => 'required',
            'email' => 'required',
        ]);

        $profile = User::find($id);
        $profile->update($validatedata);

        return redirect('/setting')->with('success', 'Update Data Berhasil !');
    }

    public function setting_profile(Request $request, string $id)
    {
        $validatedata = $request->validate([
            'nama' => 'required',
            'alamat' => 'required',
            'no_telp' => 'required',
        ]);

        $setting = Setting::find($id);
        $setting->update($validatedata);

        return redirect('/setting')->with('success', 'Update Data Berhasil !');
    }
}
