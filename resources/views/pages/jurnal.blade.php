@extends('layouts.app') 
@section('content') 
@php 
  $pageTitle = "Jurnal"; 
  $breadcrumbs = [ 
    ['label' => 'Home', 'url' => '#'],
  ];
  $activePage = "Jurnal";  
@endphp 
@include('layouts.headers.cards', compact('pageTitle', 'breadcrumbs', 'activePage')) 
<br>
<div class="container-fluid mt--7">
  <div class="header-body">
    <!-- Card stats -->
    <div class="row">
      <div class="col-xl-12 col-lg-6" style="padding-bottom: 20px">
        <div class="d-flex justify-content-end">
            <a href="{{ route('jurnal.create') }}" class="btn btn-primary">Buat Jurnal</a>
            <button class="btn btn-primary ml-2" data-toggle="modal" data-target="#createJournalModal">Cetak Laporan Jurnal</button>
        </div>
      </div>
      <div class="modal fade" id="createJournalModal" tabindex="-1" role="dialog" aria-labelledby="createJournalModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Cetak Laporan Jurnal</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
              <form action="{{ route('jurnal.create') }}" method="POST"> @csrf <div class="form-group">
                <label for="bulan">Bulan</label>
                <select class="form-control" id="bulan" name="bulan" required> @php $months = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December']; @endphp @foreach($months as $index => $month) <option value="{{ $index + 1 }}">{{ $month }}</option> @endforeach </select>
              </div>
              <div class="form-group">
                <label for="tahun">Tahun</label>
                <select class="form-control" id="tahun" name="tahun" required> @php $currentYear = date('Y'); $startYear = $currentYear - 10; @endphp @for($year = $currentYear; $year >= $startYear; $year--) <option value="{{ $year }}">{{ $year }}</option> @endfor </select>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
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
                      <i class="ni ni-ruler-pencil mr-2"></i> Edit </button>
                    <button type="button" class="btn btn-sm btn-outline-danger" onclick="deleteEntry()">
                      <i class="ni ni-fat-remove mr-2"></i> Delete </button>
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
@endsection 
@push('js') 
  <script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.min.js"></script>
  <script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.extension.js"></script>
@endpush