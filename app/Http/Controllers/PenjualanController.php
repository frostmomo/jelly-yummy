<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Salesman;
use App\Models\Penjualan;
use App\Models\PenjualanDetail;
use App\Models\Piutang;
use App\Models\ProdukJual;
use App\Models\ReturPenjualan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use PDF;

class PenjualanController extends Controller
{
    public function generate_pdf(Request $request)
    {
        $startDay = $request->input('tanggal_awal');
        $endDay = $request->input('tanggal_akhir');

        $startOfDay = Carbon::parse($startDay)->startOfDay();
        $endOfDay = Carbon::parse($endDay)->endOfDay();

        $penjualan = Penjualan::join('users', 'users.id', '=', 'penjualan.id_user')
            ->join('customer', 'customer.id', '=', 'penjualan.id_customer')
            ->join('salesman', 'salesman.id', '=', 'penjualan.id_salesman')
            ->whereBetween('penjualan.created_at', [$startOfDay, $endOfDay])
            ->select(
                'penjualan.id',
                'penjualan.total_item',
                'penjualan.subtotal',
                'penjualan.diskon',
                'penjualan.created_at',
                'users.name',
                'customer.nama_customer',
                'salesman.nama_salesman'
            )
            ->get();

        $pdf = PDF::loadView('pages.penjualan.pdf', compact('penjualan', 'startDay', 'endDay'));

        return $pdf->download('TirtaRahayuLaporanPenjualan-' . date('d M Y', strtotime($startDay)) . ' - ' . date('d M Y', strtotime($endDay)) . '.pdf');
    }

