<?php

namespace App\Http\Controllers;

use App\Models\Headtrans;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class DashboardController extends Controller
{
    public function index()
    {
        $data['title'] = "Home";
        $data['user'] = User::all()->count();
        $data['role'] = Role::all()->count();
        $now = Carbon::parse(now())->locale('id')->isoFormat('D MMMM Y');
        $data['hari_ini'] = Headtrans::selectRaw('SUM(total_bayar) as total')->where('tanggal', $now)->first();
        $data['seluruhnya'] = Headtrans::selectRaw('SUM(total_bayar) as total')->first();
        return view('home', $data);
    }

}
