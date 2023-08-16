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
                        <div class="form-group">
                            <label for="tunai">Piutang:</label>
                            <input type="text" class="form-control" value="{{ $datapenjualan->bayar }}" readonly>
                        </div>
                    @endforeach
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
                                        <a href="{{ route('penjualan.detail.edit', $datadetail->id) }}" class="btn btn-sm btn-outline-primary" onclick="editEntry()">
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
                    </div>
                    <div class="text-center mt-4">
                        <a href="{{ route('penjualan') }}" class="btn btn-secondary">Kembali</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
