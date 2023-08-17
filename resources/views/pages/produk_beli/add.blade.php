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
            <div class="card shadow">
                <div class="card-header border-0">
                    <div class="text-muted text-center mt-2 mb-3" style="font-weight: bold">Buat Produk Beli</div>
                </div>
                <div class="card-body">
                    <!-- Journal Entry Form -->
                    <form action="{{ route('produk-beli.store') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="kategori_beli">Kategori Beli <span class="text-danger">*</span></label>
                                    <select class="form-control" id="kategori_beli" name="kategori_beli" required>
                                        <option value="" selected disabled>Pilih Kategori Beli</option>
                                        @foreach($kategoribeli as $id => $value)
                                            <option value="{{ $id }}">{{ $value }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="nama_produk_beli">Nama Produk Beli <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="nama_produk_beli" name="nama_produk_beli" required>
                                </div>
                                <div class="form-group">
                                    <label for="kode_produk_beli">Kode Produk Beli <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="kode_produk_beli" name="kode_produk_beli" required>
                                </div>
                                <div class="form-group">
                                    <label for="harga_beli">Harga Beli <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="harga_beli" name="harga_beli" placeholder="Rp." required>
                                </div>
                                <div class="form-group">
                                    <label for="stok">Stok <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="stok" name="stok" placeholder="0" required>
                                </div>
                            </div>
                        </div>

                        <!-- Form Footer -->
                        <div class="text-center mt-4">
                            <button type="submit" class="btn btn-primary">Save</button>
                            <a href="{{ route('produk-beli.store') }}" class="btn btn-secondary">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Add the necessary JavaScript to handle adding rows to the table -->
@push('js')
    <script>
        // Format tanggal field in "month day, year" format (MDY)
        const tanggalInput = document.getElementById('tanggal');
        tanggalInput.addEventListener('change', function () {
            const date = new Date(this.value);
            const options = { month: 'short', day: 'numeric', year: 'numeric' };
            const formattedDate = date.toLocaleDateString('en-US', options);
            this.value = formattedDate;
        });
    </script>
@endpush
@endsection
