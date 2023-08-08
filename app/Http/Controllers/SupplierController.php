<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //redirect ke data supplier
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
        //validasi data supplier
        $request->validate([
            'nama_supplier' => 'required|max:255',
            'alamat_supplier' => 'required',
            'telepon_supplier' => 'required|numeric|digits_between:8,20',
        ]);

        //store data ke tabel supplier
        $supplier = new Supplier;
            $supplier->nama_supplier = ucwords(strtolower($request->nama_supplier));
            $supplier->alamat_supplier = $request->alamat_supplier;
            $supplier->telepon_supplier = $request->telepon_supplier;
        $supplier->save();

        //redirect ke halaman data supplier
        return redirect()->route('')
                        ->with('success','Data Supplier berhasil ditambahkan');
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
            'telepon_salesman' => 'required|numeric|digits_between:8,20',
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
        //hapus data supplier
        $supplier = Supplier::find($id)->delete();

        //
        return redirect('')->with('success', 'Data Supplier Berhasil Dihapus');
    }
}
