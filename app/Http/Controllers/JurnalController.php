<?php

namespace App\Http\Controllers;

use PDF;
use Carbon\Carbon;
use App\Models\Akun;
use App\Models\Penerimaan;
use App\Models\Pengeluaran;
use Illuminate\Http\Request;

class JurnalController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    public function generate_pdf(Request $request)
    {
        $startDay = $request->input('tanggal_awal');
        $endDay = $request->input('tanggal_akhir');

        $startOfDay = Carbon::parse($startDay)->startOfDay();
        $endOfDay = Carbon::parse($endDay)->endOfDay();

        $penerimaan = Penerimaan::join('penerimaan_detail', 'penerimaan_detail.id_penerimaan', '=', 'penerimaan.id')
            ->join('akun', 'akun.id', '=', 'penerimaan_detail.id_akun')
            ->whereBetween('penerimaan.created_at', [$startOfDay, $endOfDay])
            ->select(
                'penerimaan.created_at',
                'akun.kode_akun',
                'penerimaan.uraian', 
                'penerimaan_detail.keterangan',
                'penerimaan_detail.tipe_transaksi',
                'penerimaan.subtotal',
            )->orderByDesc('penerimaan.created_at')
            ->get();
        
        $pengeluaran = Pengeluaran::join('pengeluaran_detail', 'pengeluaran_detail.id_pengeluaran', '=', 'pengeluaran.id')
        ->join('akun', 'akun.id', '=', 'pengeluaran_detail.id_akun')
        ->whereBetween('pengeluaran.created_at', [$startOfDay, $endOfDay])
        ->select(
            'pengeluaran.created_at',
            'akun.kode_akun',
            'pengeluaran.uraian', 
            'pengeluaran_detail.keterangan',
            'pengeluaran_detail.tipe_transaksi',
            'pengeluaran.subtotal',
        )->orderByDesc('pengeluaran.created_at')
        ->get();

        $keuangan = array_merge($penerimaan->toArray(), $pengeluaran->toArray());
        $keuangan = collect($keuangan)->sortBy('created_at');

        $pdf = PDF::loadView('pages.jurnal.pdf', compact('keuangan', 'startDay', 'endDay'));

        return $pdf->download('TirtaRahayuLaporanKeuangan-' . date('d M Y', strtotime($startDay)) . ' - ' . date('d M Y', strtotime($endDay)) . '.pdf');
    }

    public function index()
    {
        $penerimaan = Penerimaan::join('penerimaan_detail', 'penerimaan_detail.id_penerimaan', '=', 'penerimaan.id')
            ->join('akun', 'akun.id', '=', 'penerimaan_detail.id_akun')
            ->select(
                'penerimaan.created_at',
                'akun.kode_akun',
                'penerimaan.uraian', 
                'penerimaan_detail.keterangan',
                'penerimaan_detail.tipe_transaksi',
                'penerimaan.subtotal',
            )->orderByDesc('penerimaan.created_at')
            ->get();
        
        $pengeluaran = Pengeluaran::join('pengeluaran_detail', 'pengeluaran_detail.id_pengeluaran', '=', 'pengeluaran.id')
        ->join('akun', 'akun.id', '=', 'pengeluaran_detail.id_akun')
        ->select(
            'pengeluaran.created_at',
            'akun.kode_akun',
            'pengeluaran.uraian', 
            'pengeluaran_detail.keterangan',
            'pengeluaran_detail.tipe_transaksi',
            'pengeluaran.subtotal',
        )->orderByDesc('pengeluaran.created_at')
        ->get();

        $keuangan = array_merge($penerimaan->toArray(), $pengeluaran->toArray());
        $keuangan = collect($keuangan)->sortBy('created_at');

        // dd($keuangan);

        return view('pages.jurnal.index', [
            'keuangan' => $keuangan,
        ]);
    }

    public function create()
    {
        return view('pages.jurnal.add');
    }
}
