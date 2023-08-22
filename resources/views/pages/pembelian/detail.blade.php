@extends('layouts.app')

@section('content')
@php
    $pageTitle = "Detail Pembelian";
    $breadcrumbs = [
        ['label' => 'Pembelian', 'url' => route('pembelian')],
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
                  <div class="row">
                    <div class="col text-center">
                        Detail Pembelian
                    </div>
                  </div>
                </div>
                <div class="card-body">
                    @foreach($pembelian as $datapembelian)
                        <div class="form-group">
                          <button type="button" class="btn-sm btn-primary" data-toggle="modal" data-target="#editPembelian">
                            <i class="ni ni-ruler-pencil mr-2"></i>Edit Pembelian</button>
                        </div>
                        <div class="form-group">
                            <label for="user">Dibuat Oleh :</label>
                            <p>{{ $datapembelian->name }}</p>
                        </div>
                        <div class="form-group">
                            <label for="id_supplier">Nama Supplier :</label>
                            <p>{{ $datapembelian->nama_supplier }}</p>
                        </div>
                        <div class="form-group">
                            <label for="total_item">Total item :</label>
                            <p>{{ $datapembelian->total_item }}</p>
                        </div>
                        <div class="form-group">
                            <label for="subtotal">Jumlah yang Harus Dibayar :</label>
                            <p>Rp. {{ $datapembelian->subtotal }}</p>
                        </div>
                        <div class="form-group">
                            <label for="diskon">Diskon :</label>
                            <p>{{ $datapembelian->diskon }}%</p>
                        </div>
                        <div class="form-group">
                            <label for="bayar">Pengeluaran :</label>
                            <p class="text-danger">Rp. {{ $datapembelian->bayar }}</p>
                        </div>
                        <div class="form-group">
                          <button type="button" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#bayarHutang">
                            + Pembayaran Hutang</button>
                        </div>
                        <div class="form-group">
                            <label for="id_produk">Detail Pembelian:</label>
                            <div class="form-group">
                              <button type="button" class="btn btn-sm btn-success" data-toggle="modal" data-target="#tambahItemPembelian">
                                + Tambah Item</button>
                            </div>
                            <div class="table-responsive">
                                <table class="table align-items-center table-flush">
                                  <thead class="thead-light">
                                    <tr class="text-center">
                                      <th scope="col">Nama Produk Beli</th>
                                      <th scope="col">Kategori Beli</th>
                                      <th scope="col">Jumlah</th>
                                      <th scope="col">Total Harga</th>
                                      <th scope="col">Action</th>
                                    </tr>
                                  </thead>
                                  <tbody class="list">
                                    <!-- Replace with dynamic data using a loop -->
                                    @php $i = 0; @endphp
                                    @forelse($detailpembelian as $datadetail)
                                      @php 
                                        $cekProduk = [];
                                        $cekProduk[] = $datadetail->id_produk_beli;
                                      @endphp
                                      <tr class="text-center">
                                        <td>{{ $datadetail->nama_produk_beli }}</td>
                                        <td>{{ $datadetail->kategori_beli }}</td>
                                        <td>{{ $datadetail->qty }}</td>
                                        <td>Rp.{{ $datadetail->total }}</td>
                                        <td class="text-center">
                                          <div class="btn-group" role="group">
                                            <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#editDetailPembelian{{ $i }}">
                                              <i class="ni ni-ruler-pencil mr-2"></i> Edit </button>
                                            <button type="button" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#returPembelian{{ $i }}">
                                              <i class="ni ni-fat-remove mr-2"></i> Retur </button>
                                          </div>
                                        </td>
                                      </tr>
                                      <!-- Modal Edit Detail Pembelian-->
                                      <div class="modal fade" id="editDetailPembelian{{ $i }}" tabindex="-1" role="dialog" aria-labelledby="editDetailPembelianLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                          <div class="modal-content">
                                            <div class="modal-header">
                                              <h3 class="mb-0 text-center">Edit Detail Pembelian</h3>
                                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                              </button>
                                            </div>
                                            <div class="modal-body">
                                              <form action="{{ route('pembelian.detail.update', $datadetail->id) }}" method="post">
                                                @csrf
                                                @method('PUT')
                                                {{-- <div class="form-group"> --}}
                                                  {{-- <label for="id_pembelian">ID Pembelian</label> --}}
                                                  <input type="text" id="id_pembelian" name="id_pembelian" value="{{ $datapembelian->id }}" class="form-control" hidden readonly>
                                                  <input type="text" id="id_produk_beli" name="id_produk_beli" value="{{ $datadetail->id_produk_beli }}" class="form-control" hidden readonly>
                                                {{-- </div> --}}
                                                <div class="form-group">
                                                  <label for="jumlah_item">Nama Produk Beli</label>
                                                  <input type="text" id="jumlah_item" name="jumlah_item" value="{{ $datadetail->nama_produk_beli }} {{ $datadetail->kategori_beli }}" class="form-control" disabled readonly>
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

                                      <!-- Modal Retur Pembelian-->
                                      <div class="modal fade" id="returPembelian{{ $i }}" tabindex="-1" role="dialog" aria-labelledby="returPembelianLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                          <div class="modal-content">
                                            <div class="modal-header">
                                              <h3 class="mb-0 text-center">Retur Pembelian</h3>
                                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                              </button>
                                            </div>
                                            <div class="modal-body">
                                              <form action="{{ route('pembelian.retur-pembelian', $datadetail->id) }}" method="post">
                                                @csrf
                                                @method('PUT')
                                                  <input type="text" id="id_pembelian" name="id_pembelian" value="{{ $datapembelian->id }}" class="form-control" hidden readonly>
                                                <div class="form-group">
                                                  <label for="produk_jual">Nama Produk Beli</label>
                                                  <input type="text" id="produk_jual" name="produk_jual" value="{{ $datadetail->nama_produk_beli }} ({{ $datadetail->kategori_beli }})" class="form-control" disabled readonly>
                                                </div>
                                                <div class="form-group">
                                                  <label for="jumlah_item">Jumlah Item</label>
                                                  <input type="text" id="jumlah_item" name="jumlah_item" value="{{ $datadetail->qty }}" class="form-control" readonly>
                                                </div>
                                                <div class="form-group">
                                                  <label for="jumlah_retur">Jumlah Retur</label>
                                                  <input type="text" id="jumlah_retur" name="jumlah_retur" value="" placeholder="0" class="form-control">
                                                </div>
                                                <div class="row justify-content-center">
                                                  <div class="col text-center">
                                                    <button type="submit" class="btn btn-success" onclick="return confirm('Konfirmasi retur pembelian?')">Confirm</button>
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
                        </div>

                        <div class="form-group">
                          <label for="id_produk">Retur Pembelian:</label>
                          <div class="table-responsive">
                              <table class="table align-items-center table-flush">
                                <thead class="thead-light">
                                  <tr class="text-center">
                                    <th scope="col">Nama Produk Beli</th>
                                    <th scope="col">Kategori Beli</th>
                                    <th scope="col">Jumlah Retur</th>
                                    <th scope="col">Total Retur</th>
                                  </tr>
                                </thead>
                                <tbody class="list">
                                  <!-- Replace with dynamic data using a loop -->
                                  @forelse($returpembelian as $dataretur)
                                    <tr class="text-center">
                                      <td>{{ $dataretur->nama_produk_beli }}</td>
                                      <td>{{ $dataretur->kategori_beli }}</td>
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
                    @endforeach

                    <!-- Modal Hutang -->
                    <div class="modal fade" id="bayarHutang" tabindex="-1" role="dialog" aria-labelledby="bayarHutangLabel" aria-hidden="true">
                      <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h3 class="mb-0 text-center">Pembayaran Hutang</h3>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <div class="modal-body">
                            <form action="{{ route('pembelian.hutang', $datapembelian->id) }}" method="post">
                              @csrf
                              @method('PUT')
                              <div class="form-group">
                                <label for="jumlah_piutang">Jumlah yang Harus diabayar</label>
                                <input type="text" id="jumlah_piutang" name="jumlah_piutang" value="Rp.{{ $datapembelian->subtotal }}" class="form-control" readonly>
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

                    <!-- Modal Edit Pembelian -->
                    <div class="modal fade" id="editPembelian" tabindex="-1" role="dialog" aria-labelledby="editPembelianLabel" aria-hidden="true">
                      <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h3 class="mb-0 text-center">Edit Pembelian</h3>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <div class="modal-body">
                            <form action="{{ route('pembelian.update', $datapembelian->id) }}" method="post">
                              @csrf
                              @method('PUT')
                              <div class="form-group">
                                <label for="id_supplier">Nama Supplier <span class="text-danger">*</span></label>
                                <select class="form-control" id="id_supplier" name="id_supplier" required>
                                    <option value="" selected disabled>Pilih Supplier</option>
                                    @foreach($supplier as $id => $value)
                                        <option value="{{ $id }}" @if($datapembelian->id_supplier == $id) selected @endif>{{ $value }}</option>
                                    @endforeach
                                </select>
                              </div>
                              <div class="form-group">
                                <label for="diskon">Diskon</label>
                                <input type="text" id="diskon" name="diskon" class="form-control" value="{{ $datapembelian->diskon }}" placeholder="%" required>
                              </div>
                              <div class="row justify-content-center">
                                <div class="col text-center">
                                  <button type="submit" class="btn btn-success" onclick="return confirm('Konfirmasi edit pembelian?')">Confirm</button>
                                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                </div>
                              </div>
                            </form>
                          </div>
                        </div>
                      </div>
                    </div>

                    <!-- Modal Tambah Item -->
                    <div class="modal fade" id="tambahItemPembelian" tabindex="-1" role="dialog" aria-labelledby="tambahItemPembelianLabel" aria-hidden="true">
                      <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h3 class="mb-0 text-center">Tambah Item</h3>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <div class="modal-body">
                            <form action="{{ route('pembelian.tambah-item', $datapembelian->id) }}" method="post">
                              @csrf
                              <div class="form-group">
                                <label for="id_produk">Nama Produk <span class="text-danger">*</span></label>
                                <select class="form-control" id="id_produk" name="id_produk" required>
                                    <option value="" selected disabled>Pilih Produk</option>
                                    @foreach($produkbeli as $id => $value)
                                        <option value="{{ $id }}" @if(in_array($id, $cekProduk)) hidden disabled @endif>{{ $value }}</option>
                                    @endforeach
                                </select>
                              </div>
                              <div class="form-group">
                                <label for="qty">Jumlah Pembelian</label>
                                <input type="text" id="qty" name="qty" value="" placeholder="0" class="form-control" required>
                              </div>
                              <div class="row justify-content-center">
                                <div class="col text-center">
                                  <button type="submit" class="btn btn-success" onclick="return confirm('Konfirmasi pembelian?')">Confirm</button>
                                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                </div>
                              </div>
                            </form>
                          </div>
                        </div>
                      </div>
                    </div>

                    <div class="text-center mt-4">
                        <a href="{{ route('pembelian') }}" class="btn btn-secondary">Kembali</a>
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
      if (successMessage) {
          setTimeout(function() {
              successMessage.remove();
          }, 5000);
      }

      if(alertMessage){
        setTimeout(function(){
          alertMessage.remove();
        },5000);  
      }
  });
</script>
@endpush
