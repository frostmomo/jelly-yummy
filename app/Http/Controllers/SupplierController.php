<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    //
    public function index()
    {
        $supplier = Supplier::all();
        return view('pages.supplier.index', ['supplier' => $supplier]);
    }

    public function create()
    {
        return view('pages.supplier.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_supplier' => 'required|max:255',
            'alamat_supplier' => 'required',
            'telepon_supplier' => 'required|numeric|digits_between:8,15',
        ]);

        $supplier = new Supplier;
            $supplier->nama_supplier = $request->nama_supplier;
            $supplier->alamat_supplier = $request->alamat_supplier;
            $supplier->telepon_supplier = $request->telepon_supplier;
        $supplier->save();

        return redirect('supplier')->with('success', 'Data supplier berhasil ditambahkan');
    }

    public function edit($id)
    {
        $supplier = Supplier::find($id);
        return view('pages.supplier.edit', ['supplier' => $supplier]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_supplier' => 'required|max:255',
            'alamat_supplier' => 'required',
            'telepon_supplier' => 'required|numeric|digits_between:8,15',
        ]);

        $supplier = Supplier::find($id);
            $supplier->nama_supplier = $request->nama_supplier;
            $supplier->alamat_supplier = $request->alamat_supplier;
            $supplier->telepon_supplier = $request->telepon_supplier;
        $supplier->update();

        return redirect('supplier')->with('success', 'Data supplier berhasil diperbaharui');
    }

    public function delete($id)
    {
        supplier::find($id)->delete();
        return redirect('supplier')->with('success', 'Data supplier berhasil dihapus');
    }
}
