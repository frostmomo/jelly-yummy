<?php

namespace App\Http\Controllers;

use App\Models\Salesman;
use Illuminate\Http\Request;

class SalesmanController extends Controller
{
    //
    public function index()
    {
        $salesman = Salesman::all();
        return view('pages.salesman.index', ['salesman' => $salesman]);
    }

    public function create()
    {
        return view('pages.salesman.create');
    }

    public function store(Request $request) 
    {
        //validasi data salesman yang akan ditambahkan
        $request->validate([
            'nama_salesman' => 'required|max:255',
            'alamat_salesman' => 'required',
        ]);

        //store data salesman ke database
        $salesman = new Salesman;
            $salesman->nama_salesman = ucwords(strtolower($request->nama_salesman));
            $salesman->alamat_salesman = $request->alamat_salesman;
        $salesman->save();

        //redirect ke index salesman
        return redirect('salesman')->with('success', 'Data salesman berhasil ditambahkan');
    }

    public function edit($id) 
    {
        $salesman = Salesman::find($id);
        return view('pages.salesman.edit', ['salesman' => $salesman]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_salesman' => 'required|max:255',
            'alamat_salesman' => 'required',
        ]);

        $salesman = Salesman::find($id);
            $salesman->nama_salesman = $request->nama_salesman;
            $salesman->alamat_salesman = $request->alamat_salesman;
        $salesman->update();

        return redirect('salesman')->with('success', 'Data salesman berhasil diperbaharui');
    }

    public function delete($id)
    {
        Salesman::find($id)->delete();

        return redirect('salesman')->with('success', 'Data salesman berhasil dihapus');
    }
}
