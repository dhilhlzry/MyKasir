<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use App\Models\Produk;
use App\Models\Supplier;
use Illuminate\Http\Request;

class produkController extends Controller
{
    public function index()
    {
        if (request('search_produk')) {
            $data['produk'] = Produk::where('produk', 'like', '%' . request('search_produk') . '%')->paginate(5);
        } else {
            $data['produk'] = Produk::with('join_kategori','join_supplier')->paginate(5);
        }
        $data['kodeauto'] = Produk::selectRaw('LPAD(CONVERT(COUNT("kode") + 1, char(8)) , 5,"0") as invoice')->first();
        $data['kategori'] = Kategori::all();
        $data['supplier'] = Supplier::where('status', 'Active')->get();
        $data['title'] = "Produk";
        return view('produk.index', $data);
    }

    public function store(Request $request)
    {
        $validatedata = $request->validate([
            'kode' => 'required|unique:produk',
            'produk' => 'required|unique:produk',
            'satuan' => 'required',
            'kategori' => 'required',
            'stok' => 'required',
            'hargabeli' => 'required',
            'hargajual' => 'required',
            'keterangan' => 'required',
            'supplier' => 'required',
        ]);

        $produk = produk::create($validatedata);

        return redirect('/produk')->with('success', 'Tambah Data Berhasil !');
    }

    public function update(Request $request, string $id)
    {
        $validatedata = $request->validate([
            'kode' => 'required',
            'produk' => 'required',
            'satuan' => 'required',
            'kategori' => 'required',
            'stok' => 'required',
            'hargabeli' => 'required',
            'hargajual' => 'required',
            'keterangan' => 'required',
            'supplier' => 'required',
        ]);

        $produk = produk::find($id);
        $produk->update($validatedata);

        return redirect('/produk')->with('success', 'Update Data Berhasil !');
    }

    public function delete(Request $request, string $id)
    {
        $delete = Produk::findOrFail($id);
        $delete->delete();
        return redirect('/produk')->with('success', 'Delete Data Berhasil !');
    }
}
