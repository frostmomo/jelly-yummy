<?php

namespace App\Http\Controllers;

use App\Models\Akun;
use Illuminate\Http\Request;

class AkunController extends Controller
{
    //
    public function index()
    {
        $akun = Akun::all();

        return view('pages.akun.index', [
            'akun' => $akun,
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_akun' => 'required|max:255',
            'kelompok' => 'required',
            'kode_akun' => 'required|unique:akun',
        ]);

        $akun = new Akun;
        $akun->nama_akun = $request->nama_akun;
        $akun->kelompok_akun = $request->kelompok;
        $akun->kode_akun = $request->kode_akun;
        $akun->save();

        return redirect()->back()->with('success', 'Akun berhasil ditambahkan');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_akun' => 'required|max:255',
            'kelompok' => 'required',
            'kode_akun' => 'required',
        ]);

        $akun = Akun::find($id);
        $akun->nama_akun = $request->nama_akun;
        $akun->kelompok_akun = $request->kelompok;
        $akun->kode_akun = $request->kode_akun;
        $akun->update();

        return redirect()->back()->with('success', 'Akun berhasil diperbaharui');
    }

    public function delete($id)
    {
        Akun::find($id)->delete();

        return redirect()->back()->with('success', 'Akun berhasil dihapus');
    }
}
