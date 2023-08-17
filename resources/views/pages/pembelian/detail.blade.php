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
                    Detail Pembelian
                </div>
                <div class="card-body">
                    @foreach($pembelian as $datapembelian)
                        <div class="form-group">
                            <label for="user">Dibuat Oleh:</label>
                            <input type="text" class="form-control" value="{{ $datapembelian->name }}" readonly>
                        </div>
                        <div class="form-group">
                            <label for="id_supplier">Nama Supplier:</label>
                            <input type="text" class="form-control" value="{{ $datapembelian->nama_supplier }}" readonly>
                        </div>
                        <div class="form-group">
                            <label for="total_item">Total item:</label>
                            <input type="text" class="form-control" value="{{ $datapembelian->total_item }}" readonly>
                        </div>
                        <div class="form-group">
                            <label for="subtotal">Subtotal:</label>
                            <input type="text" class="form-control" value="{{ $datapembelian->subtotal }}" readonly>
                        </div>
                        <div class="form-group">
                            <label for="diskon">Diskon %:</label>
                            <input type="text" class="form-control" value="{{ $datapembelian->diskon }}%" readonly>
                        </div>
                        <div class="form-group">
                            <label for="bayar">Bayar:</label>
                            <input type="text" class="form-control" value="{{ $datapembelian->bayar }}" readonly>
                        </div>
                        <div class="form-group">
                            <label for="id_produk">Detail Pembelian:</label>
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
                                    @forelse($detailpembelian as $datadetail)
                                      <tr class="text-center">
                                        <td>{{ $datadetail->nama_produk_beli }}</td>
                                        <td>{{ $datadetail->kategori_beli }}</td>
                                        <td>{{ $datadetail->qty }}</td>
                                        <td>{{ $datadetail->total }}</td>
                                        <td class="text-center">
                                          <div class="btn-group" role="group">
                                            <a href="{{ route('pembelian.detail.edit', ['id' => $datadetail->id, 'idpembelian' => $datapembelian->id]) }}" class="btn btn-sm btn-outline-primary" onclick="editEntry()">
                                              <i class="ni ni-ruler-pencil mr-2"></i> Edit </button>
                                            </a>
                                            <button type="button" class="btn-sm btn-danger" data-toggle="modal" data-target="#returPenjualan">
                                              <i class="ni ni-fat-remove mr-2"></i> Retur </button>
                                            </button>
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
                    @endforeach
                    <div class="text-center mt-4">
                        <a href="{{ route('pembelian') }}" class="btn btn-secondary">Kembali</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
