@extends('layouts.app')

@section('content')
@php
    $pageTitle = "Edit Detail Pembelian";
    $breadcrumbs = [
        ['label' => 'Pembelian', 'url' => '#'],
        ['label' => 'Detail Pembelian', 'url' => '#'],
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
                    Detail Pembelian
                </div>
                <div class="card-body">
                    @foreach($detailpembelian as $data)
                        <form action="{{ route('pembelian.detail.update', $data->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="id_pembelian">ID Pembelian</label>
                                        <input type="text" class="form-control" id="id_pembelian" name="id_pembelian" value="{{ $idpembelian }}" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label for="id_produk_beli">ID Produk Beli</label>
                                        <input type="text" class="form-control" id="id_produk_beli" name="id_produk_beli" value="{{ $data->id_produk_beli }}" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label for="nama_produk_beli">Nama Produk Beli:</label>
                                        <input type="text" class="form-control" id="nama_produk_beli" name="nama_produk_beli" value="{{ $data->nama_produk_beli }}" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label for="kategori_beli">Kategori Beli:</label>
                                        <input type="text" class="form-control" id="kategori_beli" name="kategori_beli" value="{{ $data->kategori_beli }}" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label for="qty">Jumlah:</label>
                                        <input type="number" class="form-control" id="qty" name="qty"  value="{{ $data->qty }}" required>
                                    </div>
                                </div>
                            </div>
                            <div class="text-center mt-4">
                                <button type="submit" class="btn btn-primary">Save</button>
                                <a href="{{ route('pembelian.detail', $idpembelian) }}" class="btn btn-secondary">Cancel</a>
                            </div>
                        </form>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