    public function index()
    {
        // $penjualan = Penjualan::all();
        $penjualan = Penjualan::join('users', 'users.id', '=', 'penjualan.id_user')
            ->join('customer', 'customer.id', '=', 'penjualan.id_customer')
            ->join('salesman', 'salesman.id', '=', 'penjualan.id_salesman')
            ->join('piutang', 'piutang.id_penjualan', '=', 'penjualan.id')
            ->select(
                'penjualan.id',
                'penjualan.tunai',
                'penjualan.subtotal',
                'penjualan.keterangan_penjualan',
                'penjualan.created_at',
                'users.name',
                'customer.nama_customer',
                'salesman.nama_salesman',
                'piutang.bayar',
            )->orderByDesc('penjualan.created_at')->get();

        return view(
            'pages.penjualan.index',
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
        return view('pages.penjualan.add', [
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

        if (!is_null($request->qty_1)) {
            $produkjual_1 = ProdukJual::find($request->id_produk_1);

            if (($produkjual_1->stok - $request->qty_1) < 0) {
                return redirect('penjualan.create')->with('failed', 'Stok barang tidak mencukupi');
            }

            $penjualanDetail = new PenjualanDetail;
            $penjualanDetail->id_penjualan = $penjualan->id;
            $penjualanDetail->id_produk_jual = $request->id_produk_1;
            $penjualanDetail->qty = $request->qty_1;
            $produkjual_1->stok = $produkjual_1->stok - $request->qty_1;
            $penjualanDetail->total = $request->qty_1 * $produkjual_1->harga_jual;
            $produkjual_1->update();
            $penjualanDetail->save();
        }

        if (!is_null($request->qty_2)) {
            $produkjual_2 = ProdukJual::find($request->id_produk_2);

            if (($produkjual_2->stok - $request->qty_2) < 0) {
                return redirect('penjualan.create')->with('failed', 'Stok barang tidak mencukupi');
            }

            $penjualanDetail = new PenjualanDetail;
            $penjualanDetail->id_penjualan = $penjualan->id;
            $penjualanDetail->id_produk_jual = $request->id_produk_2;
            $penjualanDetail->qty = $request->qty_2;
            $produkjual_2->stok = $produkjual_2->stok - $request->qty_2;
            $penjualanDetail->total = $request->qty_2 * $produkjual_2->harga_jual;
            $produkjual_2->update();
            $penjualanDetail->save();
        }

        if (!is_null($request->qty_3)) {
            $produkjual_3 = ProdukJual::find($request->id_produk_3);

            if (($produkjual_3->stok - $request->qty_3) < 0) {
                return redirect('penjualan/create')->with('failed', 'Stok barang tidak mencukupi');
            }

            $penjualanDetail = new PenjualanDetail;
            $penjualanDetail->id_penjualan = $penjualan->id;
            $penjualanDetail->id_produk_jual = $request->id_produk_3;
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
        // dd($discountedTotal);

        $penjualan->subtotal = $discountedTotal;

        if ($request->tunai == 0) {
            $piutang = new Piutang;
            $piutang->id_penjualan = $penjualan->id;
            $piutang->bayar = $discountedTotal;
            $piutang->save();

            $penjualan->tunai = 0;
            $penjualan->keterangan_penjualan = 'Belum Lunas';
        } else {
            $penjualan->tunai = $discountedTotal;
            $penjualan->keterangan_penjualan = 'Lunas';
        }

        $penjualan->save();

        return redirect('penjualan')->with('success', 'Penjualan berhasil ditambahkan');
    }

    public function detail($id)
    {
        $penjualan = Penjualan::join('users', 'users.id', '=', 'penjualan.id_user')
            ->join('customer', 'customer.id', '=', 'penjualan.id_customer')
            ->join('salesman', 'salesman.id', '=', 'penjualan.id_salesman')
            ->where('penjualan.id', '=', $id)
            ->get([
                'penjualan.id', 'users.name', 'customer.nama_customer', 'salesman.nama_salesman',
                'penjualan.total_item', 'penjualan.subtotal', 'penjualan.diskon', 'penjualan.id_customer',
                'penjualan.id_salesman',
            ]);

        $piutang = Piutang::where('id_penjualan', '=', $id)->get();

        $detailpenjualan = PenjualanDetail::join('penjualan', 'penjualan.id', '=', 'penjualan_detail.id_penjualan')
            ->join('produk_jual', 'produk_jual.id', '=', 'penjualan_detail.id_produk_jual')
            ->join('kategori_jual', 'kategori_jual.id', '=', 'produk_jual.id_kategori_jual')
            ->where('penjualan_detail.id_penjualan', '=', $id)
            ->get([
                'penjualan_detail.id', 'produk_jual.nama_produk_jual', 'penjualan_detail.qty',
                'penjualan_detail.total', 'kategori_jual.kategori_jual', 'penjualan_detail.id_produk_jual',
            ]);

        $customer = Customer::pluck('nama_customer', 'id');

        $salesman = Salesman::pluck('nama_salesman', 'id');

        $produkjual = ProdukJual::pluck('nama_produk_jual', 'id');

        return view('pages.penjualan.detail', [
            'penjualan' => $penjualan,
            'piutang' => $piutang,
            'detailpenjualan' => $detailpenjualan,
            'customer' => $customer,
            'salesman' => $salesman,
            'produkjual' => $produkjual,
        ]);
    }

    public function detail_penjualan($id, $idpenjualan)
    {
        $detailpenjualan = PenjualanDetail::join('penjualan', 'penjualan.id', '=', 'penjualan_detail.id_penjualan')
            ->join('produk_jual', 'produk_jual.id', '=', 'penjualan_detail.id_produk_jual')
            ->join('kategori_jual', 'kategori_jual.id', '=', 'produk_jual.id_kategori_jual')
            ->where('penjualan_detail.id', '=', $id)
            ->get([
                'penjualan_detail.id', 'produk_jual.nama_produk_jual', 'penjualan_detail.qty',
                'penjualan_detail.id_produk_jual', 'kategori_jual.kategori_jual',
            ]);

        // $idpenjualan = $idpenjualan;

        return view(
            'pages.penjualan.detail_penjualan.edit',
            [
                'detailpenjualan' => $detailpenjualan,
                'idpenjualan' => $idpenjualan,
            ]
        );
    }

    public function update_penjualan(Request $request, $id)
    {
        $request->validate([
            'id_customer' => 'required',
            'id_salesman' => 'required',
        ]);

        $penjualan = Penjualan::find($id);

        if (($penjualan->id_customer == $request->id_customer) && ($penjualan->id_salesman == $request->id_salesman)) {
            return redirect()->back()->with('failed', 'Data customer dan salesman sama dengan sebelumnya');
        }

        $penjualan->id_customer = $request->id_customer;
        $penjualan->id_salesman = $request->id_salesman;
        $penjualan->update();

        return redirect()->back()->with('success', 'Data penjualan berhasil diperbaharui');
    }

    public function update_detail_penjualan(Request $request, $id)
    {
        // dd($request);
        $request->validate([
            'qty' => 'required|numeric',
        ]);

        $produkjual = ProdukJual::find($request->id_produk_jual);

        $detailpenjualan = PenjualanDetail::find($id);

        $penjualan = Penjualan::find($request->id_penjualan);

        $oldQty = $detailpenjualan->qty;
        $newQty = $request->qty;
        $selisihQty = $oldQty - $newQty;
        $diskon = $penjualan->diskon;
        $hargaproduk = $produkjual->harga_jual;

        $subtotallama = $hargaproduk * $oldQty;
        $subtotalbaru = $hargaproduk * $newQty;
        $selisihSubtotal = $selisihQty * $hargaproduk;

        $proses = $subtotallama - $selisihSubtotal;
        $piutangHasil = $proses - (($proses * $diskon) / 100);

        // dd($piutangHasil);

        $stok = $produkjual->stok + ($oldQty - $newQty);

        if ($stok < 0) {
            return redirect()->back()->with('failed', 'Stok barang tidak mencukupi');
        }

        if ($penjualan->keterangan_penjualan == 'Belum Lunas') {
            $caripiutang = Piutang::where('id_penjualan', '=', $penjualan->id)->get();

            foreach ($caripiutang as $datapiutang) {
                $idpiutang = $datapiutang->id;
                $jumlahpiutang = $datapiutang->bayar;
            }

            $piutang = Piutang::find($idpiutang);
            $piutang->bayar = $piutangHasil;
            $piutang->update();

            $detailpenjualan->qty = $request->qty;
            $detailpenjualan->total = $produkjual->harga_jual * $request->qty;
            $detailpenjualan->update();

            $produkjual->stok = $stok;
            $produkjual->update();

            $penjualan->total_item = PenjualanDetail::where('id_penjualan', '=', $request->id_penjualan)->count();

            $subtotal = PenjualanDetail::where('id_penjualan', '=', $request->id_penjualan)->sum('total');

            $discountedTotal = $subtotal - (($subtotal * $penjualan->diskon / 100));

            $penjualan->subtotal = $discountedTotal;
            if ($penjualan->subtotal == 0) {
                $penjualan->keterangan_penjualan = 'Dibatalkan';
            }
            $penjualan->update();

            return redirect()->back()->with('success', 'Data detail penjualan berhasil ditambahkan');
        }

        $detailpenjualan->qty = $request->qty;
        $detailpenjualan->total = $produkjual->harga_jual * $request->qty;
        $detailpenjualan->update();

        $produkjual->stok = $stok;
        $produkjual->update();

        $penjualan->total_item = PenjualanDetail::where('id_penjualan', '=', $request->id_penjualan)->count();

        $subtotal = PenjualanDetail::where('id_penjualan', '=', $request->id_penjualan)->sum('total');

        $discountedTotal = $subtotal - (($subtotal * $penjualan->diskon / 100));

        $penjualan->subtotal = $discountedTotal;
        $penjualan->update();

        return redirect()->back()->with('success', 'Data detail penjualan berhasil diperbaharui');
    }

    public function bayar_piutang(Request $request, $id, $idpenjualan)
    {
        $request->validate([
            'jumlah_bayar' => 'required|numeric',
        ]);

        $piutang = Piutang::find($id);
        $pelunasan = $piutang->bayar - $request->jumlah_bayar;

        if ($pelunasan < 0) {
            return redirect()->back()->with('failed', 'Jumlah tidak valid atau tidak bisa minus');
        }

        $piutang->bayar = $pelunasan;
        $piutang->update();

        $penjualan = Penjualan::find($idpenjualan);
        $penjualan->tunai = $penjualan->tunai + $request->jumlah_bayar;

        if ($penjualan->tunai == $penjualan->subtotal) {
            $penjualan->keterangan_penjualan = 'Lunas';
        }

        $penjualan->update();

        return redirect()->back()->with('success', 'Pembayaran piutang berhasil diupdate');
    }

    public function retur_penjualan(Request $request, $idpenjualandetail)
    {
        $request->validate([
            'jumlah_retur' => 'required|numeric',
        ]);

        $penjualandetail = PenjualanDetail::find($idpenjualandetail);

        if (($penjualandetail->qty - $request->jumlah_retur) < 0) {
            return redirect()->back()->with('failed', 'Jumlah retur melebihi jumlah penjualan produk');
        }

        $penjualan = Penjualan::find($penjualandetail->id_penjualan);
        $produkjual = ProdukJual::find($penjualandetail->id_produk_jual);

        $subtotalretur = ($produkjual->harga_jual * $request->jumlah_retur) * ($penjualan->diskon / 100);

        $returpenjualan = new ReturPenjualan;
        $returpenjualan->id_penjualan_detail = $penjualandetail->id;
        $returpenjualan->qty = $request->jumlah_retur;
        $returpenjualan->subtotal = $subtotalretur;
        $returpenjualan->save();

        $penjualandetail->qty = $penjualandetail->qty - $request->jumlah_retur;
        $penjualandetail->total = $penjualandetail->qty * $produkjual->harga_jual;
        $penjualandetail->update();

        $produkjual->stok = $produkjual->stok + $request->jumlah_retur;
        $produkjual->update();

        $subtotal = PenjualanDetail::where('id_penjualan', '=', $penjualan->id)->sum('total');
        $discountedTotal = $subtotal - (($subtotal * $penjualan->diskon) / 100);
        $penjualan->subtotal = $discountedTotal;

        // dd($subtotal);

        if ($penjualan->keterangan_penjualan == 'Belum Lunas') {
            $caripiutang = Piutang::where('id_penjualan', '=', $penjualan->id)->get();

            foreach ($caripiutang as $datapiutang) {
                $idpiutang = $datapiutang->id;
                $jumlahpiutang = $datapiutang->bayar;
            }

            $piutang = Piutang::find($idpiutang);
            $piutang->id_retur_penjualan = $returpenjualan->id;
            $piutang->bayar = $subtotal - (($subtotal * $penjualan->diskon) / 100);
            $piutang->update();

            if ($penjualan->subtotal == 0) {
                $penjualan->keterangan_penjualan = 'Dibatalkan';
            }

            $penjualan->update();

            return redirect()->back()->with('success', 'Retur penjualan berhasil ditambahkan');
        }

        // $penjualan->subtotal = $discountedTotal;
        $penjualan->tunai = $discountedTotal;
        if ($penjualan->subtotal == 0) {
            $penjualan->keterangan_penjualan = 'Dibatalkan';
        }
        $penjualan->update();

        return redirect()->back()->with('success', 'Retur penjualan berhasil ditambahkan');
    }
}
