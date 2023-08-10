<?php

namespace App\Http\Controllers;

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
}
