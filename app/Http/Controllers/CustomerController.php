<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
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
        //validasi data customer
        $request->validate([
            'nama_customer' => 'required|max:255',
            'alamat_customer' => 'required',
            'telepon_customer' => 'required|numeric|digits_between:8,20',
        ]);

        //store data ke tabel customer
        $customer = new Customer;
            $customer->nama_customer = ucwords(strtolower($request->nama_customer));
            $customer->alamat_customer = $request->alamat_customer;
            $customer->telepon_customer = $request->telepon_customer;
        $customer->save();

        //redirect ke halaman data customer
        return redirect()->route('')
                        ->with('success','Data customer berhasil ditambahkan');
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
        //validasi input data edit customer
        $request->validate([
            'nama_customer' => 'required|max:255',
            'alamat_customer' => 'required',
            'telepon_customer' => 'required|numeric|digits_between:8,20',
        ]);

        //cari data customer yang akan diedit
        $customer = Customer::find($id);

        //update data customer
        $customer->nama_customer = ucwords(strtolower($request->nama_customer));
        $customer->alamat_customer = $request->alamat_customer;
        $customer->telepon_customer = $request->telepon_customer;
        $customer->update();

        return redirect('')->with('success', 'Data Customer Berhasil Diperbaharui');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //hapus data customer
        $customer = Customer::find($id)->delete();

        //
        return redirect('')->with('success', 'Data Customer Berhasil Dihapus');
    }
}
