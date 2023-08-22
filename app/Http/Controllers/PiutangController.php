<?php

namespace App\Http\Controllers;

use PDF;
use Carbon\Carbon;
use App\Models\Piutang;
use Illuminate\Http\Request;

class PiutangController extends Controller
{
    public function generate_pdf(Request $request)
    {
        $startDay = $request->input('tanggal_awal');
        $endDay = $request->input('tanggal_akhir');

        $startOfDay = Carbon::parse($startDay)->startOfDay();
        $endOfDay = Carbon::parse($endDay)->endOfDay();

        $piutang = Piutang::join('penjualan', 'penjualan.id', '=', 'piutang.id_penjualan')
            ->join('users', 'users.id', '=', 'penjualan.id_user')
            ->join('customer', 'customer.id', '=', 'penjualan.id_customer')
            ->join('salesman', 'salesman.id', '=', 'penjualan.id_salesman')
            ->where('piutang.created_at', [$startOfDay, $endOfDay])
            ->select(
                'users.name',
                'customer.nama_customer',
                'salesman.nama_salesman',
                'piutang.bayar',
                'piutang.created_at',
            )
            ->get();

        $pdf = PDF::loadView('pages.piutang.pdf', compact('piutang', 'startDay', 'endDay'));

        return $pdf->download('TirtaRahayuLaporanPiutang-' . date('d M Y', strtotime($startDay)) . ' - ' . date('d M Y', strtotime($endDay)) . '.pdf');
    }

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

        return view('pages.piutang.index', [
            'piutang' => $piutang,
        ]);
    }
}
