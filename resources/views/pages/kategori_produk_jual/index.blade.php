@extends('layouts.app')
@section('content') 
@php 
// Define dynamic data 
$pageTitle = "Kategori Produk Jual"; 
$breadcrumbs = [ 
    ['label' => 'Home', 'url' => '#'], 
    ]; 
    $activePage = "Kategori Produk Jual"; 
@endphp 
@include('layouts.headers.cards', compact('pageTitle', 'breadcrumbs', 'activePage')) 
<br>
<div class="container-fluid mt--7">
  <div class="header-body">
    @if ($message = Session::get('success'))
          <div class="alert alert-success">
            <p>{{ $message }}</p>
          </div>
    @endif
    <!-- Card stats -->
    <div class="row" style="padding-top: 20px">
      <div class="col-xl-12 col-lg-6" style="padding-bottom: 20px">
        <div class="d-flex justify-content-end">
          <a href="{{ route('kategori-jual.create') }}" class="btn btn-primary">Buat Kategori Jual</a>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col">
        <div class="card shadow">
          <div class="card-header border-0">
            <div class="row align-items-center">
              <div class="col-10">
                <h3 class="mb-0">Kategori Produk Jual</h3>
              </div>
            </div>
          </div>
          <div class="table-responsive">
            <table class="table align-items-center table-flush">
              <thead class="thead-light">
                <tr class="text-center">
                  <th scope="col">No</th>
                  <th scope="col">Kategori Jual</th>
                  <th scope="col">Action</th>
                </tr>
              </thead>
              <tbody>
                {{-- For loop here --}}
                @php $no = 1; @endphp
                @forelse($kategorijual as $datakategorijual)
                  <tr class="text-center">
                    <td>{{ $no++ }}</td>
                    <td>{{ $datakategorijual->kategori_jual }}</td>
                    <td class="text-center">
                      <div class="btn-group" role="group">
                        <a href="{{ route('kategori-jual.edit', $datakategorijual->id) }}" class="btn btn-sm btn-outline-primary" onclick="editEntry()">
                          <i class="ni ni-ruler-pencil mr-2"></i> Edit </button>
                        </a>
                        <a href="{{ route('kategori-jual.delete', $datakategorijual->id) }}" class="btn btn-sm btn-outline-danger" onclick="return confirm('Hapus data kategori produk jual ini?');">
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