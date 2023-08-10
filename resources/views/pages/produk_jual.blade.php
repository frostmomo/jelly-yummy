@extends('layouts.app')
@section('content') 
@php 
// Define dynamic data 
$pageTitle = "Produk Jual"; 
$breadcrumbs = [ 
    // ['label' => 'Home', 'url' => '#'], 
    // ['label' => 'Maps', 'url' => '#'], 
    ]; 
    $activePage = "Produk Jual"; 
@endphp 
@include('layouts.headers.cards', compact('pageTitle', 'breadcrumbs', 'activePage')) 
<br>
<div class="container-fluid mt--7">
  <div class="header-body">
    <!-- Card stats -->
    <div class="row">
      <div class="col-xl-12 col-lg-6" style="padding-bottom: 20px">
        <div class="d-flex justify-content-end">
          <a href="{{ route('jurnal.create') }}" class="btn btn-primary">Buat Kategori Jual<i class="fas fa-book-open ml-2"></i></a>
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
              <div class="col-2">
                <form action="{{ route('home') }}" method="GET" class="form-inline">
                  <div class="input-group input-group-rounded input-group-merge">
                    <input type="search" name="query" class="form-control form-control-rounded" placeholder="Search">
                    <div class="input-group-prepend">
                      <button type="submit" class="input-group-text">
                        <i class="fa fa-search"></i>
                      </button>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
          <div class="table-responsive">
            <table class="table align-items-center table-flush">
              <thead class="thead-light">
                <tr>
                  <th scope="col">No</th>
                  <th scope="col">ID</th>
                  <th scope="col">Kategori Jual</th>
                  <th scope="col">Action</th>
                </tr>
              </thead>
              <tbody>
                {{-- For loop here --}}
                <tr>
                  <td>1</td>
                  <td>STY-1</td>
                  <td>Styrofoam 1 Liter</td>
                  <td class="text-center">
                    <div class="btn-group" role="group">
                      <button type="button" class="btn btn-sm btn-outline-primary" onclick="editEntry()">
                        <i class="ni ni-ruler-pencil mr-2"></i> Edit </button>
                      <button type="button" class="btn btn-sm btn-outline-danger" onclick="deleteEntry()">
                        <i class="ni ni-fat-remove mr-2"></i> Delete </button>
                    </div>
                  </td>
                </tr>
                <tr>
                  <td>1</td>
                  <td>STY-1</td>
                  <td>Styrofoam 1 Liter</td>
                  <td class="text-center">
                    <div class="btn-group" role="group">
                      <button type="button" class="btn btn-sm btn-outline-primary" onclick="editEntry()">
                        <i class="ni ni-ruler-pencil mr-2"></i> Edit </button>
                      <button type="button" class="btn btn-sm btn-outline-danger" onclick="deleteEntry()">
                        <i class="ni ni-fat-remove mr-2"></i> Delete </button>
                    </div>
                  </td>
                </tr>
                <tr>
                  <td>1</td>
                  <td>STY-1</td>
                  <td>Styrofoam 1 Liter</td>
                  <td class="text-center">
                    <div class="btn-group" role="group">
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
  </div>
  <br>
  <div class="row">
    <div class="col-xl-12 col-lg-6" style="padding-bottom: 20px">
        <div class="d-flex justify-content-end">
          <a href="{{ route('jurnal.create') }}" class="btn btn-primary">Buat Produk Jual<i class="fas fa-book-open ml-2"></i></a>
        </div>
      </div>
    <div class="col">
      <div class="card shadow">
        <div class="card-header border-0">
          <div class="row align-items-center">
            <div class="col-10">
              <h3 class="mb-0">Produk Jual</h3>
            </div>
            <div class="col-2">
              <form action="{{ route('home') }}" method="GET" class="form-inline">
                <div class="input-group input-group-rounded input-group-merge">
                  <input type="search" name="query" class="form-control form-control-rounded" placeholder="Search">
                  <div class="input-group-prepend">
                    <button type="submit" class="input-group-text">
                      <i class="fa fa-search"></i>
                    </button>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
        <div class="table-responsive">
          <table class="table align-items-center table-flush">
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
              <tr>
                <td>B-01</td>
                <td>1 Liter</td>
                <td>Box Isi</td>
                <td>BI-001</td>
                <td>10000</td>
                <td>9000</td>
                <td>10 Biji</td>
                <td class="text-center">
                  <div class="btn-group" role="group">
                    <button type="button" class="btn btn-sm btn-outline-primary" onclick="editEntry()">
                      <i class="ni ni-ruler-pencil mr-2"></i> Edit </button>
                    <button type="button" class="btn btn-sm btn-outline-danger" onclick="deleteEntry()">
                      <i class="ni ni-fat-remove mr-2"></i> Delete </button>
                  </div>
                </td>
              </tr>
              <tr>
                <td>B-01</td>
                <td>1 Liter</td>
                <td>Box Kosong</td>
                <td>BK-001</td>
                <td>10000</td>
                <td>9000</td>
                <td>10 Biji</td>
                <td class="text-center">
                  <div class="btn-group" role="group">
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
</div> @endsection @push('js') <script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.min.js"></script>
<script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.extension.js"></script> @endpush