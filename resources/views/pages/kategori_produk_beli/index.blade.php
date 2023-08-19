@extends('layouts.app')
@section('content') 
@php 
// Define dynamic data 
$pageTitle = "Kategori Produk Beli"; 
$breadcrumbs = [ 
    ['label' => 'Home', 'url' => '#'], 
    ]; 
    $activePage = "Kategori Produk Beli"; 
@endphp 
@include('layouts.headers.cards') 
<div class="container-fluid mt--6">
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
          <a href="{{ route('kategori-beli.create') }}" class="btn btn-primary">Buat Kategori Beli</a>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col">
        <div class="card shadow">
          <div class="card-header border-0">
            <div class="row align-items-center">
              <div class="col-10">
                <h3 class="mb-0">Kategori Produk Beli</h3>
              </div>
            </div>
          </div>
          <div class="table-responsive">
            <table class="table align-items-center table-flush">
              <thead class="thead-light">
                <tr class="text-center">
                  <th scope="col">No</th>
                  <th scope="col">Kategori Beli</th>
                  <th scope="col">Action</th>
                </tr>
              </thead>
              <tbody>
                @php $no = 1; @endphp
                @forelse($kategoribeli as $datakategoribeli)
                  <tr class="text-center">
                    <td>{{ $no++ }}</td>
                    <td>{{ $datakategoribeli->kategori_beli }}</td>
                    <td class="text-center">
                      <div class="btn-group" role="group">
                        <a href="{{ route('kategori-beli.edit', $datakategoribeli->id) }}" class="btn btn-sm btn-outline-primary" onclick="editEntry()">
                          <i class="ni ni-ruler-pencil mr-2"></i> Edit </button>
                        </a>
                        <a href="{{ route('kategori-beli.delete', $datakategoribeli->id) }}" class="btn btn-sm btn-outline-danger" onclick="return confirm('Hapus data kategori produk beli ini?');">
                          <i class="ni ni-fat-remove mr-2"></i> Delete </button>
                        </a>
                      </div>
                    </td>
                  </tr>
                @empty
                  <tr>
                    <td colspan="3" class="text-center">Tidak ada data</td>
                  </tr>
                @endforelse
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
  <br>
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