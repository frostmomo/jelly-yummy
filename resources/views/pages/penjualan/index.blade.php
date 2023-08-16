@extends('layouts.app') 
@section('content') 
@php // Define dynamic data 
$pageTitle = "Penjualan"; 
$breadcrumbs = [
  ['label' => 'Home', 'url' => '#'],
]; 
$activePage = "Penjualan"; 
@endphp 
@include('layouts.headers.cards') 
<div class="container-fluid mt--6">
  <div class="row">
    <div class="col text-right mb-3">
      <ul>
        <a href="{{route('penjualan.create')}}" class="btn btn-primary">Cetak Laporan Penjualan</a>
        <a href="{{route('penjualan.create')}}" class="btn btn-primary">Tambah Penjualan</a>  
      </ul>
    </div>
  </div>
  <div class="row" style="padding-top: 20px">
    <div class="col">
      @if ($message = Session::get('success'))
          <div class="alert alert-success">
            <p>{{ $message }}</p>
          </div>
      @endif
      <div class="card">
        <div class="card-header border-0">
          <h3 class="mb-0">Penjualan</h3>
        </div>
        <div class="table-responsive">
          <table class="table align-items-center table-flush">
            <thead class="thead-light">
              <tr class="text-center">
                <th scope="col">Tanggal</th>
                <th scope="col">Dibuat oleh</th>
                <th scope="col">Customer</th>
                <th scope="col">Salesman</th>
                <th scope="col">Total Item</th>
                <th scope="col">Diskon</th>
                <th scope="col">Subtotal</th>
                <th scope="col">Action</th>
              </tr>
            </thead>
            <tbody class="list">
              @forelse($penjualan as $datapenjualan)
                <tr class="text-center">
                  <td>{{ $datapenjualan->created_at }}</td>
                  <td>{{ $datapenjualan->name }}</td>
                  <td>{{ $datapenjualan->nama_customer }}</td>
                  <td>{{ $datapenjualan->nama_salesman }}</td>
                  <td>{{ $datapenjualan->total_item }}</td>
                  <td>{{ $datapenjualan->diskon }}%</td>
                  <td>{{ $datapenjualan->subtotal }}</td>
                  <td class="text-center">
                    <div class="btn-group" role="group">
                      <a href="{{ route('penjualan.detail', $datapenjualan->id) }}" class="btn btn-sm btn-outline-primary" onclick="detailEntry()">
                        <i class="fas fa-info-circle mr-2"></i> Detail
                      </a>
                      <a href="" class="btn btn-sm btn-outline-primary" onclick="editEntry()">
                        <i class="ni ni-ruler-pencil mr-2"></i> Edit </button>
                      </a>
                      <a href="" class="btn btn-sm btn-outline-danger" onclick="return confirm('Hapus data kategori produk jual ini?');">
                        <i class="ni ni-fat-remove mr-2"></i> Delete </button>
                      </a>
                    </div>
                  </td>
                </tr>
              @empty
                <tr class="text-center">
                  <td colspan="7">
                    Tidak ada data
                  </td>
                </tr>
              @endforelse
              <!-- End loop -->
            </tbody>
          </table>
        </div>
        <div class="card-footer py-4">
          <nav aria-label="...">
            <ul class="pagination justify-content-end mb-0">
              {{ $penjualan->links() }}
          </ul>
          </nav>
        </div>
      </div>
    </div>
  </div>
  <!-- Footer -->
</div> 
@endsection