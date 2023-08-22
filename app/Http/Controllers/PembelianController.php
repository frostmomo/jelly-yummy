<?php

namespace App\Http\Controllers;

use PDF;
use Carbon\Carbon;
use App\Models\Akun;
use App\Models\Supplier;
use App\Models\Pembelian;
use App\Models\ProdukBeli;
use App\Models\Pengeluaran;
use Illuminate\Http\Request;
use App\Models\ReturPembelian;
use App\Models\PembelianDetail;
use App\Models\PengeluaranDetail;
use Illuminate\Support\Facades\Auth;

class PembelianController extends Controller
{
    public function generate_pdf(Request $request)
    {
        $startDay = $request->input('tanggal_awal');
        $endDay = $request->input('tanggal_akhir');

        $startOfDay = Carbon::parse($startDay)->startOfDay();
        $endOfDay = Carbon::parse($endDay)->endOfDay();

        $pembelian = Pembelian::join('supplier', 'supplier.id', '=', 'pembelian.id_supplier')
            ->whereBetween('pembelian.created_at', [$startOfDay, $endOfDay])
            ->get([
                'pembelian.id', 'pembelian.total_item', 'pembelian.subtotal', 'pembelian.diskon',
                'pembelian.bayar', 'pembelian.created_at', 'supplier.nama_supplier',
            ]);

        $pdf = PDF::loadView('pages.pembelian.pdf', compact('pembelian', 'startDay', 'endDay'));

        return $pdf->download('TirtaRahayuLaporanPembelian-' . date('d M Y', strtotime($startDay)) . ' - ' . date('d M Y', strtotime($endDay)) . '.pdf');
    }

    public function index()
    {
        $pembelian = Pembelian::join('supplier', 'supplier.id', '=', 'pembelian.id_supplier')
            ->join('users', 'users.id', '=', 'pembelian.id_user')
            ->orderByDesc('pembelian.created_at')
            ->get([
                'pembelian.id', 'pembelian.total_item', 'pembelian.subtotal', 'pembelian.diskon',
                'pembelian.bayar', 'pembelian.created_at', 'supplier.nama_supplier', 'users.name',
            ]);
        return view('pages.pembelian.index', [
            'pembelian' => $pembelian,
        ]);
    }

    public function create()
    {
        $supplier = Supplier::pluck('nama_supplier', 'id');
        $produkbeli = ProdukBeli::join('kategori_beli', 'kategori_beli.id', '=', 'produk_beli.id_kategori_beli')
            ->get([
                'produk_beli.id', 'produk_beli.nama_produk_beli', 'produk_beli.kode_produk_beli',
                'produk_beli.harga_beli', 'produk_beli.stok', 'kategori_beli.kategori_beli'
            ]);
        return view('pages.pembelian.add', [
            'supplier' => $supplier,
            'produkbeli' => $produkbeli,
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_supplier' => 'required',
            'produk_beli' => 'required',
            'qty' => 'required|numeric',
            'diskon' => 'numeric',
        ]);

        $pembelian = new Pembelian;
        $pembelian->id_user = Auth::user()->id;
        $pembelian->id_supplier = $request->id_supplier;
        $pembelian->diskon = $request->diskon;
        $pembelian->save();

        $produkbeli = ProdukBeli::find($request->produk_beli);

        $pembeliandetail = new PembelianDetail;
        $pembeliandetail->id_pembelian = $pembelian->id;
        $pembeliandetail->id_produk_beli = $produkbeli->id;
        $pembeliandetail->qty = $request->qty;
        $pembeliandetail->total = $request->qty * $produkbeli->harga_beli;
        $pembeliandetail->save();

        $produkbeli->stok = $produkbeli->stok + $request->qty;
        $produkbeli->update();

        $subtotal = PembelianDetail::where('pembelian_detail.id_pembelian', '=', $pembelian->id)->sum('total');

        $pembelian->subtotal = $subtotal - (($subtotal * $request->diskon) / 100);
        $pembelian->total_item = PembelianDetail::where('pembelian_detail.id_pembelian', '=', $pembelian->id)->count();
        $pembelian->bayar = 0;
        $pembelian->save();

        return redirect('pembelian')->with('success', 'Pembelian berhasil ditambahkan');
    }

