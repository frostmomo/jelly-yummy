<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    //
    public function index()
    {
        $customer = Customer::all();
        return view('pages.customer.index', ['customer' => $customer]);
    }

    public function create()
    {
        return view('pages.customer.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_customer' => 'required|max:255',
            'alamat_customer' => 'required',
            'telepon_customer' => 'required|numeric|digits_between:8,15',
        ]);

        $customer = new Customer;
            $customer->nama_customer = $request->nama_customer;
            $customer->alamat_customer = $request->alamat_customer;
            $customer->telepon_customer = $request->telepon_customer;
        $customer->save();

        return redirect('customer')->with('success', 'Data customer berhasil ditambahkan');
    }

    public function edit($id)
    {
        $customer = Customer::find($id);
        return view('pages.customer.edit', ['customer' => $customer]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_customer' => 'required|max:255',
            'alamat_customer' => 'required',
            'telepon_customer' => 'required|numeric|digits_between:8,15',
        ]);

        $customer = Customer::find($id);
            $customer->nama_customer = $request->nama_customer;
            $customer->alamat_customer = $request->alamat_customer;
            $customer->telepon_customer = $request->telepon_customer;
        $customer->update();

        return redirect('customer')->with('success', 'Data customer berhasil diperbaharui');
    }

    public function delete($id)
    {
        Customer::find($id)->delete();
        return redirect('customer')->with('success', 'Data customer berhasil dihapus');
    }
}
