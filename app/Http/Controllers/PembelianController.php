<?php

namespace App\Http\Controllers;

use App\Models\Pembelian;
use App\Models\PembelianDetail;
use App\Models\ProdukBeli;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Carbon\Carbon;
use PDF;

class PembelianController extends Controller
{
    public function generate_pdf(Request $request)
    {
        $startMonth = $request->input('bulan_awal');
        $endMonth = $request->input('bulan_akhir');

        $startOfMonth = Carbon::parse($startMonth)->startOfMonth();
        $endOfMonth = Carbon::parse($endMonth)->endOfMonth();

        $pembelian = Pembelian::join('supplier', 'supplier.id', '=', 'pembelian.id_supplier')
            ->whereBetween('pembelian.created_at', [$startOfMonth, $endOfMonth])
            ->get([
                'pembelian.id', 'pembelian.total_item', 'pembelian.subtotal', 'pembelian.diskon',
                'pembelian.bayar', 'pembelian.created_at', 'supplier.nama_supplier',
            ]);

        $pdf = PDF::loadView('pages.pembelian.pdf', compact('pembelian', 'startMonth', 'endMonth'));

        return $pdf->download('pembelian_report.pdf');
    }

    public function index()
    {
        $pembelian = Pembelian::join('supplier', 'supplier.id', '=', 'pembelian.id_supplier')
            ->get([
                'pembelian.id', 'pembelian.total_item', 'pembelian.subtotal', 'pembelian.diskon',
                'pembelian.bayar', 'pembelian.created_at', 'supplier.nama_supplier',
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

        $pembelian->subtotal = $pembeliandetail->total;
        $pembelian->total_item = PembelianDetail::where('pembelian_detail.id_pembelian', '=', $pembelian->id)->count();
        $pembelian->bayar = $pembeliandetail->total - (($pembeliandetail->total * $request->diskon) / 100);
        $pembelian->save();

        return redirect('pembelian')->with('success', 'Pembelian berhasil ditambahkan');
    }

    public function detail($id)
    {
        $pembelian = Pembelian::join('supplier', 'supplier.id', '=', 'pembelian.id_supplier')
            ->get([
                'pembelian.id', 'pembelian.total_item', 'pembelian.subtotal', 'pembelian.diskon',
                'pembelian.bayar', 'pembelian.created_at', 'supplier.nama_supplier',
            ]);

        $detailpembelian = PembelianDetail::join('pembelian', 'pembelian.id', '=', 'pembelian_detail.id_pembelian')
            ->join('produk_beli', 'produk_beli.id', '=', 'pembelian_detail.id_produk_beli')
            ->join('kategori_beli', 'kategori_beli.id', '=', 'produk_beli.id_kategori_beli')
            ->get([
                'pembelian_detail.id', 'produk_beli.nama_produk_beli', 'pembelian_detail.qty',
                'pembelian_detail.total', 'kategori_beli.kategori_beli'
            ]);

        return view('pages.pembelian.detail', [
            'pembelian' => $pembelian,
            'detailpembelian' => $detailpembelian,
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

    public function show($id)
    {
    }

    public function edit($id)
    {
    }

    public function update(Request $request, $id)
    {
    }

    public function delete($id)
    {
    }
}
