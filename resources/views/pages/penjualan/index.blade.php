@extends('layouts.app') 
@section('content') 
@php // Define dynamic data 
$pageTitle = "Penjualan"; 
$breadcrumbs = [
  ['label' => 'Home', 'url' => '#'],
]; 
$activePage = "Penjualan"; 
@endphp 
@include('layouts.headers.cards') 
<div class="container-fluid mt--6">
  <div class="row">
    <div class="col text-right mb-3">
      <ul>
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#cetakLaporanModal">Cetak Laporan Penjualan</button>
        <a href="{{route('penjualan.create')}}" class="btn btn-primary">Tambah Penjualan</a>  
      </ul>
    </div>
  </div>
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
          <form action="{{ route('penjualan.pdf') }}" method="post">
            @csrf
            <div class="form-group">
              <label for="bulan_awal">Start Month:</label>
              <input type="month" id="bulan_awal" name="bulan_awal" class="form-control">
            </div>
            <div class="form-group">
              <label for="bulan_akhir">End Month:</label>
              <input type="month" id="bulan_akhir" name="bulan_akhir" class="form-control">
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
  <div class="row" style="padding-top: 20px">
    <div class="col">
      @if ($message = Session::get('success'))
          <div class="alert alert-success">
            <p>{{ $message }}</p>
          </div>
      @endif
      <div class="card">
        <div class="card-header border-0">
          <h3 class="mb-0">Penjualan</h3>
        </div>
        <div class="table-responsive">
          <table class="table align-items-center table-flush">
            <thead class="thead-light">
              <tr class="text-center">
                <th scope="col">Tanggal</th>
                <th scope="col">Dibuat oleh</th>
                <th scope="col">Customer</th>
                <th scope="col">Salesman</th>
                {{-- <th scope="col">Total Item</th>
                <th scope="col">Diskon</th> --}}
                <th scope="col">Subtotal</th>
                <th scope="col">Dibayar</th>
                <th scope="col">Keterangan</th>
                <th scope="col">Action</th>
              </tr>
            </thead>
            <tbody class="list">
              @forelse($penjualan as $datapenjualan)
                <tr class="text-center">
                  <td>{{ $datapenjualan->created_at }}</td>
                  <td>{{ $datapenjualan->name }}</td>
                  <td>{{ $datapenjualan->nama_customer }}</td>
                  <td>{{ $datapenjualan->nama_salesman }}</td>
                  <td>Rp. {{ $datapenjualan->subtotal }}</td>
                  <td>Rp. {{ $datapenjualan->tunai }}</td>
                  <td>{{ $datapenjualan->keterangan_penjualan }}</td>
                  <td class="text-center">
                    <div class="btn-group" role="group">
                      <a href="{{ route('penjualan.detail', $datapenjualan->id) }}" class="btn btn-sm btn-outline-primary" onclick="detailEntry()">
                        <i class="fas fa-info-circle mr-2"></i> Detail
                      </a>
                      <a href="" class="btn btn-sm btn-outline-primary" onclick="editEntry()">
                        <i class="ni ni-ruler-pencil mr-2"></i> Edit </button>
                      </a>
                      <a href="" class="btn btn-sm btn-outline-danger" onclick="return confirm('Hapus data kategori produk jual ini?');">
                        <i class="ni ni-fat-remove mr-2"></i> Delete </button>
                      </a>
                    </div>
                  </td>
                </tr>
              @empty
                <tr class="text-center">
                  <td colspan="7">
                    Tidak ada data
                  </td>
                </tr>
              @endforelse
              <!-- End loop -->
            </tbody>
          </table>
        </div>
        <div class="card-footer py-4">
          <nav aria-label="...">
            <ul class="pagination justify-content-end mb-0">
              {{-- {{ $penjualan->links() }} --}}
          </ul>
          </nav>
        </div>
      </div>
    </div>
  </div>
  <!-- Footer -->
</div> 
@endsection