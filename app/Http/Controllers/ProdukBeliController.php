<?php

namespace App\Http\Controllers;

use App\Models\KategoriBeli;
use App\Models\ProdukBeli;
use Illuminate\Http\Request;

class ProdukBeliController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    public function index()
    {
        $produkbeli = ProdukBeli::join('kategori_beli', 'kategori_beli.id', '=', 'produk_beli.id_kategori_beli')
            ->get([
                'produk_beli.id', 'produk_beli.nama_produk_beli', 'produk_beli.kode_produk_beli',
                'produk_beli.harga_beli', 'produk_beli.stok', 'kategori_beli.kategori_beli',
            ]);
        return view(
            'pages.produk_beli.index',
            ['produkbeli' => $produkbeli],
        );
    }

    public function create()
    {
        $kategoribeli = KategoriBeli::pluck('kategori_beli', 'id');
        return view(
            'pages.produk_beli.add',
            ['kategoribeli' => $kategoribeli],
        );
    }

    public function store(Request $request)
    {
        $request->validate([
            'kategori_beli' => 'required',
            'nama_produk_beli' => 'required|max:255',
            'kode_produk_beli' => 'required|unique:produk_beli|max:3',
            'harga_beli' => 'required|numeric',
            'stok' => 'required|numeric',
        ]);

        $produkbeli = new ProdukBeli;
        $produkbeli->id_kategori_beli = $request->kategori_beli;
        $produkbeli->nama_produk_beli = $request->nama_produk_beli;
        $produkbeli->kode_produk_beli = $request->kode_produk_beli;
        $produkbeli->harga_beli = $request->harga_beli;
        $produkbeli->stok = $request->stok;
        $produkbeli->save();

        return redirect('produk-beli')->with('success', 'Produk beli berhasil ditambahkan');
    }

    public function edit($id)
    {
        $produkbeli = ProdukBeli::join('kategori_beli', 'kategori_beli.id', '=', 'produk_beli.id_kategori_beli')
            ->where('produk_beli.id', '=', $id)
            ->get([
                'produk_beli.id', 'produk_beli.id_kategori_beli', 'produk_beli.nama_produk_beli',
                'produk_beli.kode_produk_beli',  'produk_beli.harga_beli', 'produk_beli.stok',
            ]);

        $kategoribeli = KategoriBeli::pluck('kategori_beli', 'id');

        // dd($produkbeli);

        return view(
            'pages.produk_beli.edit',
            ['produkbeli' => $produkbeli],
            ['kategoribeli' => $kategoribeli],
        );
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'id_kategori_beli' => 'required',
            'nama_produk_beli' => 'required|max:255',
            'kode_produk_beli' => 'required',
            'harga_beli' => 'required|numeric',
            'stok' => 'required|numeric',
        ]);

        $produkbeli = ProdukBeli::find($id);
        $produkbeli->id_kategori_beli = $request->id_kategori_beli;
        $produkbeli->nama_produk_beli = $request->nama_produk_beli;
        $produkbeli->kode_produk_beli = $request->kode_produk_beli;
        $produkbeli->harga_beli = $request->harga_beli;
        $produkbeli->stok = $request->stok;
        $produkbeli->update();

        return redirect('produk-beli')->with('success', 'Data produk beli berhasil dipebaharui');
    }

    public function delete($id)
    {
        ProdukBeli::find($id)->delete();

        return redirect('produk-beli')->with('success', 'Data produk beli berhasil dihapus');
    }
}
