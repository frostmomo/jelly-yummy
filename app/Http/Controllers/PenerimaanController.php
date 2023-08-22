<?php

namespace App\Http\Controllers;

use App\Models\Penerimaan;
use Illuminate\Http\Request;

class PenerimaanController extends Controller
{
    //
    public function index()
    {
        $penerimaan = Penerimaan::join('users', 'users.id', '=', 'penerimaan.id_user')
            ->join('penerimaan_detail', 'penerimaan_detail.id_penerimaan', '=', 'penerimaan.id')
            ->get();
        return view('pages.penerimaan.index',[
            'penerimaan' => $penerimaan,
        ]);
    }

    public function store(Request $request)
    {

    }
}
