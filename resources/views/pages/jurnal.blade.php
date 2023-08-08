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
@endphp 
@include('layouts.headers.cards', compact('pageTitle', 'breadcrumbs', 'activePage'))
<br>
<div class="container-fluid mt--7">
    <div class="header-body">
        <!-- Card stats -->
        <div class="row">
          <div class="col-xl-8 col-lg-6">
          </div>
          <div class="col-xl-2 col-lg-6" style="padding-bottom: 20px">
            <a href="{{ route('jurnal.create') }}" class="btn btn-primary btn-block">
              Buat Jurnal
            </a>
        </div>
        <div class="modal fade" id="createJournalModal" tabindex="-1" role="dialog" aria-labelledby="createJournalModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Journal Entry Form</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Journal Entry Form -->
                    <form action="{{ route('jurnal.create') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="bulan">Bulan</label>
                            <select class="form-control" id="bulan" name="bulan" required>
                                @php
                                    $months = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
                                @endphp
                                @foreach($months as $index => $month)
                                    <option value="{{ $index + 1 }}">{{ $month }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="tahun">Tahun</label>
                            <select class="form-control" id="tahun" name="tahun" required>
                                @php
                                    $currentYear = date('Y');
                                    $startYear = $currentYear - 10;
                                @endphp
                                @for($year = $currentYear; $year >= $startYear; $year--)
                                    <option value="{{ $year }}">{{ $year }}</option>
                                @endfor
                            </select>
                        </div>
                        <!-- Add more form fields if needed -->
    
                        <!-- Modal Footer -->
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
      </div>
        <div class="col-xl-2 col-lg-6" style="padding-bottom: 20px">
            <button class="btn btn-primary btn-block " data-toggle="modal" data-target="#createJournalModal" >
              <i class="fas fa-book-open"></i> Cetak Laporan Jurnal
            </button>
        </div>
        </div>
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
                <div class="col-10">
                  <h3 class="mb-0">Jurnal</h3>
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
                    <td class="text-center">
                      <div class="btn-group" role="group">
                          <button type="button" class="btn btn-sm btn-outline-primary" onclick="editEntry()">
                              <i class="ni ni-ruler-pencil mr-2"></i>
                              Edit
                          </button>
                          <button type="button" class="btn btn-sm btn-outline-danger" onclick="deleteEntry()">
                              <i class="ni ni-fat-remove mr-2"></i>
                              Delete
                          </button>
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
                    <td class="text-center">
                      <div class="btn-group" role="group">
                          <button type="button" class="btn btn-sm btn-outline-primary" onclick="editEntry()">
                              <i class="ni ni-ruler-pencil mr-2"></i>
                              Edit
                          </button>
                          <button type="button" class="btn btn-sm btn-outline-danger" onclick="deleteEntry()">
                              <i class="ni ni-fat-remove mr-2"></i>
                              Delete
                          </button>
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