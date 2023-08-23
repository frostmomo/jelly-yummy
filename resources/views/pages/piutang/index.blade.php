@extends('layouts.app') 
@section('content') 
@php 
    $pageTitle = "Piutang"; 
    $breadcrumbs = [ 
        ['label' => 'Home', 'url' => '#'], 
    ]; 
        $activePage = "Piutang"; 

@endphp 
@include('layouts.headers.cards', compact('pageTitle', 'breadcrumbs', 'activePage'))
<br>
<div class="container-fluid mt--7">
    <div class="header-body">
        <!-- Card stats -->
        <div class="row">
          <div class="col-xl-12 col-lg-6" style="padding-bottom: 20px">
            <div class="d-flex justify-content-end">
              <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#cetakLaporanPiutang">
                 Cetak Piutang
              </button>
            </div>
          </div>
        </div>
      </div>
      <br>
      @if ($message = Session::get('success'))
          <div class="alert alert-success" id="success-message">
            <p>{{ $message }}</p>
          </div>
      @endif
      @if ($errors->any())
        <div class="alert alert-danger">
          <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div><br>
      @endif
      <div class="row">
        <div class="col">
          <div class="card shadow">
            <div class="card-header border-0">
              <div class="row align-items-center">
                <div class="col-10">
                  <h3 class="mb-0">Piutang</h3>
                </div>
              </div>
            </div>
            <div class="table-responsive">
              <table class="table align-items-center table-flush">
                <thead class="thead-light text-center">
                  <tr>
                    <th scope="col">Dibuat Oleh</th>
                    <th scope="col">Customer</th>
                    <th scope="col">Salesman</th>
                    <th scope="col">Piutang Dagang</th>
                    <th scope="col">Action</th>
                  </tr>
                </thead>
                <tbody>
                    {{-- For loop here --}}
                  @php $i = 1; @endphp
                  @forelse ($piutang as $data)
                    <tr>
                      <td>{{ $data->name }}</td>
                      <td>{{ $data->nama_customer }}</td>
                      <td>{{ $data->nama_salesman }}</td>
                      <td>Rp.{{ $data->bayar }}</td>
                      <td class="text-center">
                        <div class="btn-group">
                          <a href="{{ route('penjualan.detail', $data->id) }}" class="btn btn-sm btn-outline-primary">
                            <i class="ni ni-ruler-pencil mr-2"></i>Proses Piutang
                          </a>
                        </div>
                      </td>
                    </tr>
                    <!-- Modal edit Penerimaan -->
                    <div class="modal fade" id="prosesPiutang{{ $i }}" tabindex="-1" role="dialog" aria-labelledby="prosesPiutangLabel" aria-hidden="true">
                      <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h3 class="mb-0 text-center">Proses Piutang</h3>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <div class="modal-body">
                            <form action="#" method="post">
                              @csrf
                              @method('PUT')
                              <div class="form-group">
                                <label for="name">Name <span class="text-danger">*</span></label>
                                <input type="text" id="uraian" name="uraian" value="{{ $data->name }}" class="form-control">
                              </div>
                              <div class="form-group">
                                <label for="nama_customer">Nama Customer <span class="text-danger">*</span></label>
                                <input type="text" id="nama_customer" name="nama_customer" value="{{ $data->nama_customer }}" class="form-control">
                              </div>
                              <div class="form-group">
                                <label for="nama_salesman">Nama Salesman <span class="text-danger">*</span></label>
                                <input type="text" id="nama_salesman" name="nama_salesman" value="{{ $data->nama_salesman }}" class="form-control">
                              </div>
                              <div class="form-group">
                                <label for="bayarl">Bayar <span class="text-danger">*</span></label>
                                <input type="text" id="bayar" name="bayar" value="{{ $data->bayar }}" placeholder="Rp." class="form-control">
                              </div>
                              <div class="row justify-content-center">
                                <div class="col text-center">
                                  <button type="submit" class="btn btn-success" onclick="return confirm('Update Piutang?')">Update</button>
                                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                </div>
                              </div>
                            </form>
                          </div>
                        </div>
                      </div>
                    </div>
                    @php $i++ @endphp
                  @empty 
                    <tr>
                      <td colspan="6" class="text-center">Tidak ada data</td>
                    </tr>
                  @endforelse
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Modal Cetak Piutang -->
    <div class="modal fade" id="cetakLaporanPiutang" tabindex="-1" role="dialog" aria-labelledby="cetakLaporanPiutangLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h3 class="mb-0 text-center">Pilih Bulan :</h3>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form action="{{ route('piutang.pdf') }}" method="post">
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