    public function detail($id)
    {
        $pembelian = Pembelian::join('supplier', 'supplier.id', '=', 'pembelian.id_supplier')
            ->join('users', 'users.id', '=', 'pembelian.id_user')
            ->where('pembelian.id', '=', $id)
            ->get([
                'pembelian.id', 'pembelian.total_item', 'pembelian.subtotal', 'pembelian.diskon',
                'pembelian.bayar', 'pembelian.created_at', 'supplier.nama_supplier', 'users.name',
                'pembelian.id_supplier',
            ]);

        $detailpembelian = PembelianDetail::join('pembelian', 'pembelian.id', '=', 'pembelian_detail.id_pembelian')
            ->join('produk_beli', 'produk_beli.id', '=', 'pembelian_detail.id_produk_beli')
            ->join('kategori_beli', 'kategori_beli.id', '=', 'produk_beli.id_kategori_beli')
            ->where('pembelian.id', '=', $id)
            ->get([
                'pembelian_detail.id', 'produk_beli.nama_produk_beli', 'pembelian_detail.qty',
                'pembelian_detail.total', 'pembelian_detail.id_produk_beli', 'kategori_beli.kategori_beli',
            ]);

        $supplier = Supplier::pluck('nama_supplier', 'id');

        $produkbeli = ProdukBeli::pluck('nama_produk_beli', 'id');

        $returpembelian = ReturPembelian::join('pembelian_detail', 'pembelian_detail.id', '=', 'retur_pembelian.id_pembelian_detail')
            ->join('produk_beli', 'produk_beli.id', '=', 'pembelian_detail.id_produk_beli')
            ->join('kategori_beli', 'kategori_beli.id', '=', 'produk_beli.id_kategori_beli')
            ->join('pembelian', 'pembelian.id', '=', 'pembelian_detail.id_pembelian')
            ->where('pembelian.id', '=', $id)
            ->get([
                'retur_pembelian.id', 'retur_pembelian.qty', 'retur_pembelian.subtotal',
                'produk_beli.nama_produk_beli', 'kategori_beli.kategori_beli',
            ]);

        $akun = Akun::pluck('nama_akun', 'id');

        return view('pages.pembelian.detail', [
            'pembelian' => $pembelian,
            'detailpembelian' => $detailpembelian,
            'supplier' => $supplier,
            'produkbeli' => $produkbeli,
            'returpembelian' => $returpembelian,
            'akun' => $akun,
        ]);
    }

    public function detail_pembelian($id, $idpembelian)
    {
        $detailpembelian = PembelianDetail::join('pembelian', 'pembelian.id', '=', 'pembelian_detail.id_pembelian')
            ->join('produk_beli', 'produk_beli.id', '=', 'pembelian_detail.id_produk_beli')
            ->join('kategori_beli', 'kategori_beli.id', '=', 'produk_beli.id_kategori_beli')
            ->where('pembelian_detail.id', '=', $id)
            ->get([
                'pembelian_detail.id', 'produk_beli.nama_produk_beli', 'pembelian_detail.qty',
                'pembelian_detail.id_produk_beli', 'kategori_beli.kategori_beli'
            ]);

        return view(
            'pages.pembelian.detail_pembelian.edit',
            [
                'detailpembelian' => $detailpembelian,
                'idpembelian' => $idpembelian,
            ]
        );
    }

    public function update_pembelian(Request $request, $id)
    {
        $request->validate([
            'id_supplier' => 'required',
            'diskon' => 'required|numeric',
        ]);

        $pembelian = Pembelian::find($id);

        // if ($pembelian->id_supplier == $request->id_supplier) {
        //     return redirect()->back()->with('failed', 'Data supplier sama dengan sebelumnya');
        // }

        $subtotal = PembelianDetail::where('id_pembelian', '=', $id)->sum('total');

        $pembelian->id_supplier = $request->id_supplier;
        $pembelian->diskon = $request->diskon;
        $pembelian->subtotal = $subtotal - (($subtotal * $request->diskon) / 100);
        $pembelian->update();

        return redirect()->back()->with('success', 'Data pembelian berhasil diperbaharui');
    }

    public function update_detail_pembelian(Request $request, $id)
    {
        $request->validate([
            'qty' => 'required|numeric'
        ]);

        $produkbeli = ProdukBeli::find($request->id_produk_beli);
        $detailpembelian = PembelianDetail::find($id);

        $oldQty = $detailpembelian->qty;
        $newQty = $request->qty;
        $selisihQty = $oldQty - $newQty;

        $stok = $produkbeli->stok - $selisihQty;

        if ($stok < 0) {
            return redirect()->back()->with('failed', 'Stok barang tidak mencukupi');
        }

        $detailpembelian->qty = $request->qty;
        $detailpembelian->total = $produkbeli->harga_beli * $request->qty;
        $detailpembelian->update();

        $produkbeli->stok = $stok;
        $produkbeli->update();

        $pembelian = Pembelian::find($request->id_pembelian);
        $pembelian->total_item = PembelianDetail::where('id_pembelian', '=', $request->id_pembelian)->count();

        $subtotal = PembelianDetail::where('id_pembelian', '=', $request->id_pembelian)->sum('total');

        $discountedTotal = $subtotal - (($subtotal * $pembelian->diskon / 100));

        $pembelian->subtotal = $discountedTotal;
        $pembelian->update();

        return redirect()->back()->with('success', 'Data detail pembelian berhasil diperbaharui');
    }

