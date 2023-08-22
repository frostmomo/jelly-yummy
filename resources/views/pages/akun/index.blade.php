@extends('layouts.app') 
@section('content') 
@php 
    $pageTitle = "Akun"; 
    $breadcrumbs = [ 
        ['label' => 'Home', 'url' => '#'], 
    ]; 
        $activePage = "Akun"; 

@endphp 
@include('layouts.headers.cards', compact('pageTitle', 'breadcrumbs', 'activePage'))
<br>
<div class="container-fluid mt--7">
    <div class="header-body">
        <!-- Card stats -->
        <div class="row">
          <div class="col-xl-12 col-lg-6" style="padding-bottom: 20px">
            <div class="d-flex justify-content-end">
              <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#tambahAkun">
                 Tambah Akun
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
                  <h3 class="mb-0">Akun</h3>
                </div>
              </div>
            </div>
            <div class="table-responsive">
              <table class="table align-items-center table-flush">
                <thead class="thead-light text-center">
                  <tr>
                    <th scope="col">Nama Akun</th>
                    <th scope="col">Kelompok</th>
                    <th scope="col">Kode Akun</th>
                    <th scope="col">Action</th>
                  </tr>
                </thead>
                <tbody>
                    {{-- For loop here --}}
                  @php $i = 1; @endphp
                  @forelse ($akun as $data)
                    <tr>
                      <td>{{ $data->nama_akun }}</td>
                      <td>{{ $data->kelompok_akun }}</td>
                      <td>{{ $data->kode_akun }}</td>
                      <td class="text-center">
                        <div class="btn-group">
                          <button type="button" class="btn btn-sm btn-outline-primary" data-toggle="modal" data-target="#editAkun{{ $i }}">
                            <i class="ni ni-ruler-pencil mr-2"></i>Edit Akun
                          </button>
                          <a href="{{ route('akun.delete', $data->id) }}" class="btn btn-sm btn-outline-danger" onclick="return confirm('Hapus data akun ini?');">
                              <i class="ni ni-fat-remove mr-2"></i>
                              Delete
                          </a>
                        </div>
                      </td>
                    </tr>
                    <!-- Modal edit Akun -->
                    <div class="modal fade" id="editAkun{{ $i }}" tabindex="-1" role="dialog" aria-labelledby="editAkunLabel" aria-hidden="true">
                      <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h3 class="mb-0 text-center">Edit Akun</h3>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <div class="modal-body">
                            <form action="{{ route('akun.update', $data->id) }}" method="post">
                              @csrf
                              @method('PUT')
                              <div class="form-group">
                                <label for="nama_akun">Nama Akun</label>
                                <input type="text" id="nama_akun" name="nama_akun" value="{{ $data->nama_akun }}" class="form-control">
                              </div>
                              <div class="form-group">
                                <label for="kelompok">Kelompok Akun <span class="text-danger">*</span></label>
                                <select class="form-control" id="kelompok" name="kelompok" required>
                                    <option value="" selected disabled>Pilih Kelompok</option>
                                    <option value="1. Aktiva" @if($data->kelompok_akun == '1. Aktiva') selected @endif>1. Aktiva</option>
                                    <option value="2. Hutang" @if($data->kelompok_akun == '2. Hutang') selected @endif>2. Hutang</option>
                                    <option value="3. Modal Pemilik" @if($data->kelompok_akun == '3. Modal Pemilik') selected @endif>3. Modal Pemilik</option>
                                    <option value="4. Penjualan" @if($data->kelompok_akun == '4. Penjualan') selected @endif>4. Penjualan</option>
                                    <option value="5. Pembelian" @if($data->kelompok_akun == '5. Pembelian') selected @endif>5. Pembelian</option>
                                    <option value="6. Beban" @if($data->kelompok_akun == '6. Beban') selected @endif>6. Beban</option>
                                </select>
                              </div>
                              <div class="form-group">
                                <label for="kode_akun">Kode Akun</label>
                                <input type="text" id="kode_akun" name="kode_akun" value="{{ $data->kode_akun }}" class="form-control">
                              </div>
                              <div class="row justify-content-center">
                                <div class="col text-center">
                                  <button type="submit" class="btn btn-success" onclick="return confirm('Tambah Akun?')">Save</button>
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
                      <td colspan="4" class="text-center">Tidak ada data</td>
                    </tr>
                  @endforelse
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Modal Tambah Akun -->
    <div class="modal fade" id="tambahAkun" tabindex="-1" role="dialog" aria-labelledby="tambahAkunLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h3 class="mb-0 text-center">Tambah Akun</h3>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form action="{{ route('akun.store') }}" method="post">
              @csrf
              <div class="form-group">
                <label for="nama_akun">Nama Akun</label>
                <input type="text" id="nama_akun" name="nama_akun" class="form-control">
              </div>
              <div class="form-group">
                <label for="kelompok">Kelompok Akun <span class="text-danger">*</span></label>
                <select class="form-control" id="kelompok" name="kelompok" required>
                    <option value="" selected disabled>Pilih Kelompok</option>
                    <option value="1. Aktiva">1. Aktiva</option>
                    <option value="2. Hutang">2. Hutang</option>
                    <option value="3. Modal Pemilik">3. Modal Pemilik</option>
                    <option value="4. Penjualan">4. Penjualan</option>
                    <option value="5. Pembelian">5. Pembelian</option>
                    <option value="6. Beban">6. Beban</option>
                </select>
              </div>
              <div class="form-group">
                <label for="kode_akun">Kode Akun</label>
                <input type="text" id="kode_akun" name="kode_akun" class="form-control">
              </div>
              <div class="row justify-content-center">
                <div class="col text-center">
                  <button type="submit" class="btn btn-success" onclick="return confirm('Tambah Akun?')">Save</button>
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