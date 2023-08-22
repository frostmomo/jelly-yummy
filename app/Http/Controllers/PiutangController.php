<?php

namespace App\Http\Controllers;

use App\Models\Piutang;
use Illuminate\Http\Request;

class PiutangController extends Controller
{
    //
    public function index()
    {
        $piutang = Piutang::join('penjualan', 'penjualan.id', '=', 'piutang.id_penjualan')
            ->join('users', 'users.id', '=', 'penjualan.id_user')
            ->join('customer', 'customer.id', '=', 'penjualan.id_customer')
            ->join('salesman', 'salesman.id', '=', 'penjualan.id_salesman')
            ->where('piutang.bayar', '!=', 0)
            ->select(
                'users.name',
                'customer.nama_customer',
                'salesman.nama_salesman',
                'piutang.bayar',
            )
            ->get();
            
        return view('pages.piutang.index',[
            'piutang' => $piutang,
        ]);
    }
}
