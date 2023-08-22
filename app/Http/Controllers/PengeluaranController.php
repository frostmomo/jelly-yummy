<?php

namespace App\Http\Controllers;

use App\Models\Akun;
use App\Models\Pengeluaran;
use App\Models\PengeluaranDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PengeluaranController extends Controller
{
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
                'akun.nama_akun',
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
