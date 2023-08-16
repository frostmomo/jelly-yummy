@extends('layouts.app')

@section('content')
@php
    $pageTitle = "Edit Detail Penjualan";
    $breadcrumbs = [
        ['label' => 'Penjualan', 'url' => '#'],
        ['label' => 'Detail Penjualan', 'url' => '#'],
    ];
    $activePage = "Edit";
@endphp

@include('layouts.headers.cards', compact('pageTitle', 'breadcrumbs', 'activePage'))

<br>

<div class="container-fluid mt--7">
    <div class="row" style="padding-top: 80px">
        <div class="col">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div><br>
            @endif

            @if ($message = Session::get('failed'))
                <div class="alert alert-danger">
                    <p>{{ $message }}</p>
                </div>
            @endif

            <div class="card shadow">
                <div class="card-header text-center">
                    Detail Penjualan
                </div>
                <div class="card-body">
                    @foreach($detailpenjualan as $data)
                        <form action="{{ route('penjualan.detail.update', $data->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="id_penjualan">ID Penjualan</label>
                                        <input type="text" class="form-control" id="id_penjualan" name="id_penjualan" value="{{ $idpenjualan }}" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label for="id_produk_jual">ID Produk Jual</label>
                                        <input type="text" class="form-control" id="id_produk_jual" name="id_produk_jual" value="{{ $data->id_produk_jual }}" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label for="nama_produk_jual">Nama Produk Jual:</label>
                                        <input type="text" class="form-control" id="nama_produk_jual" name="nama_produk_jual" value="{{ $data->nama_produk_jual }}" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label for="kategori_jual">Kategori Jual:</label>
                                        <input type="text" class="form-control" id="kategori_jual" name="kategori_jual" value="{{ $data->kategori_jual }}" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label for="qty">Jumlah:</label>
                                        <input type="number" class="form-control" id="qty" name="qty"  value="{{ $data->qty }}" required>
                                    </div>
                                </div>
                            </div>
                            <div class="text-center mt-4">
                                <button type="submit" class="btn btn-primary">Save</button>
                                <a href="{{ route('penjualan') }}" class="btn btn-secondary">Cancel</a>
                            </div>
                        </form>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
