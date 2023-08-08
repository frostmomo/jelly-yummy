@extends('layouts.app') 
@section('content') 
@php // Define dynamic data 
$pageTitle = "Penjualan"; $breadcrumbs = []; $activePage = "Penjualan"; 
@endphp 
@include('layouts.headers.cards') 
<div class="container-fluid mt--6">
  <div class="row">
    <div class="col text-right mb-3">
      <a href="{{route('penjualan.create')}}" class="btn btn-primary">Add Item</a>
    </div>
  </div>
  <div class="row">
    <div class="col">
      <div class="card">
        <div class="card-header border-0">
          <h3 class="mb-0">Penjualan</h3>
        </div>
        <div class="table-responsive">
          <table class="table align-items-center table-flush">
            <thead class="thead-light">
              <tr>
                <th scope="col">ID User</th>
                <th scope="col">ID Customer</th>
                <th scope="col">ID Salesman</th>
                <th scope="col">Total Item</th>
                <th scope="col">Diskon</th>
                <th scope="col">Subtotal</th>
                <th scope="col">Action</th>
              </tr>
            </thead>
            <tbody class="list">
              <!-- Replace with dynamic data using a loop -->
              {{-- @foreach($salesData as $sale)
                            
							<tr>
								<td>{{ $sale->idUser }}</td>
              <td>{{ $sale->idCustomer }}</td>
              <td>{{ $sale->idSalesman }}</td>
              <td>{{ $sale->totalItem }}</td>
              <td>{{ $sale->diskon }}</td>
              <td>{{ $sale->subtotal }}</td>
              <td class="text-right">
                <div class="dropdown">
                  <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-ellipsis-v"></i>
                  </a>
                  <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                    <a class="dropdown-item" href="#">Edit</a>
                    <a class="dropdown-item" href="#">Delete</a>
                    <a class="dropdown-item" href="#">Detail</a>
                  </div>
                </div>
              </td>
              </tr> @endforeach --}}
              <!-- End loop -->
              <tr>
                <td>123321</td>
                <td>123321</td>
                <td>123321</td>
                <td>123321</td>
                <td>123321</td>
                <td>123321</td>
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
              <tr>
                <td>123321</td>
                <td>123321</td>
                <td>123321</td>
                <td>123321</td>
                <td>123321</td>
                <td>123321</td>
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
              <tr>
                <td>123321</td>
                <td>123321</td>
                <td>123321</td>
                <td>123321</td>
                <td>123321</td>
                <td>123321</td>
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
              <tr>
                <td>123321</td>
                <td>123321</td>
                <td>123321</td>
                <td>123321</td>
                <td>123321</td>
                <td>123321</td>
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
              <tr>
                <td>123321</td>
                <td>123321</td>
                <td>123321</td>
                <td>123321</td>
                <td>123321</td>
                <td>123321</td>
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