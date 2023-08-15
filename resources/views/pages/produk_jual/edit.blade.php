@extends('layouts.app') 

@section('content') 
@php 
    $pageTitle = "Edit Produk Jual"; 
    $breadcrumbs = [ 
        ['label' => 'Produk Jual', 'url' => '#'], 
        // ['label' => 'Add', 'url' => '#'], 
    ]; 
    $activePage = "Edit"; 
@endphp 

@include('layouts.headers.cards', compact('pageTitle', 'breadcrumbs', 'activePage'))

<br>

<div class="container-fluid mt--7">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div><br>
            @endif
            <div class="card shadow">
                <div class="card-header border-0">
                    <div class="text-muted text-center mt-2 mb-3" style="font-weight: bold">Edit Produk Jual</div>
                </div>
                <div class="card-body">
                    @foreach($produkjual as $dataprodukjual)
                        <form action="{{ route('produk-jual.update', $dataprodukjual->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="id_kategori_jual">Kategori Jual <span class="text-danger">*</span></label>
                                        <select class="form-control" id="id_kategori_jual" name="id_kategori_jual" required>
                                            <option value="" disabled>Pilih Kategori Jual</option>
                                            @foreach($kategorijual as $id => $value)
                                                <option value="{{ $id }}" @if($dataprodukjual->id_kategori_jual == $id) selected @endif>{{ $value }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="nama_produk_jual">Nama Produk Jual <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="nama_produk_jual" name="nama_produk_jual" value="{{ $dataprodukjual->nama_produk_jual }}" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="kode_produk_jual">Kode Produk Jual <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="kode_produk_jual" name="kode_produk_jual" maxlength="3" value="{{ $dataprodukjual->kode_produk_jual }}" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="harga_produksi">Harga Produksi <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="harga_produksi" name="harga_produksi" value="{{ $dataprodukjual->harga_produksi }}" placeholder="Rp." required>
                                    </div>
                                    <div class="form-group">
                                        <label for="harga_jual">Harga Jual <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="harga_jual" name="harga_jual" value="{{ $dataprodukjual->harga_jual }}" placeholder="Rp." required>
                                    </div>
                                    <div class="form-group">
                                        <label for="stok">Stok <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="stok" name="stok" value="{{ $dataprodukjual->stok }}" placeholder="0" required>
                                    </div>
                                </div>
                            </div>
                            <!-- Form Footer -->
                            <div class="text-center mt-4">
                                <button type="submit" class="btn btn-primary">Save</button>
                                <a href="{{ route('produk-jual') }}" class="btn btn-secondary">Cancel</a>
                            </div>
                        </form>
                    @endforeach
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
