@extends('layouts.app')

@section('content')
@php
    $pageTitle = "Detail Penjualan";
    $breadcrumbs = [
        ['label' => 'Penjualan', 'url' => route('penjualan')],
        // ['label' => 'Detail', 'url' => '#'],
    ];
    $activePage = "Detail";
@endphp

@include('layouts.headers.cards', compact('pageTitle', 'breadcrumbs', 'activePage'))

<br>

<div class="container-fluid mt--7">
    <div class="row" style="padding-top: 80px">
        <div class="col">
            <div class="card">
                <div class="card-header text-center">
                    Detail Penjualan
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label for="id_customer">Nama Customer:</label>
                        <input type="text" class="form-control" value="{{ $penjualan->Customer->nama_customer }}" readonly>
                    </div>
                    <div class="form-group">
                        <label for="id_salesman">Nama Salesman:</label>
                        <input type="text" class="form-control" value="{{ $penjualan->Salesman->nama_salesman }}" readonly>
                    </div>
                    <div class="form-group">
                        <label for="id_produk">Produk Jual:</label>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Nama Produk</th>
                                    <th>Harga</th>
                                    <th>Jumlah Item</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($penjualan->PenjualanDetail as $penjualanDetail)
                                <tr>
                                    <td>{{ $penjualanDetail->ProdukJual->nama_produk ?? 'N/A' }}</td>
                                    <td>{{ $penjualanDetail->ProdukJual->harga_jual ?? 0 }}</td>
                                    <td>{{ $penjualanDetail->qty ?? 0 }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="form-group">
                        <label for="diskon">Diskon %:</label>
                        <input type="text" class="form-control" value="{{ $penjualan->diskon }}%" readonly>
                    </div>
                    <div class="form-group">
                        <label for="tunai">Tunai:</label>
                        <input type="text" class="form-control" value="{{ $penjualan->tunai ? 'Ya' : 'Tidak' }}" readonly>
                    </div>
                    <div class="text-center mt-4">
                        <a href="{{ route('penjualan') }}" class="btn btn-secondary">Kembali</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
