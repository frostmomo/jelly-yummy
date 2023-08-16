<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Salesman;
use App\Models\Penjualan;
use App\Models\PenjualanDetail;
use App\Models\Piutang;
use App\Models\ProdukJual;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PenjualanController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // $penjualan = Penjualan::all();
        $penjualan = Penjualan::join('users', 'users.id', '=' ,'penjualan.id_user')
            ->join('customer', 'customer.id', '=', 'penjualan.id_customer')
            ->join('salesman', 'salesman.id', '=', 'penjualan.id_salesman')
            ->get([
                'penjualan.id', 'penjualan.total_item', 'penjualan.subtotal', 'penjualan.diskon', 'penjualan.created_at',
                'users.name', 'customer.nama_customer', 'salesman.nama_salesman',
            ]);

        return view('pages.penjualan.index',
            ['penjualan' => $penjualan]
        );
    }

    public function create()
    {
        // $tes = Penjualan::all()->sum('subtotal');
        // $diskon = 10;
        // $subtotal = $tes - (($tes * $diskon) / 100);
        // dd($subtotal);
        $customer = Customer::pluck('nama_customer', 'id');
        $salesman = Salesman::pluck('nama_salesman', 'id');
        $produkjual = ProdukJual::join('kategori_jual', 'kategori_jual.id', '=', 'produk_jual.id_kategori_jual')
            ->get([
                'produk_jual.id', 'produk_jual.nama_produk_jual', 'produk_jual.kode_produk_jual',
                'produk_jual.harga_produksi', 'produk_jual.harga_jual', 'produk_jual.stok',
                'kategori_jual.kategori_jual',
            ]);

            // dd($produkjual);
        return view('pages.penjualan.add',[
            'produkjual' => $produkjual,
            'customer' => $customer,
            'salesman' => $salesman,
        ]);
    }

    public function store(Request $request)
    {
        // dd($request);
        $request->validate([
            'id_customer' => 'required',
            'id_salesman' => 'required',
            'qty_1' => 'nullable|numeric',
            'qty_2' => 'nullable|numeric',
            'qty_3' => 'nullable|numeric',
            'diskon' => 'nullable|numeric',
            'tunai' => 'required',
        ]);

        $penjualan = new Penjualan;
        $penjualan->id_user = Auth::user()->id;
        $penjualan->id_customer = $request->id_customer;
        $penjualan->id_salesman = $request->id_salesman;
        $penjualan->save();

        if(!is_null($request->qty_1))
        {
            $produkjual_1 = ProdukJual::find($request->id_produk_1);

            $penjualanDetail = new PenjualanDetail;
            $penjualanDetail->id_penjualan = $penjualan->id;
            $penjualanDetail->id_produk_jual = $request->id_produk_1;

            if(($produkjual_1->stok - $request->qty_1) < 0)
            {
                return redirect('penjualan.create')->with('failed', 'Stok barang tidak mencukupi');
            }

            $penjualanDetail->qty = $request->qty_1;
            $produkjual_1->stok = $produkjual_1->stok - $request->qty_1;
            $penjualanDetail->total = $request->qty_1 * $produkjual_1->harga_jual;
            $produkjual_1->update();
            $penjualanDetail->save();
        }

        if(!is_null($request->qty_2))
        {
            $produkjual_2 = ProdukJual::find($request->id_produk_2);

            $penjualanDetail = new PenjualanDetail;
            $penjualanDetail->id_penjualan = $penjualan->id;
            $penjualanDetail->id_produk_jual = $request->id_produk_2;

            if(($produkjual_2->stok - $request->qty_2) < 0)
            {
                return redirect('penjualan.create')->with('failed', 'Stok barang tidak mencukupi');
            }
            
            $penjualanDetail->qty = $request->qty_2;
            $produkjual_2->stok = $produkjual_2->stok - $request->qty_2;
            $penjualanDetail->total = $request->qty_2 * $produkjual_2->harga_jual;
            $produkjual_2->update();
            $penjualanDetail->save();
        }

        if(!is_null($request->qty_3))
        {
            $produkjual_3 = ProdukJual::find($request->id_produk_3);

            $penjualanDetail = new PenjualanDetail;
            $penjualanDetail->id_penjualan = $penjualan->id;
            $penjualanDetail->id_produk_jual = $request->id_produk_3;

            if(($produkjual_3->stok - $request->qty_3) < 0)
            {
                return redirect('penjualan/create')->with('failed', 'Stok barang tidak mencukupi');
            }
            
            $penjualanDetail->qty = $request->qty_3;
            $produkjual_3->stok = $produkjual_3->stok - $request->qty_3;
            $penjualanDetail->total = $request->qty_3 * $produkjual_3->harga_jual;
            $produkjual_3->update();
            $penjualanDetail->save();
        }

        $penjualan->total_item = PenjualanDetail::where('id_penjualan', '=', $penjualan->id)->count();
        $penjualan->diskon = $request->diskon;

        $subtotal = PenjualanDetail::where('id_penjualan', '=', $penjualan->id)->sum('total');

        $discountedTotal = $subtotal - (($subtotal * $request->diskon) / 100);

        $penjualan->subtotal = $discountedTotal;

        if($request->tunai == 0)
        {
            $piutang = new Piutang;
            $piutang->id_penjualan = $penjualan->id;
            $piutang->bayar = $discountedTotal;
            $piutang->save();
        }

        $penjualan->save();
        
        return redirect('penjualan')->with('success', 'Penjualan berhasil ditambahkan');
    }
}