    public function retur_pembelian(Request $request, $idpembeliandetail)
    {
        $request->validate([
            'jumlah_retur' => 'required|numeric',
        ]);

        $pembeliandetail = PembelianDetail::find($idpembeliandetail);

        if (($pembeliandetail->qty - $request->jumlah_retur) < 0) {
            return redirect()->back()->with('failed', 'Jumlah retur melebihi jumlah pembelian produk');
        }

        $pembelian = Pembelian::find($pembeliandetail->id_pembelian);
        $produkbeli = ProdukBeli::find($pembeliandetail->id_produk_beli);

        $subtotalretur = $produkbeli->harga_beli * $request->jumlah_retur;

        $returpembelian = new ReturPembelian;
        $returpembelian->id_pembelian_detail = $pembeliandetail->id;
        $returpembelian->qty = $request->jumlah_retur;
        $returpembelian->subtotal = $subtotalretur;
        $returpembelian->save();

        $pembeliandetail->qty = $pembeliandetail->qty - $request->jumlah_retur;
        $pembeliandetail->total = $pembeliandetail->qty * $produkbeli->harga_beli;
        $pembeliandetail->update();

        $produkbeli->stok = $produkbeli->stok - $request->jumlah_retur;
        $produkbeli->update();

        $subtotal = PembelianDetail::where('id_pembelian', '=', $pembelian->id)->sum('total');
        $discountedTotal = $subtotal - (($subtotal * $pembelian->diskon) / 100);

        $pembelian->subtotal = $discountedTotal;
        $pembelian->update();

        return redirect()->back()->with('success', 'Retur pembelian berhasil ditambahkan');
    }

    public function tambah_item_pembelian(Request $request, $id)
    {
        $request->validate([
            'qty' => 'required|numeric',
        ]);

        $pembelian = Pembelian::find($id);
        $produkbeli = ProdukBeli::find($request->id_produk);

        $pembeliandetail = new PembelianDetail;
        $pembeliandetail->id_pembelian = $pembelian->id;
        $pembeliandetail->id_produk_beli = $produkbeli->id;
        $pembeliandetail->qty = $request->qty;
        $pembeliandetail->total = $request->qty * $produkbeli->harga_beli;
        $pembeliandetail->save();

        $produkbeli->stok = $produkbeli->stok + $request->qty;
        $produkbeli->update();

        $subtotal = PembelianDetail::where('id_pembelian', '=', $id)->sum('total');

        $pembelian->total_item = PembelianDetail::where('id_pembelian', '=', $id)->count();
        $pembelian->subtotal = $subtotal - (($subtotal * $pembelian->diskon) / 100);
        $pembelian->update();

        return redirect()->back()->with('success', 'Item berhasil ditambahkan');
    }

    public function bayar_hutang(Request $request, $id)
    {
        $request->validate([
            'jumlah_bayar' => 'required|numeric',
            'akun' => 'required',
        ]);

        $pembelian = Pembelian::find($id);
        $totalbayar = $pembelian->bayar + $request->jumlah_bayar;

        if($request->jumlah_bayar > $pembelian->subtotal || $request->jumlah_bayar < 0 || $totalbayar > $pembelian->subtotal)
        {
            return redirect()->back()->with('failed', 'Jumlah bayar tidak valid atau melebihi hutang');
        }

        $pelunasan = $pembelian->subtotal - $request->jumlah_bayar;

        if ($pelunasan < 0) {
            return redirect()->back()->with('failed', 'Jumlah tidak valid atau tidak bisa minus');
        }

        
        $pembelian->bayar = $pembelian->bayar + $request->jumlah_bayar;
        $pembelian->update();

        $pengeluaran = new Pengeluaran;
        $pengeluaran->id_user = Auth::user()->id;
        $pengeluaran->id_supplier = $pembelian->id_supplier;
        $pengeluaran->uraian = 'Pengeluaran Kas';
        $pengeluaran->subtotal = $request->jumlah_bayar;
        $pengeluaran->save();

        $pengeluaranDetail = new PengeluaranDetail;
        $pengeluaranDetail->id_pengeluaran = $pengeluaran->id;
        $pengeluaranDetail->id_akun = $request->akun;
        $pengeluaranDetail->keterangan = 'Pembayaran Hutang Dagang';
        $pengeluaranDetail->total = $request->jumlah_bayar;
        $pengeluaranDetail->save();


        return redirect()->back()->with('success', 'Pembayaran hutang berhasil diupdate');
    }

    public function delete($id)
    {
        $pembeliandetail = PembelianDetail::where('id_pembelian', '=', $id)->get();

        foreach ($pembeliandetail as $datapembeliandetail) {
            $produkbeli = ProdukBeli::find($datapembeliandetail->id_produk_beli);
            $produkbeli->stok = $produkbeli->stok - $datapembeliandetail->qty;
            $produkbeli->update();
        }

        Pembelian::find($id)->delete();

        return redirect('pembelian')->with('success', 'Data pembelian berhasil dihapus');
    }
}
