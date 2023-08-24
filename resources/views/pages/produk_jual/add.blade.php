@extends('layouts.app') 

@section('content') 
@php 
    $pageTitle = "Buat Produk Jual"; 
    $breadcrumbs = [ 
        ['label' => 'Produk Jual', 'url' => '#'], 
        // ['label' => 'Add', 'url' => '#'], 
    ]; 
    $activePage = "Add"; 
@endphp 

@include('layouts.headers.cards', compact('pageTitle', 'breadcrumbs', 'activePage'))

<br>

<div class="container-fluid mt--7">
    @if ($message = Session::get('success'))
          <div class="alert alert-success" id="success-message">
            <p>{{ $message }}</p>
          </div>
    @endif
    @if ($message = Session::get('failed'))
          <div class="alert alert-danger" id="failed-message">
            <p>{{ $message }}</p>
          </div>
    @endif
    @if ($errors->any())
        <div class="alert alert-danger" id="alert-message">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div><br>
    @endif
    <div class="row" style="padding-top: 88px">
        <div class="col">
            <div class="card shadow">
                <div class="card-header border-0">
                    <div class="text-muted text-center mt-2 mb-3" style="font-weight: bold">Buat Produk Jual</div>
                </div>
                <div class="card-body">
                    <form action="{{ route('produk-jual.store') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="kategori_jual">Kategori Jual <span class="text-danger">*</span></label>
                                    <select class="form-control" id="kategori_jual" name="kategori_jual" required>
                                        <option value="" selected disabled>Pilih Kategori Jual</option>
                                        @foreach($kategorijual as $id => $value)
                                            <option value="{{ $id }}">{{ $value }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="nama_produk_jual">Nama Produk Jual <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="nama_produk_jual" name="nama_produk_jual" required>
                                </div>
                                <div class="form-group">
                                    <label for="kode_produk_jual">Kode Produk Jual <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="kode_produk_jual" name="kode_produk_jual" required>
                                </div>
                                <div class="form-group">
                                    <label for="harga_produksi">Harga Produksi <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="harga_produksi" name="harga_produksi" placeholder="Rp." required>
                                </div>
                                <div class="form-group">
                                    <label for="harga_jual">Harga Jual <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="harga_jual" name="harga_jual" placeholder="Rp." required>
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
                            <a href="{{ route('produk-jual') }}" class="btn btn-secondary">Cancel</a>
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
