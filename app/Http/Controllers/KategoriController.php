<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Http\Request;

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
        $delete->delete();
        return redirect('/kategori')->with('success', 'Delete Data Berhasil !');
    }
}
