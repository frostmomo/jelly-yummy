@extends('layouts.app')

@section('content')
@php
    $pageTitle = "Detail Penjualan";
    $breadcrumbs = [
        ['label' => 'Penjualan', 'url' => route('penjualan')],
        // ['label' => 'Detail', 'url' => '#'],
    ];
    $activePage = "Detail";
@endphp

@include('layouts.headers.cards', compact('pageTitle', 'breadcrumbs', 'activePage'))

<br>

<div class="container-fluid mt--7">
    <div class="row" style="padding-top: 80px">
        <div class="col">
            @if ($message = Session::get('failed'))
                <div class="alert alert-danger" id="alert-message">
                    <p>{{ $message }}</p>
                </div>
            @endif

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
            <div class="card">
                <div class="card-header text-center">
                    Detail Penjualan
                </div>
                <div class="card-body">
                    @foreach($penjualan as $datapenjualan)
                        <div class="form-group">
                          <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#editPenjualan">
                            <i class="ni ni-ruler-pencil mr-2"></i>Edit Penjualan</button>
                        </div>
                        <div class="form-group">
                            <label for="user">Dibuat Oleh:</label>
                            <p>{{ $datapenjualan->name }}</p>
                        </div>
                        <div class="form-group">
                            <label for="id_customer">Nama Customer:</label>
                            <p>{{ $datapenjualan->nama_customer }}</p>
                        </div>
                        <div class="form-group">
                            <label for="id_salesman">Nama Salesman:</label>
                            <p>{{ $datapenjualan->nama_salesman }}</p>
                        </div>
                        <div class="form-group">
                            <label for="diskon">Diskon %:</label>
                            <p>{{ $datapenjualan->diskon }}%</p>
                        </div>
                        @if(!empty($piutang))
                          @forelse($piutang as $datapiutang)
                            <div class="form-group">
                                <label for="tunai">Piutang:</label>
                                <p class="text-success">Rp.{{ $datapiutang->bayar }}</p>
                            </div>
                            @if($datapiutang->bayar != 0)
                                <div class="form-group">
                                    <button type="button" class="btn btn-sm btn-success" data-toggle="modal" data-target="#bayarPiutang">
                                      + Pembayaran Piutang
                                    </button>
                                </div>
                            @endif
                            <!-- Modal Piutang -->
                            <div class="modal fade" id="bayarPiutang" tabindex="-1" role="dialog" aria-labelledby="bayarPiutangLabel" aria-hidden="true">
                              <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <h3 class="mb-0 text-center">Pembayaran Piutang</h3>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                      <span aria-hidden="true">&times;</span>
                                    </button>
                                  </div>
                                  <div class="modal-body">
                                    <form action="{{ route('penjualan.bayar-piutang', ['id' => $datapiutang->id, 'idpenjualan' => $datapenjualan->id]) }}" method="post">
                                      @csrf
                                      @method('PUT')
                                      <div class="form-group">
                                        <label for="jumlah_piutang">Jumlah Piutang</label>
                                        <input type="text" id="jumlah_piutang" name="jumlah_piutang" value="Rp. {{ $datapiutang->bayar }}" class="form-control" readonly>
                                      </div>
                                      <div class="form-group">
                                        <label for="jumlah_bayar">Jumlah Dibayarkan</label>
                                        <input type="text" id="jumlah_bayar" name="jumlah_bayar" class="form-control" placeholder="Rp." required>
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
                                          <button type="submit" class="btn btn-success" onclick="return confirm('Konfirmasi Pembayaran?')">Confirm</button>
                                          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        </div>
                                      </div>
                                    </form>
                                  </div>
                                </div>
                              </div>
                            </div>
                          @empty
                            <div class="form-group">
                                <label for="tunai">Piutang:</label>
                                <p>Rp.0</p>
                            </div>
                          @endforelse
                        @endif
                        <div class="form-group">
                            <label for="id_produk">Detail Penjualan:</label>
                            <div class="form-group">
                              <button type="button" class="btn btn-sm btn-success" data-toggle="modal" data-target="#tambahItemPenjualan">
                                + Tambah Item</button>
                            </div>
                            <div class="table-responsive">
                                <table class="table align-items-center table-flush">
                                  <thead class="thead-light">
                                    <tr class="text-center">
                                      <th scope="col">Nama Produk Jual</th>
                                      <th scope="col">Kategori Jual</th>
                                      <th scope="col">Jumlah</th>
                                      <th scope="col">Total Harga</th>
                                      <th scope="col">Action</th>
                                    </tr>
                                  </thead>
                                  <tbody class="list">
                                    <!-- Replace with dynamic data using a loop -->
                                    @php $i = 0; @endphp
                                    @forelse($detailpenjualan as $datadetail)
                                      @php 
                                        $cekProduk = [];
                                        $cekProduk[] = $datadetail->id_produk_jual;
                                      @endphp
                                      <tr class="text-center">
                                        <td>{{ $datadetail->nama_produk_jual }}</td>
                                        <td>{{ $datadetail->kategori_jual }}</td>
                                        <td>{{ $datadetail->qty }}</td>
                                        <td>{{ $datadetail->total }}</td>
                                        <td class="text-center">
                                          <div class="btn-group" role="group">
                                            <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#editDetailPenjualan{{ $i }}">
                                              <i class="ni ni-ruler-pencil mr-2"></i> Edit </button>
                                            </button>
                                            <button type="button" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#returPenjualan{{ $i }}">
                                              <i class="ni ni-fat-remove mr-2"></i> Retur </button>
                                            </button>
                                          </div>
                                        </td>
                                      </tr>

                                      <!-- Modal Edit Detail Penjualan-->
                                      <div class="modal fade" id="editDetailPenjualan{{ $i }}" tabindex="-1" role="dialog" aria-labelledby="editDetailPenjualanLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                          <div class="modal-content">
                                            <div class="modal-header">
                                              <h3 class="mb-0 text-center">Edit Detail Penjualan</h3>
                                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                              </button>
                                            </div>
                                            <div class="modal-body">
                                              <form action="{{ route('penjualan.detail.update', $datadetail->id) }}" method="post">
                                                @csrf
                                                @method('PUT')
                                                {{-- <div class="form-group"> --}}
                                                  {{-- <label for="id_pembelian">ID Pembelian</label> --}}
                                                  <input type="text" id="id_penjualan" name="id_penjualan" value="{{ $datapenjualan->id }}" class="form-control" hidden readonly>
                                                  <input type="text" id="id_produk_jual" name="id_produk_jual" value="{{ $datadetail->id_produk_jual }}" class="form-control" hidden readonly>
                                                {{-- </div> --}}
                                                <div class="form-group">
                                                  <label for="produk_jual">Nama Produk Jual</label>
                                                  <input type="text" id="produk_jual" name="produk_jual" value="{{ $datadetail->nama_produk_jual }} {{ $datadetail->kategori_jual }}" class="form-control" disabled readonly>
                                                </div>
                                                <div class="form-group">
                                                  <label for="qty">Jumlah</label>
                                                  <input type="text" id="qty" name="qty" value="{{ $datadetail->qty }}" class="form-control">
                                                </div>
                                                <div class="row justify-content-center">
                                                  <div class="col text-center">
                                                    <button type="submit" class="btn btn-success" onclick="return confirm('Konfirmasi edit detail pembelian?')">Confirm</button>
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                  </div>
                                                </div>
                                              </form>
                                            </div>
                                          </div>
                                        </div>
                                      </div>

                                      <!-- Modal Retur Penjualan -->
                                      <div class="modal fade" id="returPenjualan{{ $i }}" tabindex="-1" role="dialog" aria-labelledby="returPenjualanLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                          <div class="modal-content">
                                            <div class="modal-header">
                                              <h3 class="mb-0 text-center">Retur Penjualan</h3>
                                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                              </button>
                                            </div>
                                            <div class="modal-body">
                                              <form action="{{ route('penjualan.retur-penjualan', $datadetail->id) }}" method="post">
                                                @csrf
                                                @method('PUT')
                                                <div class="form-group">
                                                  <label for="jumlah_item">Nama Produk Jual</label>
                                                  <input type="text" id="jumlah_item" name="jumlah_item" value="{{ $datadetail->nama_produk_jual }} {{ $datadetail->kategori_jual }}" class="form-control" disabled readonly>
                                                </div>
                                                <div class="form-group">
                                                  <label for="jumlah_bayar">Jumlah</label>
                                                  <input type="text" id="jumlah_bayar" name="jumlah_bayar" value="{{ $datadetail->qty }}" class="form-control" disabled readonly>
                                                </div>
                                                <div class="form-group">
                                                  <label for="jumlah_retur">Retur Sebanyak</label>
                                                  <input type="text" id="jumlah_retur" name="jumlah_retur" class="form-control" placeholder="0." required>
                                                </div>
                                                <div class="row justify-content-center">
                                                  <div class="col text-center">
                                                    <button type="submit" class="btn btn-success" onclick="return confirm('Konfirmasi Retur Penjualan?')">Confirm</button>
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                  </div>
                                                </div>
                                              </form>
                                            </div>
                                          </div>
                                        </div>
                                      </div>
                                      @php $i++; @endphp
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
                              <!-- Modal Edit Penjualan -->
                              <div class="modal fade" id="editPenjualan" tabindex="-1" role="dialog" aria-labelledby="editPenjualanLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                  <div class="modal-content">
                                    <div class="modal-header">
                                      <h3 class="mb-0 text-center">Edit Penjualan</h3>
                                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                      </button>
                                    </div>
                                    <div class="modal-body">
                                      <form action="{{ route('penjualan.update', $datapenjualan->id) }}" method="post">
                                        @csrf
                                        @method('PUT')
                                        <div class="form-group">
                                          <label for="id_customer">Nama Customer <span class="text-danger">*</span></label>
                                          <select class="form-control" id="id_customer" name="id_customer" required>
                                              <option value="" selected disabled>Pilih Customer</option>
                                              @foreach($customer as $id => $value)
                                                  <option value="{{ $id }}" @if($datapenjualan->id_customer == $id) selected @endif>{{ $value }}</option>
                                              @endforeach
                                          </select>
                                        </div>
                                        <div class="form-group">
                                          <label for="id_salesman">Nama Salesman <span class="text-danger">*</span></label>
                                          <select class="form-control" id="id_salesman" name="id_salesman" required>
                                              <option value="" selected disabled>Pilih Salesman</option>
                                              @foreach($salesman as $id => $value)
                                                  <option value="{{ $id }}" @if($datapenjualan->id_salesman == $id) selected @endif>{{ $value }}</option>
                                              @endforeach
                                          </select>
                                        </div>
                                        <div class="row justify-content-center">
                                          <div class="col text-center">
                                            <button type="submit" class="btn btn-success" onclick="return confirm('Konfirmasi edit penjualan?')">Confirm</button>
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                          </div>
                                        </div>
                                      </form>
                                    </div>
                                  </div>
                                </div>
                              </div>

                              <!-- Modal Tambah Item -->
                              <div class="modal fade" id="tambahItemPenjualan" tabindex="-1" role="dialog" aria-labelledby="tambahItemPenjualanLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                  <div class="modal-content">
                                    <div class="modal-header">
                                      <h3 class="mb-0 text-center">Tambah Item</h3>
                                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                      </button>
                                    </div>
                                    <div class="modal-body">
                                      <form action="{{ route('penjualan.tambah-item', $datapenjualan->id) }}" method="post">
                                        @csrf
                                        <div class="form-group">
                                          <label for="id_produk">Nama Produk <span class="text-danger">*</span></label>
                                          <select class="form-control" id="id_produk" name="id_produk" required>
                                              <option value="" selected disabled>Pilih Produk</option>
                                              @foreach($produkjual as $dataprodukjual)
                                                  <option value="{{ $dataprodukjual->id }}" @if(in_array($dataprodukjual->id, $cekProduk)) hidden disabled @endif>
                                                    {{ $dataprodukjual->nama_produk_jual }} {{ $dataprodukjual->kategori_jual }}</option>
                                              @endforeach
                                          </select>
                                        </div>
                                        <div class="form-group">
                                          <label for="qty">Jumlah Penjualan</label>
                                          <input type="text" id="qty" name="qty" value="" placeholder="0" class="form-control" required>
                                        </div>
                                        <div class="row justify-content-center">
                                          <div class="col text-center">
                                            <button type="submit" class="btn btn-success" onclick="return confirm('Konfirmasi Penjualan?')">Confirm</button>
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                          </div>
                                        </div>
                                      </form>
                                    </div>
                                  </div>
                                </div>
                              </div>

                              <div class="form-group">
                                <label for="id_produk">Retur Penjualan:</label>
                                <div class="table-responsive">
                                    <table class="table align-items-center table-flush">
                                      <thead class="thead-light">
                                        <tr class="text-center">
                                          <th scope="col">Nama Produk Jual</th>
                                          <th scope="col">Kategori Jual</th>
                                          <th scope="col">Jumlah Retur</th>
                                          <th scope="col">Total Retur</th>
                                        </tr>
                                      </thead>
                                      <tbody class="list">
                                        <!-- Replace with dynamic data using a loop -->
                                        @forelse($returpenjualan as $dataretur)
                                          <tr class="text-center">
                                            <td>{{ $dataretur->nama_produk_jual }}</td>
                                            <td>{{ $dataretur->kategori_jual }}</td>
                                            <td>{{ $dataretur->qty }}</td>
                                            <td>Rp. {{ $dataretur->subtotal }}</td>
                                          </tr>
                                        @empty
                                          <tr class="text-center">
                                            <td colspan="4">
                                              Tidak ada data
                                            </td>
                                          </tr>
                                        @endforelse
                                        <!-- End loop -->
                                      </tbody>
                                    </table>
                                </div>
                              </div>
                        </div>
                    @endforeach
                    <div class="text-center mt-4">
                        <a href="{{ route('penjualan') }}" class="btn btn-secondary">Kembali</a>
                    </div>
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
      var alertMessage = document.getElementById("alert-message");

      if (alertMessage) {
          setTimeout(function() {
              alertMessage.remove();
          }, 5000);
      }

      if(successMessage){
        setTimeout(function(){
          successMessage.remove();
        },5000);
      }
  });
</script>

@endpush
