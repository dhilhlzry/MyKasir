<?php

namespace App\Http\Controllers;

use App\Models\Detailtrans;
use App\Models\Headtrans;
use App\Models\Keranjang;
use App\Models\Produk;
use App\Models\Roles;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;

class transaksiController extends Controller
{
    public function input_penjualan()
    {
        $iduser = auth()->user()->id;
        if (request('search_produk')) {
            $data['keranjang'] = keranjang::where('produk', 'like', '%' . request('search_produk') . '%')->get();
        } else {
            $data['keranjang'] = Keranjang::where('id_user', $iduser)->get();
            $data['untuk_total'] = Keranjang::where('id_user', $iduser)->first();
        }
        $data['kodeauto'] = Headtrans::selectRaw('LPAD(CONVERT(COUNT("kode") + 1, char(8)) , 5,"0") as invoice')->first();
        $data['produk'] = Produk::paginate(10)->withQueryString();
        $data['title'] = "Transaksi_input";
        $data['jumlah'] = Keranjang::selectRaw('SUM(subtotal) as total')->first();
        return view('transaksi.input_penjualan', $data);
    }

    public function tmbh_keranjang(Request $request, string $id)
    {
        $iduser = auth()->user()->id;
        $query =  DB::table('produk')->where('id', $id)->first();
        $keranjang = DB::table('keranjang')->where('id_user', $iduser)->first();
        $exist = DB::table('keranjang')->where('id_user', $iduser)->where('produk', $query->produk)->first();
        if ($exist != null) {
            return redirect('/input_penjualan')->with('warning', 'Produk Sudah Ada !');
        } else {
            $keranjang = new Keranjang();
            $keranjang->kode = $query->kode;
            $keranjang->produk = $query->produk;
            $keranjang->harga = $query->hargajual;
            $keranjang->qty = '1';
            $keranjang->subtotal = $query->hargajual;
            $keranjang->id_user = '1';
            $keranjang->save();
        }
        return redirect('/input_penjualan');
    }

    public function store(Request $request)
    {
        $iduser = auth()->user()->id;
        $kodeauto = Headtrans::selectRaw('LPAD(CONVERT(COUNT("kode") + 1, char(8)) , 5,"0") as invoice')->first();
        $queryjumlah = Keranjang::selectRaw('COUNT(*) as jumlah')->first();
        $querytotal = Keranjang::selectRaw('SUM(subtotal) as total')->first();
        $headtrans = new Headtrans();
        $headtrans->kode = 'TRS' . $kodeauto->invoice;
        $headtrans->tanggal = Carbon::parse(now())->locale('id')->isoFormat('D MMMM Y');
        $headtrans->user = auth()->user()->name;
        $headtrans->jumlah = $queryjumlah->jumlah;
        $headtrans->total_bayar = $querytotal->total;
        $headtrans->bayar = $request->bayar;
        $headtrans->kembali = $request->kembali;
        
        $detail = DB::table('keranjang')->where('id_user', $iduser)->get();
        foreach ($detail as $list) {
            Detailtrans::create([
                'kode' => 'TRS' . $kodeauto->invoice,
                'kode_produk' => $list->kode,
                'produk' => $list->produk,
                'harga' => $list->harga,
                'qty' => $list->qty,
                'subtotal' => $list->subtotal,
            ]);
        }

        $headtrans->save();
        $delete =  DB::table('keranjang')->where('id_user', $iduser)->delete();
        return redirect('/input_penjualan')->with('success', 'Transaksi Berhasil !');

        // $keranjang =  DB::table('keranjang')->where('id_user', $iduser)->get();
        // SELECT SUM(subtotal) FROM keranjang WHERE id_user = '';
        // SELECT COUNT(*) as jumlah FROM keranjang WHERE id_user = '2';
    }

    public function update(Request $request, string $id)
    {
        $query =  DB::table('keranjang')->where('id', $id)->first();
        $keranjang = Keranjang::findOrFail($id);
        $keranjang->qty = $request->qty;
        $keranjang->subtotal = $query->subtotal * $request->qty;
        $keranjang->save();
        return redirect('/input_penjualan');
    }

    public function delete_keranjang(Request $request, string $id)
    {
        $delete =  DB::table('keranjang')->where('id', $id)->delete();
        return redirect('/input_penjualan');
    }

    public function data_transaksi()
    {
        if (request('search_transaksi')) {
            $data['transaksi'] = Headtrans::where('kode', 'like', '%' . request('search_transaksi') . '%')->paginate();
        } else {
            $data['transaksi'] = Headtrans::paginate(10)->withQueryString();
        }
        $data['title'] = "Transaksi_data";
        return view('transaksi.data_transaksi', $data);
    }

    public function detail(Request $request, string $id)
    {
        $head  =  DB::table('headtrans')->where('id', $id)->first();
        $data['headtrans']  =  DB::table('headtrans')->where('id', $id)->first();
        $data['detailtrans']  =  DB::table('detailtrans')->where('kode', $head->kode)->get();
        $data['title'] = "Transaksi_data";
        return view('transaksi.detail_transaksi', $data);
    }


}
