<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SalesmanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //redirect ke data salesman
        return view();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //validasi data salesman
        $request->validate([
            'nama_salesman' => 'required|max:255',
            'alamat_salesman' => 'required',
        ]);

        //store data ke tabel salesman
        $salesman = new Salesman;
            $salesman->nama_salesman = ucwords(strtolower($request->nama_salesman));
            $salesman->alamat_salesman = $request->alamat_salesman;
        $salesman->save();

        //redirect ke halaman data salesman
        return redirect()->route('')
                        ->with('success','Data Salesman berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //validasi input data edit salesman
        $request->validate([
            'nama_salesman' => 'required|max:255',
            'alamat_salesman' => 'required',
        ]);

        //cari data salesman yang akan diedit
        $salesman = Salesman::find($id);

        //update data salesman
        $salesman->nama_salesman = ucwords(strtolower($request->nama_salesman));
        $salesman->alamat_salesman = $request->alamat_salesman;
        $salesman->telepon_salesman = $request->telepon_salesman;
        $salesman->update();

        return redirect('')->with('success', 'Data Salesman Berhasil Diperbaharui');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //hapus data salesman
        $salesman = Salesman::find($id)->delete();

        //
        return redirect('')->with('success', 'Data salesman Berhasil Dihapus');
    }
}
