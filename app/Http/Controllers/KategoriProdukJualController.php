<?php

namespace App\Http\Controllers;

use App\Models\KategoriJual;
use Illuminate\Http\Request;

class KategoriProdukJualController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    public function create()
    {
        return view('pages.kategori_produk.produk_jual.add');
    }

    public function store(Request $request)
    {
        //validasi data input kategori jual
        $request->validate([
            'kategori_jual' => 'required|unique:kategori_jual|max:255',
        ]);

        //buat data baru untuk kategori jual jika data belum ada
        $kategorijual = new KategoriJual;
            $kategorijual->kategori_jual = $request->kategori_jual;
        $kategorijual->save();

        //kembali ke menu kategori jual
        return redirect('produk-jual')->with('success', 'Kategori jual berhasil ditambahkan');
    }

    public function edit($id) 
    {
        $kategorijual = KategoriJual::find($id);
        return view('pages.kategori_produk.produk_jual.edit', ['kategorijual' => $kategorijual]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'kategori_jual' => 'required|unique:kategori_jual|max:255'
        ]);

        $kategorijual = KategoriJual::find($id);
            $kategorijual->kategori_jual = $request->kategori_jual;
        $kategorijual->update();

        return redirect('produk-jual')->with('success', 'Kategori Produk jual berhasil diperbaharui');

    }

    public function delete($id)
    {
        KategoriJual::find($id)->delete();
        return redirect('produk-jual')->with('success', 'Kategori Produk jual berhasil dihapus');
    }
}
