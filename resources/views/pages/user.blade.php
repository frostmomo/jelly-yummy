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
              Buat Jurnal (Modal)
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
      </div>
      <br>
      <div class="row">
        <div class="col">
          <div class="card shadow">
            <div class="card-header border-0">
              <div class="row align-items-center">
                <div class="col-10">
                  <h3 class="mb-0">User</h3>
                </div>
              </div>
            </div>
            <div class="table-responsive">
              <table class="table align-items-center table-flush">
                <thead class="thead-light">
                  <tr>
                    <th scope="col">Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Role</th>
                    <th scope="col">Action</th>
                  </tr>
                </thead>
                <tbody>
                    {{-- For loop here --}}
                  <tr>
                    <td>Jajang Spakbor</td>
                    <td>jspro@mail.com</td>
                    <td>Developer</td>
                    <td class="text-right">
                      <div class="dropdown">
                        <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                          <i class="fas fa-ellipsis-v"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                          <a class="dropdown-item" href="">Detail</a>
                        </div>
                        <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                          <a class="dropdown-item" href="">Edit</a>
                        </div>
                        <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                          <a class="dropdown-item" href="">Delete</a>
                        </div>
                      </div>
                    </td>
                  </tr>
                  <tr>
                    <td>Jajang Spakbor</td>
                    <td>jspro@mail.com</td>
                    <td>Developer</td>
                    <td class="text-right">
                      <div class="dropdown">
                        <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                          <i class="fas fa-ellipsis-v"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                          <a class="dropdown-item" href="">Detail</a>
                        </div>
                        <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                          <a class="dropdown-item" href="">Edit</a>
                        </div>
                        <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                          <a class="dropdown-item" href="">Delete</a>
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