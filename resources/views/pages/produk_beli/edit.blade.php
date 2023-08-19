@extends('layouts.app') 

@section('content') 
@php 
    $pageTitle = "Buat Produk Beli"; 
    $breadcrumbs = [ 
        ['label' => 'Produk Beli', 'url' => '#'], 
        // ['label' => 'Add', 'url' => '#'], 
    ]; 
    $activePage = "Add"; 
@endphp 

@include('layouts.headers.cards', compact('pageTitle', 'breadcrumbs', 'activePage'))

<br>

<div class="container-fluid mt--7">
    <div class="row" style="padding-top: 88px">
        <div class="col">
            @if ($errors->any())
                <div class="alert alert-danger" id="alert-message">
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div><br>
            @endif
            <div class="card shadow">
                <div class="card-header border-0">
                    <div class="text-muted text-center mt-2 mb-3" style="font-weight: bold">Edit Produk Beli</div>
                </div>
                <div class="card-body">
                    <!-- Journal Entry Form -->
                    @foreach($produkbeli as $dataprodukbeli)
                        <form action="{{ route('produk-beli.update', $dataprodukbeli->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="id_kategori_beli">Kategori Beli <span class="text-danger">*</span></label>
                                        <select class="form-control" id="id_kategori_beli" name="id_kategori_beli" required>
                                            <option value="" disabled>Pilih Kategori Beli</option>
                                            @foreach($kategoribeli as $id => $value)
                                                <option value="{{ $id }}" @if($dataprodukbeli->id_kategori_beli == $id) selected @endif>{{ $value }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="nama_produk_beli">Nama Produk Beli <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="nama_produk_beli" name="nama_produk_beli" value="{{ $dataprodukbeli->nama_produk_beli }}" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="kode_produk_beli">Kode Produk Beli <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="kode_produk_beli" name="kode_produk_beli" value="{{ $dataprodukbeli->kode_produk_beli }}" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="harga_beli">Harga Beli <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="harga_beli" name="harga_beli" value="{{ $dataprodukbeli->harga_beli }}" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="stok">Stok <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="stok" name="stok" value="{{ $dataprodukbeli->stok }}" required>
                                    </div>
                                </div>
                            </div>

                            <!-- Form Footer -->
                            <div class="text-center mt-4">
                                <button type="submit" class="btn btn-primary">Save</button>
                                <a href="{{ route('produk-beli') }}" class="btn btn-secondary">Cancel</a>
                            </div>
                        </form>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Add the necessary JavaScript to handle adding rows to the table -->
@endsection
@push('js')
<script>
    document.addEventListener("DOMContentLoaded", function() {
        var alertMessage = document.getElementById("alert-message");

        if (alertMessage) {
            setTimeout(function() {
                alertMessage.remove();
            }, 5000);
        }
    });
</script>
@endpush
