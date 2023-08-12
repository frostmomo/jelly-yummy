<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class KategoriProdukJualController extends Controller
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
        return view('pages.kategori_produk.produk_jual.add');
    }

    public function store(Request $request)
    {
        //validasi data input kategori jual
        $request->validate([
            'kategori_jual' => 'required',
        ]);

        //get data kategori jual dari database
        $dataKategoriJual = KategoriJual::all();
        $cek = [];

        //memasukkan data kategori jual ke array cek
        foreach($dataKategoriJual as $data)
        {
            $cek[] = $data->kategori_jual;
        }

        //cek apabila kategori jual sudah ada
        if(in_array($request->kategori_jual, $cek))
        {
            //kembali dengan error jika kategori jual yang dimasukkan sudah ada
            return redirect()->back()->with('failed', 'Kategori jual sudah ada');
        }

        //buat data baru untuk kategori jual jika data belum ada
        $kategorijual = new KategoriJual;
            $kategorijual->kategori_jual = $request->kategori_jual;
        $kategorijual->save();

        //kembali ke menu kategori jual
        return redirect()->back()->with('success', 'Kategori jual berhasil ditambahkan');
    }
}
