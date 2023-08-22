@extends('layouts.app') 
@section('content') 
@php // Define dynamic data 
$pageTitle = "Pembelian"; 
$breadcrumbs = [
  ['label' => 'Home', 'url' => '#'],
]; 
$activePage = "Pembelian"; 
@endphp 
@include('layouts.headers.cards') 
<div class="container-fluid mt--6">
  <div class="row">
    <div class="col text-right mb-3">
      <ul>
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#cetakLaporanModal">Cetak Laporan Pembelian</button>
        <a href="{{route('pembelian.create')}}" class="btn btn-primary">Tambah Pembelian</a>  
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
              <form action="{{ route('pembelian.pdf') }}" method="post">
                @csrf
                <div class="form-group">
                  <label for="bulan_awal">Start Month:</label>
                  <input type="date" id="bulan_awal" name="bulan_awal" class="form-control">
                </div>
                <div class="form-group">
                  <label for="bulan_akhir">End Month:</label>
                  <input type="date" id="bulan_akhir" name="bulan_akhir" class="form-control">
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
  <div class="row">
    <div class="col">
      @if ($message = Session::get('success'))
          <div class="alert alert-success" id="success-message">
            <p>{{ $message }}</p>
          </div>
      @endif
      <div class="card">
        <div class="card-header border-0">
          <h3 class="mb-0">Pembelian</h3>
        </div>
        <div class="table-responsive">
          <table class="table align-items-center table-flush">
            <thead class="thead-light">
              <tr class="text-center">
                <th scope="col">Tanggal</th>
                <th scope="col">Dibuat Oleh</th>
                <th scope="col">Supplier</th>
                <th scope="col">Total Item</th>
                <th scope="col">Subtotal</th>
                <th scope="col">Diskon</th>
                <th scope="col">Bayar</th>
                <th scope="col">Action</th>
              </tr>
            </thead>
            <tbody class="list">
              <!-- Replace with dynamic data using a loop -->
              @forelse($pembelian as $datapembelian)
                <tr class="text-center">
                  <td>{{ $datapembelian->created_at }}</td>
                  <td>{{ $datapembelian->name }}</td>
                  <td>{{ $datapembelian->nama_supplier }}</td>
                  <td>{{ $datapembelian->total_item }}</td>
                  <td>Rp. {{ $datapembelian->subtotal }}</td>
                  <td>{{ $datapembelian->diskon }}%</td>
                  <td>Rp. {{ $datapembelian->bayar }}</td>
                  <td class="text-center">
                    <div class="btn-group" role="group">
                      <a href="{{ route('pembelian.detail', $datapembelian->id) }}" class="btn btn-sm btn-outline-primary" onclick="detailEntry()">
                        <i class="fas fa-info-circle mr-2"></i> Detail
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
  <!-- Footer -->
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