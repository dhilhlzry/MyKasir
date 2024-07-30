<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class kategoriController extends Controller
{
    public function index()
    {
        if (request('search_kategori')) {
            $data['kategori'] = Kategori::where('kategori', 'like', '%' . request('search_kategori') . '%')->paginate(5);
        } else {
            $data['kategori'] = Kategori::paginate(5)->withQueryString();
        }
        $data['kodeauto'] = Kategori::selectRaw('LPAD(CONVERT(COUNT("kode") + 1, char(8)) , 5,"0") as invoice')->first();
        $data['title'] = "Kategori";
        return view('kategori.index', $data);
    }

    public function store(Request $request)
    {
        $validatedata = $request->validate([
            'kode' => 'required|unique:kategori',
            'kategori' => 'required|unique:kategori',
        ]);

        $kategori = kategori::create($validatedata);

        return redirect('/kategori')->with('success', 'Tambah Data Berhasil !');
    }

    public function update(Request $request, string $id)
    {
        $validatedata = $request->validate([
            'kode' => 'required',
            'kategori' => 'required',
        ]);

        $kategori = kategori::find($id);
        $kategori->update($validatedata);

        return redirect('/kategori')->with('success', 'Update Data Berhasil !');
    }

    public function delete(Request $request, string $id)
    {
        $delete = kategori::findOrFail($id);
        if ($check = Produk::where('kategori', $delete->id)->first()) {
            return redirect('/kategori')->with('warning', 'Kategori Sedang Digunakan !');;
        } else {
            $kategoris = Kategori::find($id)->delete();
            return redirect('/kategori')->with('success', 'Delete Data Berhasil !');;
        }
    }

    public function detail(Request $request, string $id)
    {
        $query  =  DB::table('kategori')->where('id', $id)->first();
        $data['kategori']  =  DB::table('kategori')->where('id', $id)->first();
        $data['detail']  =  Produk::with('join_kategori','join_supplier')->where('kategori', $query->id)->paginate(5);
        $data['title'] = "Kategori";
        return view('kategori.detail_kategori', $data);
    }
}
