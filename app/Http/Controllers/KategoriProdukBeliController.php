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
    public function __construct()
    {
        $this->middleware('auth');
    }

    // public function index()
    // {
    //     return view('');
    // }

    public function create()
    {
        return view('pages.kategori_produk.produk_beli.add');
    }

    public function store(Request $request)
    {
        //validasi data input kategori beli
        $request->validate([
            'kategori_beli' => 'required',
        ]);

        //get data kategori beli dari database
        $dataKategoriBeli = KategoriBeli::all();
        $cek = [];

        //memasukkan data kategori beli ke array cek
        foreach($dataKategoriBeli as $data)
        {
            $cek[] = $data->kategori_beli;
        }

        //cek apabila kategori beli sudah ada
        if(in_array($request->kategori_beli, $cek))
        {
            //kembali dengan error jika kategori beli yang dimasukkan sudah ada
            return redirect()->back()->with('failed', 'Kategori beli sudah ada');
        }

        //buat data baru untuk kategori beli jika data belum ada
        $kategoriBeli = new KategoriBeli;
            $kategoriBeli->kategori_beli = $request->kategori_beli;
        $kategoriBeli->save();

        //kembali ke menu kategori beli
        return redirect()->back()->with('success', 'Kategori beli berhasil ditambahkan');
    }
}
