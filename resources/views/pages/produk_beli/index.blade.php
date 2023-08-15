@extends('layouts.app')
@section('content') 
@php 
// Define dynamic data 
$pageTitle = "Produk Beli"; 
$breadcrumbs = [ 
    ['label' => 'Home', 'url' => '#'], 
    ]; 
    $activePage = "Produk Beli"; 
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
    <div class="row">
      <div class="col-xl-12 col-lg-6" style="padding-bottom: 20px">
        <div class="d-flex justify-content-end">
          <a href="{{ route('kategori-beli.create') }}" class="btn btn-primary">Buat Kategori Beli<i class="fas fa-book-open ml-2"></i></a>
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
                <tr class="text-center">
                  <th scope="col">No</th>
                  <th scope="col">Kategori Beli</th>
                  <th scope="col">Action</th>
                </tr>
              </thead>
              <tbody>
                {{-- For loop here --}}
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
          <a href="{{ route('produk-beli.create') }}" class="btn btn-primary">Buat Produk Beli<i class="fas fa-book-open ml-2"></i></a>
        </div>
      </div>
    <div class="col">
      <div class="card shadow">
        <div class="card-header border-0">
          <div class="row align-items-center">
            <div class="col-10">
              <h3 class="mb-0">Produk Beli</h3>
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
          <table class="table align-items-center table-flush text-center">
            <thead class="thead-light">
              <tr>
                <th scope="col">No</th>
                <th scope="col">Kategori Produk Beli</th>
                <th scope="col">Nama Produk</th>
                <th scope="col">Kode Produk</th>
                <th scope="col">Harga Beli</th>
                <th scope="col">Stok</th>
                <th scope="col">Action</th>
              </tr>
            </thead>
            <tbody>
              {{-- For loop here --}}
              @php $no = 1 @endphp
              @forelse($produkbeli as $dataprodukbeli)
                <tr>
                  <td>{{ $no++ }}</td>
                  <td>{{ $dataprodukbeli->kategori_beli }}</td>
                  <td>{{ $dataprodukbeli->nama_produk_beli }}</td>
                  <td>{{ $dataprodukbeli->kode_produk_beli }}</td>
                  <td>{{ $dataprodukbeli->harga_beli }}</td>
                  <td>{{ $dataprodukbeli->stok }}</td>
                  <td class="text-center">
                    <div class="btn-group" role="group">
                      <a href="{{ route('produk-beli.edit', $dataprodukbeli->id) }}" class="btn btn-sm btn-outline-primary" onclick="editEntry()">
                        <i class="ni ni-ruler-pencil mr-2"></i> Edit </button>
                      </a>
                      <a href="{{ route('produk-beli.delete', $dataprodukbeli->id) }}" class="btn btn-sm btn-outline-danger" onclick="return confirm('Hapus data produk beli ini?')">
                        <i class="ni ni-fat-remove mr-2"></i> Delete </button>
                      </a>
                    </div>
                  </td>
                </tr>
              @empty
                <tr>
                  <td colspan="7" class="text-center">Tidak ada Data</td>
                </tr>
              @endforelse
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
@endsection 
@push('js') 
<script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.min.js"></script>
<script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.extension.js"></script> 
@endpush