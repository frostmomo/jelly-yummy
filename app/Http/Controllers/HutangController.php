<?php

namespace App\Http\Controllers;

use App\Models\Pembelian;
use PDF;
use Carbon\Carbon;
use Illuminate\Http\Request;

class HutangController extends Controller
{
    public function generate_pdf(Request $request)
    {
        $startDay = $request->input('tanggal_awal');
        $endDay = $request->input('tanggal_akhir');

        $startOfDay = Carbon::parse($startDay)->startOfDay();
        $endOfDay = Carbon::parse($endDay)->endOfDay();

        $hutang = Pembelian::join('users', 'users.id', '=', 'pembelian.id_user')
            ->join('supplier', 'supplier.id', '=', 'pembelian.id_supplier')
            ->where('pembelian.created_at', [$startOfDay, $endOfDay])
            ->select(
                'users.name',
                'supplier.nama_supplier',
                'pembelian.subtotal',
                'pembelian.bayar',
                'pembelian.created_at',

            )
            ->get();

        $pdf = PDF::loadView('pages.hutang.pdf', compact('hutang', 'startDay', 'endDay'));

        return $pdf->download('TirtaRahayuLaporanHutang-' . date('d M Y', strtotime($startDay)) . ' - ' . date('d M Y', strtotime($endDay)) . '.pdf');
    }

    public function index()
    {
        $hutang = Pembelian::join('users', 'users.id', '=', 'pembelian.id_user')
            ->join('supplier', 'supplier.id', '=', 'pembelian.id_supplier')
            ->where('pembelian.bayar', '!=', 0)
            ->select(
                'pembelian.id',
                'users.name',
                'supplier.nama_supplier',
                'pembelian.subtotal',
                'pembelian.bayar'
            )
            ->get();

        return view('pages.hutang.index', [
            'hutang' => $hutang
        ]);
    }
}
