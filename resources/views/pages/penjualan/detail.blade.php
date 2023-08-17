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
                <div class="alert alert-danger">
                    <p>{{ $message }}</p>
                </div>
            @endif

            @if ($message = Session::get('success'))
                <div class="alert alert-success">
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
                            <label for="user">Dibuat Oleh:</label>
                            <input type="text" class="form-control" value="{{ $datapenjualan->name }}" readonly>
                        </div>
                        <div class="form-group">
                            <label for="id_customer">Nama Customer:</label>
                            <input type="text" class="form-control" value="{{ $datapenjualan->nama_customer }}" readonly>
                        </div>
                        <div class="form-group">
                            <label for="id_salesman">Nama Salesman:</label>
                            <input type="text" class="form-control" value="{{ $datapenjualan->nama_salesman }}" readonly>
                        </div>
                        <div class="form-group">
                            <label for="diskon">Diskon %:</label>
                            <input type="text" class="form-control" value="{{ $datapenjualan->diskon }}%" readonly>
                        </div>
                        @forelse($piutang as $datapiutang)
                          <div class="form-group">
                              <label for="tunai">Piutang:</label>
                              <input type="text" class="form-control" value="Rp. {{ $datapiutang->bayar }}" readonly>
                          </div>
                          @if($datapiutang->bayar != 0)
                              <div class="form-group">
                                  <button type="button" class="btn btn-success" data-toggle="modal" data-target="#bayarPiutang">
                                    + Pembayaran Piutang
                                  </button>
                              </div>
                          @endif
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
                              <input type="text" class="form-control" value="0" readonly>
                          </div>
                        @endforelse
                        <div class="form-group">
                            <label for="id_produk">Detail Penjualan:</label>
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
                                    @forelse($detailpenjualan as $datadetail)
                                      <tr class="text-center">
                                        <td>{{ $datadetail->nama_produk_jual }}</td>
                                        <td>{{ $datadetail->kategori_jual }}</td>
                                        <td>{{ $datadetail->qty }}</td>
                                        <td>{{ $datadetail->total }}</td>
                                        <td class="text-center">
                                          <div class="btn-group" role="group">
                                            <a href="{{ route('penjualan.detail.edit', ['id' => $datadetail->id, 'idpenjualan' => $datapenjualan->id]) }}" class="btn btn-sm btn-outline-primary" onclick="editEntry()">
                                              <i class="ni ni-ruler-pencil mr-2"></i> Edit </button>
                                            </a>
                                            <button type="button" class="btn-sm btn-danger" data-toggle="modal" data-target="#returPenjualan">
                                              <i class="ni ni-fat-remove mr-2"></i> Retur </button>
                                            </button>
                                          </div>
                                        </td>
                                      </tr>
                                      <<!-- Modal Retur Penjualan -->
                                      <div class="modal fade" id="returPenjualan" tabindex="-1" role="dialog" aria-labelledby="returPenjualanLabel" aria-hidden="true">
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
