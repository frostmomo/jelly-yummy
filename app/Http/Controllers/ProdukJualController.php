<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProdukJualController extends Controller
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

    public function index()
    {
        return view('pages.produk_jual');
    }

    public function create()
    {
        return view('pages.produk_jual.add');
    }
}
