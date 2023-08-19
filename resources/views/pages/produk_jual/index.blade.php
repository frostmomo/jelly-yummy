@extends('layouts.app')
@section('content') 
@php 
// Define dynamic data 
$pageTitle = "Produk Jual"; 
$breadcrumbs = [ 
    ['label' => 'Home', 'url' => '#'], 
    ]; 
    $activePage = "Produk Jual"; 
@endphp 
@include('layouts.headers.cards', compact('pageTitle', 'breadcrumbs', 'activePage')) 
<br>
<div class="container-fluid mt--7">
  <div class="header-body">
    @if ($message = Session::get('success'))
          <div class="alert alert-success" id="success-message">
            <p>{{ $message }}</p>
          </div>
    @endif
    <!-- Card stats -->
  <div class="row" style="padding-top: 20px">
    <div class="col-xl-12 col-lg-6" style="padding-bottom: 20px">
        <div class="d-flex justify-content-end">
          <a href="{{ route('produk-jual.create') }}" class="btn btn-primary">Buat Produk Jual</a>
        </div>
      </div>
    <div class="col">
      <div class="card shadow">
        <div class="card-header border-0">
          <div class="row align-items-center">
            <div class="col-10">
              <h3 class="mb-0">Produk Jual</h3>
            </div>
          </div>
        </div>
        <div class="table-responsive">
          <table class="table align-items-center table-flush text-center">
            <thead class="thead-light">
              <tr>
                <th scope="col">No</th>
                <th scope="col">Kategori Produk Jual</th>
                <th scope="col">Nama Produk</th>
                <th scope="col">Kode Produk</th>
                <th scope="col">Harga Produksi</th>
                <th scope="col">Harga Jual</th>
                <th scope="col">Stok</th>
                <th scope="col">Action</th>
              </tr>
            </thead>
            <tbody>
              {{-- For loop here --}}
              @php $no = 1 @endphp
              @forelse($produkjual as $dataprodukjual)
                <tr>
                  <td>{{ $no++ }}</td>
                  <td>{{ $dataprodukjual->kategori_jual }}</td>
                  <td>{{ $dataprodukjual->nama_produk_jual }}</td>
                  <td>{{ $dataprodukjual->kode_produk_jual }}</td>
                  <td>{{ $dataprodukjual->harga_produksi }}</td>
                  <td>{{ $dataprodukjual->harga_jual }}</td>
                  <td>{{ $dataprodukjual->stok }}</td>
                  <td class="text-center">
                    <div class="btn-group" role="group">
                      <a href="{{ route('produk-jual.edit', $dataprodukjual->id) }}" class="btn btn-sm btn-outline-primary" onclick="editEntry()">
                        <i class="ni ni-ruler-pencil mr-2"></i> Edit </button>
                      </a>
                      <a href="{{ route('produk-jual.delete', $dataprodukjual->id) }}" class="btn btn-sm btn-outline-danger" onclick="return confirm('Hapus data produk jual ini?');">
                        <i class="ni ni-fat-remove mr-2"></i> Delete </button>
                      </a>
                    </div>
                  </td>
                </tr>
              @empty
                <tr>
                  <td colspan="8" class="text-center">Tidak ada Data</td>
                </tr>
              @endforelse
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection 
@push('js') 
<script>
  document.addEventListener("DOMContentLoaded", function() {
      var successMessage = document.getElementById("success-message");

      if (successMessage) {
          setTimeout(function() {
              successMessage.remove();
          }, 5000);
      }
  });
</script>
@endpush