<?php

namespace App\Http\Controllers;

use PDF;
use Carbon\Carbon;
use App\Models\Akun;
use App\Models\Pengeluaran;
use Illuminate\Http\Request;
use App\Models\PengeluaranDetail;
use Illuminate\Support\Facades\Auth;

class PengeluaranController extends Controller
{
    public function generate_pdf(Request $request)
    {
        $startDay = $request->input('tanggal_awal');
        $endDay = $request->input('tanggal_akhir');
        
        $startOfDay = Carbon::parse($startDay)->startOfDay();
        $endOfDay = Carbon::parse($endDay)->endOfDay();

        $pengeluaran = Pengeluaran::join('users', 'users.id', '=', 'pengeluaran.id_user')
            ->join('pengeluaran_detail', 'pengeluaran_detail.id_pengeluaran', '=', 'pengeluaran_detail.id_pengeluaran')
            ->join('akun', 'akun.id', '=', 'pengeluaran_detail.id_akun')
            ->whereBetween('pengeluaran.created_at', [$startOfDay, $endOfDay])
            ->orderBy('pengeluaran.created_at')
            ->get([
                'pengeluaran.uraian', 
                'pengeluaran_detail.keterangan', 
                'pengeluaran_detail.tipe_transaksi', 
                'pengeluaran.subtotal',
                'pengeluaran.created_at', 
                'akun.kode_akun',
                'users.name',
            ]);

        $pdf = PDF::loadView('pages.pengeluaran.pdf', compact('pengeluaran', 'startDay', 'endDay'));

        return $pdf->download('TirtaRahayuLaporanPengeluaran-' . date('d M Y', strtotime($startDay)) . ' - ' . date('d M Y', strtotime($endDay)) . '.pdf');
    }
    
    public function index()
    {
        $pengeluaran = Pengeluaran::join('users', 'users.id', '=', 'pengeluaran.id_user')
            ->join('pengeluaran_detail', 'pengeluaran_detail.id_pengeluaran', '=', 'pengeluaran.id')
            ->join('akun', 'akun.id', '=', 'pengeluaran_detail.id_akun')
            ->select(
                'pengeluaran.id',
                'pengeluaran.uraian',
                'pengeluaran.subtotal',
                'pengeluaran_detail.keterangan',
                'pengeluaran_detail.id_akun',
                'akun.kode_akun',
                'users.name',
            )->get();

        $akun = Akun::pluck('nama_akun', 'id');

        return view('pages.pengeluaran.index', [
            'pengeluaran' => $pengeluaran,
            'akun' => $akun
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'uraian' => 'required',
            'keterangan' => 'required',
            'total' => 'required',
            'akun' => 'required',
        ]);

        $pengeluaran = new Pengeluaran();
        $pengeluaran->id_user = Auth::user()->id;
        $pengeluaran->uraian = $request->uraian;
        $pengeluaran->save();

        $pengeluaranDetail = new PengeluaranDetail();
        $pengeluaranDetail->id_pengeluaran = $pengeluaran->id;
        $pengeluaranDetail->id_akun = $request->akun;
        $pengeluaranDetail->keterangan = $request->keterangan;
        $pengeluaranDetail->total = $request->total;
        $pengeluaranDetail->save();

        $pengeluaran->subtotal = $pengeluaranDetail->total;
        $pengeluaran->update();

        return redirect()->back()->with('success', 'Pengeluaran berhasil ditambahkan');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'uraian' => 'required',
            'keterangan' => 'required',
            'total' => 'required',
            'akun' => 'required',
        ]);

        $pengeluaran = Pengeluaran::find($id);
        $pengeluaran->uraian = $request->uraian;
        $pengeluaran->update();

        $cariIdPengeluaranDetail = PengeluaranDetail::where('id_pengeluaran', '=', $id)->get();

        foreach ($cariIdPengeluaranDetail as $cari) {
            $idPengeluaranDetail = $cari->id;
        }

        $pengeluaranDetail = PengeluaranDetail::find($idPengeluaranDetail);
        $pengeluaranDetail->id_akun = $request->akun;
        $pengeluaranDetail->keterangan = $request->keterangan;
        $pengeluaranDetail->total = $request->total;
        $pengeluaranDetail->update();

        $pengeluaran->subtotal = $pengeluaranDetail->total;
        $pengeluaran->update();

        return redirect()->back()->with('success', 'Pengeluaran berhasil diperbaharui');
    }

    public function delete($id)
    {
        Pengeluaran::find($id)->delete();
        return redirect()->back()->with('success',  'Data pengeluaran berhasil dihapus');
    }
}
