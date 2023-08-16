@extends('layouts.app') 

@section('content') 
@php 
    $pageTitle = "Buat Penjualan"; 
    $breadcrumbs = [ 
        ['label' => 'Penjualan', 'url' => '#'], 
        // ['label' => 'Add', 'url' => '#'], 
    ]; 
    $activePage = "Add"; 
@endphp 

@include('layouts.headers.cards', compact('pageTitle', 'breadcrumbs', 'activePage'))

<br>

<div class="container-fluid mt--7">
    <div class="row" style="padding-top: 88px">
        <div class="col">
            @if ($message = Session::get('failed'))
                <div class="alert alert-danger">
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

            <div class="card shadow">
                <div class="card-header border-0">
                    <div class="text-muted text-center mt-2 mb-3" style="font-weight: bold">Buat Penjualan</div>
                </div>
                <div class="card-body">
                    <!-- User Registration Form -->
                    <form action="{{ route('penjualan.store') }}" method="POST" id="penjualanForm">
                        @csrf
                        <div class="form-group">
                            <label for="id_customer">Nama Customer <span class="text-danger">*</span></label>
                            <select class="form-control" id="id_customer" name="id_customer" required>
                                <option value="" selected disabled>Pilih Customer</option>
                                @foreach($customer as $id => $value)
                                    <option value="{{ $id }}">{{ $value }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="id_salesman">Nama Salesman <span class="text-danger">*</span></label>
                            <select class="form-control" id="id_salesman" name="id_salesman" required>
                                <option value="" selected disabled>Pilih Salesman</option>
                                @foreach($salesman as $id => $value)
                                    <option value="{{ $id }}">{{ $value }}</option>
                                @endforeach
                            </select>
                        </div>
                        @php $i = 1 @endphp
                        @foreach($produkjual as $dataprodukjual)
                        <div class="form-group">
                            <label for="id_salesman">Produk Jual {{ $i }}</span></label>
                                <div class="card">
                                    <div class="table-responsive">
                                        <table class="table align-items-center table-flush">
                                            <thead class="thead-light">
                                                <tr class="text-center">
                                                <th scope="col">Nama Produk Jual</th>
                                                <th scope="col">Kode Produk Jual</th>
                                                <th scope="col">Harga Produksi</th>
                                                <th scope="col">Harga Jual</th>
                                                <th scope="col">Stok</th>
                                                </tr>
                                            </thead>
                                            <tbody class="list">
                                                <tr class="text-center">
                                                    <td>{{ $dataprodukjual->nama_produk_jual }}</td>
                                                    <td>{{ $dataprodukjual->kode_produk_jual }}</td>
                                                    <td>{{ $dataprodukjual->harga_produksi}}</td>
                                                    <td>{{ $dataprodukjual->harga_jual}}</td>
                                                    <td>{{ $dataprodukjual->stok}}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <label for="qty_{{ $i }}" class="mt-2">Jumlah Item {{ $i }} (Kosongkan jika tidak ada item dijual)</span></label>
                                <input type="text" class="form-control mb-2" id="qty_{{ $i }}" name="qty_{{ $i }}" placeholder="0">
                            <div class="form-group">
                                <label for="id_produk_{{ $i }}" hidden>ID Produk <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="id_produk_{{ $i }}" name="id_produk_{{ $i }}" value="{{ $dataprodukjual->id }}" hidden>
                            </div>
                            @php $i++ @endphp
                        @endforeach
                        </div>
                        <div class="form-group">
                            <label for="diskon">Diskon % <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="diskon" name="diskon" placeholder="Masukkan hanya angka">
                        </div>
                        <div class="form-group">
                            <label for="tunai">Tunai?<span class="text-danger">*</span></label>
                            <select class="form-control" id="tunai" name="tunai" required>
                                <option value="" selected disabled>Pilih Transaksi</option>
                                <option value="1">Ya</option>
                                <option value="0">Tidak</option>
                            </select>
                        </div>
                        <!-- Form Footer -->
                        <div class="text-center mt-4">
                            <button type="submit" class="btn btn-primary">Save</button>
                            <a href="{{ route('penjualan') }}" class="btn btn-secondary">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Add the necessary JavaScript to handle password mismatch -->
@push('js')
    <script>
        const passwordField = document.getElementById('password');
        const confirmPasswordField = document.getElementById('password_confirmation');
        const passwordMismatchWarning = document.getElementById('passwordMismatch');

        confirmPasswordField.addEventListener('keyup', function() {
            if (passwordField.value !== confirmPasswordField.value) {
                passwordMismatchWarning.classList.remove('d-none');
            } else {
                passwordMismatchWarning.classList.add('d-none');
            }
        });

        document.getElementById('registrationForm').addEventListener('submit', function(event) {
            if (passwordField.value !== confirmPasswordField.value) {
                event.preventDefault();
                passwordMismatchWarning.classList.remove('d-none');
            }
        });
    </script>
@endpush
@endsection
