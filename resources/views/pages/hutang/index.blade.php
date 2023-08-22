@extends('layouts.app') 
@section('content') 
@php 
    $pageTitle = "Hutang"; 
    $breadcrumbs = [ 
        ['label' => 'Home', 'url' => '#'], 
    ]; 
        $activePage = "Hutang"; 

@endphp 
@include('layouts.headers.cards', compact('pageTitle', 'breadcrumbs', 'activePage'))
<br>
<div class="container-fluid mt--7">
    <div class="header-body">
        <!-- Card stats -->
        <div class="row">
          <div class="col-xl-12 col-lg-6" style="padding-bottom: 20px">
            <div class="d-flex justify-content-end">
              <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#cetakLaporanHutang">
                 Cetak Hutang
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
                  <h3 class="mb-0">Hutang</h3>
                </div>
              </div>
            </div>
            <div class="table-responsive">
              <table class="table align-items-center table-flush">
                <thead class="thead-light text-center">
                  <tr>
                    <th scope="col">Dibuat Oleh</th>
                    <th scope="col">Supplier</th>
                    <th scope="col">Subtotal</th>
                    <th scope="col">Hutang Dagang</th>
                    <th scope="col">Action</th>
                  </tr>
                </thead>
                <tbody>
                    {{-- For loop here --}}
                  @php $i = 1; @endphp
                  @forelse ($hutang as $data)
                    <tr>
                      <td>{{ $data->name }}</td>
                      <td>{{ $data->nama_supplier }}</td>
                      <td>{{ $data->subtotal }}</td>
                      <td>Rp.{{ $data->bayar }}</td>
                      <td class="text-center">
                        <div class="btn-group">
                          <button type="button" class="btn btn-sm btn-outline-primary" data-toggle="modal" data-target="#prosesHutang{{ $i }}">
                            <i class="ni ni-ruler-pencil mr-2"></i>Proses Hutang
                          </button>
                        </div>
                      </td>
                    </tr>
                    <!-- Modal edit Penerimaan -->
                    <div class="modal fade" id="prosesHutang{{ $i }}" tabindex="-1" role="dialog" aria-labelledby="prosesHutangLabel" aria-hidden="true">
                      <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h3 class="mb-0 text-center">Proses Hutang</h3>
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
                                <input type="text" id="name" name="name" value="{{ $data->name }}" class="form-control">
                              </div>
                              <div class="form-group">
                                <label for="nama_supplier">Nama Supplier <span class="text-danger">*</span></label>
                                <input type="text" id="nama_supplier" name="nama_supplier" value="{{ $data->nama_supplier }}" class="form-control">
                              </div>
                              <div class="form-group">
                                <label for="subtotal">Subtotal <span class="text-danger">*</span></label>
                                <input type="text" id="subtotal" name="subtotal" value="{{ $data->subtotal }}" class="form-control">
                              </div>
                              <div class="form-group">
                                <label for="bayar">Bayar <span class="text-danger">*</span></label>
                                <input type="text" id="bayar" name="bayar" value="{{ $data->bayar }}" placeholder="Rp." class="form-control">
                              </div>
                              {{-- <div class="form-group">
                                <label for="akun">Akun <span class="text-danger">*</span></label>
                                <select class="form-control" id="akun" name="akun" required>
                                    <option value="" selected disabled>Pilih Akun</option>
                                    @foreach($akun as $id => $value)
                                      <option value="{{ $id }}" @if($data->id_akun == $id) selected @endif>{{ $value }}</option>
                                    @endforeach
                                </select>
                              </div> --}}
                              <div class="row justify-content-center">
                                <div class="col text-center">
                                  <button type="submit" class="btn btn-success" onclick="return confirm('Update Hutang?')">Update</button>
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
    <!-- Modal Cetak Hutang -->
    <div class="modal fade" id="cetakLaporanHutang" tabindex="-1" role="dialog" aria-labelledby="cetakLaporanHutangLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h3 class="mb-0 text-center">Pilih Bulan :</h3>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form action="{{ route('hutang.pdf') }}" method="post">
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