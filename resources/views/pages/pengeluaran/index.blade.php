@extends('layouts.app') 
@section('content') 
@php 
    $pageTitle = "Pengeluaran"; 
    $breadcrumbs = [ 
        ['label' => 'Home', 'url' => '#'], 
    ]; 
        $activePage = "Pengeluaran"; 

@endphp 
@include('layouts.headers.cards', compact('pageTitle', 'breadcrumbs', 'activePage'))
<br>
<div class="container-fluid mt--7">
    <div class="header-body">
        <!-- Card stats -->
        <div class="row">
          <div class="col-xl-12 col-lg-6" style="padding-bottom: 20px">
            <div class="d-flex justify-content-end">
              <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#cetakLaporanModal">Cetak Laporan Pengeluaran</button>
              <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#tambahPengeluaran">
                 Tambah Pengeluaran
              </button>
            </div>
          </div>
        </div>
      </div>
      <br>
      <!-- Cetak Laporan Modal -->
      <div class="modal fade" id="cetakLaporanModal" tabindex="-1" role="dialog" aria-labelledby="cetakLaporanModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h3 class="mb-0 text-center">Pilih Bulan :</h3>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <form action="{{ route('pengeluaran.pdf') }}" method="post">
                @csrf
                <div class="form-group">
                  <label for="tanggal_awal">Start Month:</label>
                  <input type="date" id="tanggal_awal" name="tanggal_awal" class="form-control">
                </div>
                <div class="form-group">
                  <label for="tanggal_akhir">End Month:</label>
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
                  <h3 class="mb-0">Pengeluaran Kas</h3>
                </div>
              </div>
            </div>
            <div class="table-responsive">
              <table class="table align-items-center table-flush">
                <thead class="thead-light text-center">
                  <tr>
                    <th scope="col">Dibuat Oleh</th>
                    <th scope="col">Uraian</th>
                    <th scope="col">Keterangan</th>
                    <th scope="col">Akun</th>
                    <th scope="col">Subtotal</th>
                    <th scope="col">Action</th>
                  </tr>
                </thead>
                <tbody>
                    {{-- For loop here --}}
                  @php $i = 1; @endphp
                  @forelse ($pengeluaran as $data)
                    <tr>
                      <td>{{ $data->name }}</td>
                      <td>{{ $data->uraian }}</td>
                      <td>{{ $data->keterangan }}</td>
                      <td>{{ $data->nama_akun }}</td>
                      <td>Rp.{{ $data->subtotal }}</td>
                      <td class="text-center">
                        <div class="btn-group">
                          <button type="button" class="btn btn-sm btn-outline-primary" data-toggle="modal" data-target="#editPengeluaran{{ $i }}">
                            <i class="ni ni-ruler-pencil mr-2"></i>Edit Pengeluaran
                          </button>
                          <a href="{{ route('pengeluaran.delete', $data->id) }}" class="btn btn-sm btn-outline-danger" onclick="return confirm('Hapus data pengeluaran ini?');">
                              <i class="ni ni-fat-remove mr-2"></i>
                              Delete
                          </a>
                        </div>
                      </td>
                    </tr>
                    <!-- Modal edit pengeluaran -->
                    <div class="modal fade" id="editPengeluaran{{ $i }}" tabindex="-1" role="dialog" aria-labelledby="editPengeluaranLabel" aria-hidden="true">
                      <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h3 class="mb-0 text-center">Edit Pengeluaran</h3>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <div class="modal-body">
                            <form action="{{ route('pengeluaran.update', $data->id) }}" method="post">
                              @csrf
                              @method('PUT')
                              <div class="form-group">
                                <label for="uraian">Uraian <span class="text-danger">*</span></label>
                                <input type="text" id="uraian" name="uraian" value="{{ $data->uraian }}" class="form-control">
                              </div>
                              <div class="form-group">
                                <label for="keterangan">Keterangan <span class="text-danger">*</span></label>
                                <input type="text" id="keterangan" name="keterangan" value="{{ $data->keterangan }}" class="form-control">
                              </div>
                              <div class="form-group">
                                <label for="total">Total <span class="text-danger">*</span></label>
                                <input type="text" id="total" name="total" value="{{ $data->subtotal }}" placeholder="Rp." class="form-control">
                              </div>
                              <div class="form-group">
                                <label for="akun">Akun <span class="text-danger">*</span></label>
                                <select class="form-control" id="akun" name="akun" required>
                                    <option value="" selected disabled>Pilih Akun</option>
                                    @foreach($akun as $id => $value)
                                      <option value="{{ $id }}" @if($data->id_akun == $id) selected @endif>{{ $value }}</option>
                                    @endforeach
                                </select>
                              </div>
                              <div class="row justify-content-center">
                                <div class="col text-center">
                                  <button type="submit" class="btn btn-success" onclick="return confirm('Update Penerimaan?')">Update</button>
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
    <!-- Modal Tambah Pengeluaran -->
    <div class="modal fade" id="tambahPengeluaran" tabindex="-1" role="dialog" aria-labelledby="tambahPengeluaranLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h3 class="mb-0 text-center">Tambah Pengeluaran</h3>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form action="{{ route('pengeluaran.store') }}" method="post">
              @csrf
              <div class="form-group">
                <label for="uraian">Uraian <span class="text-danger">*</span></label>
                <input type="text" id="uraian" name="uraian" class="form-control">
              </div>
              <div class="form-group">
                <label for="keterangan">Keterangan <span class="text-danger">*</span></label>
                <input type="text" id="keterangan" name="keterangan" class="form-control">
              </div>
              <div class="form-group">
                <label for="total">Total <span class="text-danger">*</span></label>
                <input type="text" id="total" name="total" placeholder="Rp." class="form-control">
              </div>
              <div class="form-group">
                <label for="akun">Akun <span class="text-danger">*</span></label>
                <select class="form-control" id="akun" name="akun" required>
                    <option value="" selected disabled>Pilih Akun</option>
                    @foreach($akun as $id => $value)
                      <option value="{{ $id }}">{{ $value }}</option>
                    @endforeach
                </select>
              </div>
              <div class="row justify-content-center">
                <div class="col text-center">
                  <button type="submit" class="btn btn-success" onclick="return confirm('Tambah Pengeluaran?')">Save</button>
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