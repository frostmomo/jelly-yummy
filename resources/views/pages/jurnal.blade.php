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
            <a href="#" class="btn btn-primary">Buat Jurnal</a>
            <button class="btn btn-primary ml-2" data-toggle="modal" data-target="#createJournalModal">Cetak Laporan Jurnal</button>
        </div>
      </div>
      <div class="modal fade" id="createJournalModal" tabindex="-1" role="dialog" aria-labelledby="createJournalModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h3 class="mb-0 text-center">Pilih Bulan :</h3>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <form action="#" method="post">
                @csrf
                <div class="form-group">
                  <label for="tanggal_awal">Start Date:</label>
                  <input type="date" id="tanggal_awal" name="tanggal_awal" class="form-control">
                </div>
                <div class="form-group">
                  <label for="tanggal_akhir">End Date:</label>
                  <input type="date" id="tanggal_akhir" name="tanggal_akhir" class="form-control">
                </div>
                <div class="row justify-content-center">
                  <div class="col">
                    <button type="submit" class="btn btn-primary">Generate PDF Report</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="row" style="padding-top: 20px">
    <div class="col">
      <div class="card shadow">
        <div class="card-header border-0">
          <div class="row align-items-center">
            <div class="col-10">
              <h3 class="mb-0">Jurnal</h3>
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
      </div>
    </div>
  </div>
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