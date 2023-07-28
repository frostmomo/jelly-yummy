@extends('layouts.app') 
@section('content') 
@php 
    $pageTitle = "Jurnal"; 
    $breadcrumbs = [ 
        // ['label' => 'Home', 'url' => '#'], 
        // ['label' => 'Maps', 'url' => '#'], 
    ]; 
        $activePage = "Jurnal"; 

    // Sample dynamic data (replace this with data from your controller)
    $totalPemasukan = 350897;
    $totalPengeluaran = 2356;
    $saldoKas = 924;

    // Sample arrow direction (replace this with the actual logic from your controller)
    $arrowDirectionPemasukan = 'up'; // or 'down'
    $arrowDirectionPengeluaran = 'down'; // or 'up'
    $arrowDirectionSaldoKas = 'down'; // or 'up'
@endphp 
@include('layouts.headers.cards', compact('pageTitle', 'breadcrumbs', 'activePage'))
<br>
<div class="container-fluid mt--7">
    <div class="header-body">
        <!-- Card stats -->
        <div class="row">
          <div class="col-xl-4 col-lg-6">
            <div class="card card-stats mb-4 mb-xl-0">
              <div class="card-body">
                <div class="row">
                  <div class="col">
                    <h5 class="card-title text-uppercase text-muted mb-0">Total Pemasukan</h5>
                    <span class="h2 font-weight-bold mb-0">{{ $totalPemasukan }}</span>
                  </div>
                  <div class="col-auto">
                    <div class="icon icon-shape bg-success text-white rounded-circle shadow">
                        <i class="fas fa-money-bill-wave"></i>
                    </div>
                  </div>
                </div>
                <p class="mt-3 mb-0 text-muted text-sm">
                  <span class="text-success mr-2">
                    <i class="fa fa-arrow-up"></i> 3.48% </span>
                  <span class="text-nowrap">Since last month</span>
                </p>
              </div>
            </div>
          </div>
          <div class="col-xl-4 col-lg-6">
            <div class="card card-stats mb-4 mb-xl-0">
              <div class="card-body">
                <div class="row">
                  <div class="col">
                    <h5 class="card-title text-uppercase text-muted mb-0">Total Pengeluaran</h5>
                    <span class="h2 font-weight-bold mb-0">{{ $totalPengeluaran }}</span>
                  </div>
                  <div class="col-auto">
                    <div class="icon icon-shape bg-danger text-white rounded-circle shadow">
                        <i class="fas fa-shopping-cart"></i>
                    </div>
                  </div>
                </div>
                <p class="mt-3 mb-0 text-muted text-sm">
                  <span class="text-danger mr-2">
                    <i class="fas fa-arrow-down"></i> 3.48% </span>
                  <span class="text-nowrap">Since last week</span>
                </p>
              </div>
            </div>
          </div>
          <div class="col-xl-4 col-lg-6">
            <div class="card card-stats mb-4 mb-xl-0">
              <div class="card-body">
                <div class="row">
                  <div class="col">
                    <h5 class="card-title text-uppercase text-muted mb-0">Saldo Kas</h5>
                    <span class="h2 font-weight-bold mb-0">{{ $saldoKas }}</span>
                  </div>
                  <div class="col-auto">
                    <div class="icon icon-shape bg-warning text-white rounded-circle shadow">
                        <i class="fas fa-money-bill"></i>
                    </div>
                  </div>
                </div>
                <p class="mt-3 mb-0 text-muted text-sm">
                  <span class="text-warning mr-2">
                    <i class="fas fa-arrow-down"></i> 1.10% </span>
                  <span class="text-nowrap">Since yesterday</span>
                </p>
              </div>
            </div>
          </div>
        </div>
      </div>
      <br>
      <div class="row">
        <div class="col">
          <div class="card shadow">
            <div class="card-header border-0">
              <div class="row align-items-center">
                <div class="col-8">
                  <h3 class="mb-0">Jurnal</h3>
                </div>
                <div class="col-4 text-right">
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
                    <th scope="col">Deskripsi</th>
                    <th scope="col">Jenis</th>
                    <th scope="col">Nominal</th>
                    <th scope="col">Tanggal</th>
                    <th scope="col">Detail</th>
                    <th scope="col">Action</th>
                  </tr>
                </thead>
                <tbody>
                    {{-- For loop here --}}
                  <tr>
                    <td>J-01</td>
                    <td>Dummy</td>
                    <td>Pengeluaran</td>
                    <td>1000</td>
                    <td>12/02/2020 11:00</td>
                    <td>Detailnya gatau gmn</td>
                    <td class="text-right">
                      <div class="dropdown">
                        <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                          <i class="fas fa-ellipsis-v"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                          <a class="dropdown-item" href="">Edit</a>
                        </div>
                      </div>
                    </td>
                  </tr>
                  <tr>
                    <td>J-01</td>
                    <td>Dummy</td>
                    <td>Pengeluaran</td>
                    <td>1000</td>
                    <td>12/02/2020 11:00</td>
                    <td>Detailnya gatau gmn</td>
                    <td class="text-right">
                      <div class="dropdown">
                        <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                          <i class="fas fa-ellipsis-v"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                          <a class="dropdown-item" href="">Edit</a>
                        </div>
                      </div>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
            <div class="card-footer py-4">
              <nav class="d-flex justify-content-end" aria-label="..."></nav>
            </div>
          </div>
        </div>
      </div>
      @include('layouts.footers.auth')
    </div>
@endsection

@push('js')
    <script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.min.js"></script>
    <script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.extension.js"></script>
@endpush