<?php

namespace App\Http\Controllers;

use PDF;
use Carbon\Carbon;
use App\Models\Akun;
use App\Models\Penerimaan;
use Illuminate\Http\Request;
use App\Models\PenerimaanDetail;
use Illuminate\Support\Facades\Auth;

class PenerimaanController extends Controller
{
    //
    public function generate_pdf(Request $request)
    {
        $startDay = $request->input('tanggal_awal');
        $endDay = $request->input('tanggal_akhir');
        
        $startOfDay = Carbon::parse($startDay)->startOfDay();
        $endOfDay = Carbon::parse($endDay)->endOfDay();

        $penerimaan = Penerimaan::join('users', 'users.id', '=', 'penerimaan.id_user')
            ->join('penerimaan_detail', 'penerimaan_detail.id_penerimaan', '=', 'penerimaan_detail.id_penerimaan')
            ->join('akun', 'akun.id', '=', 'penerimaan_detail.id_akun')
            ->whereBetween('penerimaan.created_at', [$startOfDay, $endOfDay])
            ->orderBy('penerimaan.created_at')
            ->get([
                'penerimaan.uraian', 
                'penerimaan_detail.keterangan', 
                'penerimaan_detail.tipe_transaksi', 
                'penerimaan.subtotal',
                'penerimaan.created_at', 
                'akun.kode_akun',
                'users.name',
            ]);

        $pdf = PDF::loadView('pages.penerimaan.pdf', compact('penerimaan', 'startDay', 'endDay'));

        return $pdf->download('TirtaRahayuLaporanPenerimaan-' . date('d M Y', strtotime($startDay)) . ' - ' . date('d M Y', strtotime($endDay)) . '.pdf');
    }

    public function index()
    {
        $penerimaan = Penerimaan::join('users', 'users.id', '=', 'penerimaan.id_user')
            ->join('penerimaan_detail', 'penerimaan_detail.id_penerimaan', '=', 'penerimaan.id')
            ->join('akun', 'akun.id', '=', 'penerimaan_detail.id_akun')
            ->select(
                'penerimaan.id', 
                'penerimaan.uraian', 
                'penerimaan.subtotal', 
                'penerimaan_detail.keterangan',
                'penerimaan_detail.id_akun',
                'akun.kode_akun',
                'users.name',
            )->get();
        
        // $penerimaan = Penerimaan::all();
        // dd($penerimaan);

        $akun = Akun::pluck('nama_akun', 'id');

        return view('pages.penerimaan.index',[
            'penerimaan' => $penerimaan,
            'akun' => $akun,
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'uraian' => 'required',
            'keterangan' => 'required',
            'total' => 'required|numeric',
            'akun' => 'required',
        ]);

        $penerimaan = new Penerimaan;
        $penerimaan->id_user = Auth::user()->id;
        $penerimaan->uraian = $request->uraian;
        $penerimaan->save();

        $penerimaanDetail = new PenerimaanDetail;
        $penerimaanDetail->id_penerimaan = $penerimaan->id;
        $penerimaanDetail->id_akun = $request->akun;
        $penerimaanDetail->keterangan = $request->keterangan;
        $penerimaanDetail->total = $request->total;
        $penerimaanDetail->save();

        $penerimaan->subtotal = $penerimaanDetail->total;
        $penerimaan->update();

        return redirect()->back()->with('success', 'Penerimaan berhasil ditambahkan');
    }

    public function update(Request $request, $id)
    {

        // dd($request);
        $request->validate([
            'uraian' => 'required',
            'keterangan' => 'required',
            'total' => 'required|numeric',
            'akun' => 'required',
        ]);

        $penerimaan = Penerimaan::find($id);
        $penerimaan->uraian = $request->uraian;
        $penerimaan->update();

        $cariIdPenerimaanDetail = PenerimaanDetail::where('id_penerimaan', '=', $id)->get();
        
        foreach($cariIdPenerimaanDetail as $cari)
        {
            $idPenerimaanDetail = $cari->id;
        }

        // dd($idPenerimaanDetail);

        $penerimaanDetail = PenerimaanDetail::find($idPenerimaanDetail);
        $penerimaanDetail->id_akun = $request->akun;
        $penerimaanDetail->keterangan = $request->keterangan;
        $penerimaanDetail->total = $request->total;
        $penerimaanDetail->update();

        $penerimaan->subtotal = $penerimaanDetail->total;
        $penerimaan->update();

        return redirect()->back()->with('success', 'Penerimaan berhasil diperbaharui');
    }

    public function delete($id)
    {
        Penerimaan::find($id)->delete();
        return redirect()->back()->with('success', 'Data penerimaan berhasil dihapus');
    }
}
