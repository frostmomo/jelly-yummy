<?php

namespace App\Http\Controllers;

use App\Models\KategoriJual;
use App\Models\ProdukJual;
use Illuminate\Http\Request;

class ProdukJualController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    public function index()
    {
        $kategorijual = KategoriJual::all();
        $produkjual = ProdukJual::join('kategori_jual', 'kategori_jual.id', '=', 'produk_jual.id_kategori_jual')
            ->get([
                'produk_jual.id', 'produk_jual.nama_produk_jual', 'produk_jual.kode_produk_jual', 
                'produk_jual.harga_produksi', 'produk_jual.harga_jual', 'produk_jual.stok',
                'kategori_jual.kategori_jual',
            ]);
        // dd($produkjual);
        return view('pages.produk_jual.index',
            ['kategorijual' => $kategorijual],
            ['produkjual' => $produkjual],
        );
    }

    public function create()
    {
        $kategorijual = KategoriJual::pluck('kategori_jual', 'id');
        return view('pages.produk_jual.add', 
            ['kategorijual' => $kategorijual],
        );
    }

    public function store(Request $request)
    {
        $request->validate([
            'kategori_jual' => 'required',
            'nama_produk_jual' => 'required|max:255',
            'kode_produk_jual' => 'required|unique:produk_jual',
            'harga_produksi' => 'required|numeric',
            'harga_jual' => 'required|numeric',
            'stok' => 'required|numeric',
        ]);

        $produkjual = new Produkjual;
            $produkjual->id_kategori_jual = $request->kategori_jual;
            $produkjual->nama_produk_jual = $request->nama_produk_jual;
            $produkjual->kode_produk_jual = $request->kode_produk_jual;
            $produkjual->harga_produksi = $request->harga_produksi;
            $produkjual->harga_jual = $request->harga_jual;
            $produkjual->stok = $request->stok;
        $produkjual->save();

        return redirect('produk-jual')->with('success', 'Produk jual berhasil ditambahkan');
    }

    public function edit($id)
    {
        $produkjual = ProdukJual::join('kategori_jual', 'kategori_jual.id', '=', 'produk_jual.id_kategori_jual')
            ->where('produk_jual.id', '=', $id)
            ->get([
                'produk_jual.id', 'produk_jual.id_kategori_jual', 'produk_jual.nama_produk_jual',
                'produk_jual.kode_produk_jual', 'produk_jual.harga_produksi', 'produk_jual.harga_jual',
                'produk_jual.stok'
            ]);

        $kategorijual = KategoriJual::pluck('kategori_jual', 'id');
        
        // dd($produkjual);

        return view('pages.produk_jual.edit', 
            ['produkjual' => $produkjual],
            ['kategorijual' => $kategorijual],
        );
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'id_kategori_jual' => 'required',
            'nama_produk_jual' => 'required|max:255',
            'kode_produk_jual' => 'required',
            'harga_produksi' => 'required|numeric',
            'harga_jual' => 'required|numeric',
            'stok' => 'required|numeric',
        ]);

        $produkjual = ProdukJual::find($id);
            $produkjual->id_kategori_jual = $request->id_kategori_jual;
            $produkjual->nama_produk_jual = $request->nama_produk_jual;
            $produkjual->kode_produk_jual = $request->kode_produk_jual;
            $produkjual->harga_produksi = $request->harga_produksi;
            $produkjual->harga_jual = $request->harga_jual;
            $produkjual->stok = $request->stok;
        $produkjual->update();

        return redirect('produk-jual')->with('success', 'Data produk jual berhasil dipebaharui');
    }

    public function delete($id)
    {
        ProdukJual::find($id)->delete();

        return redirect('produk-jual')->with('success', 'Data produk jual berhasil dihapus');
    }
}
