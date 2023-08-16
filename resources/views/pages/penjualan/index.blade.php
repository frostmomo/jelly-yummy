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
      <a href="{{route('penjualan.create')}}" class="btn btn-primary">Tambah Penjualan</a>
    </div>
  </div>
  <div class="row">
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
              <!-- Replace with dynamic data using a loop -->
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
                      <button type="button" class="btn btn-sm btn-outline-primary" onclick="detailEntry()">
                        <i class="fas fa-info-circle mr-2"></i>
                        <!-- Bootstrap icon for detail --> Detail </button>
                      <button type="button" class="btn btn-sm btn-outline-primary" onclick="editEntry()">
                        <i class="ni ni-ruler-pencil mr-2"></i> Edit </button>
                      <button type="button" class="btn btn-sm btn-outline-danger" onclick="deleteEntry()">
                        <i class="ni ni-fat-remove mr-2"></i> Delete </button>
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
              <li class="page-item disabled">
                <a class="page-link" href="#" tabindex="-1">
                  <i class="fas fa-angle-left"></i>
                  <span class="sr-only">Previous</span>
                </a>
              </li>
              <li class="page-item active">
                <a class="page-link" href="#">1</a>
              </li>
              <li class="page-item">
                <a class="page-link" href="#">2 <span class="sr-only">(current)</span>
                </a>
              </li>
              <li class="page-item">
                <a class="page-link" href="#">3</a>
              </li>
              <li class="page-item">
                <a class="page-link" href="#">
                  <i class="fas fa-angle-right"></i>
                  <span class="sr-only">Next</span>
                </a>
              </li>
            </ul>
          </nav>
        </div>
      </div>
    </div>
  </div>
  <!-- Footer -->
</div> 
@endsection 
@push('js') 
<script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.min.js"></script>
<script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.extension.js"></script> 
@endpush