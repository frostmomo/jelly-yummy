<?php

namespace App\Http\Controllers;

use App\Models\KategoriBeli;
use Illuminate\Http\Request;

class KategoriProdukBeliController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    public function index()
    {
        $kategoribeli = KategoriBeli::all();

        return view('pages.kategori_produk_beli.index', ['kategoribeli' => $kategoribeli]);
    }

    public function create()
    {
        return view('pages.kategori_produk_beli.add');
    }

    public function store(Request $request)
    {
        //validasi data input kategori beli
        $request->validate([
            'kategori_beli' => 'required|unique:kategori_beli|max:255',
        ]);

        //buat data baru untuk kategori beli jika data belum ada
        $kategoriBeli = new KategoriBeli;
        $kategoriBeli->kategori_beli = $request->kategori_beli;
        $kategoriBeli->save();

        //kembali ke menu kategori beli
        return redirect('kategori-beli')->with('success', 'Kategori beli berhasil ditambahkan');
    }

    public function edit($id)
    {
        $kategoribeli = KategoriBeli::find($id);
        return view('pages.kategori_produk_beli.edit', ['kategoribeli' => $kategoribeli]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'kategori_beli' => 'required|unique:kategori_beli|max:255'
        ]);

        $kategoribeli = KategoriBeli::find($id);
        $kategoribeli->kategori_beli = $request->kategori_beli;
        $kategoribeli->update();

        return redirect('kategori-beli')->with('success', 'Kategori Produk Beli berhasil diperbaharui');
    }

    public function delete($id)
    {
        KategoriBeli::find($id)->delete();
        return redirect('kategori-beli')->with('success', 'Kategori Produk Beli berhasil dihapus');
    }
}
