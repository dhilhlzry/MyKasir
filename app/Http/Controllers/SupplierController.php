<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SupplierController extends Controller
{
    public function index()
    {
        if (request('search_supplier')) {
            $data['supplier'] = Supplier::where('supplier', 'like', '%' . request('search_supplier') . '%')->paginate(5);
        } else {
            $data['supplier'] = Supplier::paginate(5)->withQueryString();
        }
        $data['kodeauto'] = Supplier::selectRaw('LPAD(CONVERT(COUNT("kode") + 1, char(8)) , 5,"0") as invoice')->first();
        $data['title'] = "Supplier";
        return view('supplier.index', $data);
    }

    public function store(Request $request)
    {
        $validatedata = $request->validate([
            'kode' => 'required|unique:supplier',
            'supplier' => 'required|unique:supplier',
            'no_telp' => 'required',
            'alamat' => 'required',
            'status' => 'required',
        ]);

        $supplier = supplier::create($validatedata);

        return redirect('/supplier')->with('success', 'Tambah Data Berhasil !');
    }

    public function update(Request $request, string $id)
    {
        $validatedata = $request->validate([
            'kode' => 'required',
            'supplier' => 'required',
            'no_telp' => 'required',
            'alamat' => 'required',
            'status' => 'required',
        ]);

        $supplier = supplier::find($id);
        $supplier->update($validatedata);

        return redirect('/supplier')->with('success', 'Update Data Berhasil !');
    }

    public function delete(Request $request, string $id)
    {
        $delete = Supplier::findOrFail($id);
        if ($check = Produk::where('supplier', $delete->id)->first()) {
            return redirect('/supplier')->with('warning', 'Supplier Sedang Digunakan !');;
        } else {
            $suppliers = Supplier::find($id)->delete();
            return redirect('/supplier')->with('success', 'Delete Data Berhasil !');;
        }
    }

    public function detail(Request $request, string $id)
    {
        $query  =  DB::table('supplier')->where('id', $id)->first();
        $data['supplier']  =  DB::table('supplier')->where('id', $id)->first();
        $data['detail']  =  Produk::with('join_kategori','join_supplier')->where('supplier', $query->id)->paginate(5);
        $data['title'] = "Supplier";
        return view('supplier.detail_supplier', $data);
    }
}
