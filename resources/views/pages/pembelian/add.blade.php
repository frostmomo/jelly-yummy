@extends('layouts.app') 

@section('content') 
@php 
    $pageTitle = "Buat Pembelian"; 
    $breadcrumbs = [ 
        ['label' => 'Pembelian', 'url' => '#'], 
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
                    <div class="text-muted text-center mt-2 mb-3" style="font-weight: bold">Buat Pembelian</div>
                </div>
                <div class="card-body">
                    <!-- User Registration Form -->
                    <form action="{{ route('pembelian.store') }}" method="POST" id="pembelianForm">
                        @csrf
                        <div class="form-group">
                            <label for="id_supplier">Nama Supplier <span class="text-danger">*</span></label>
                            <select class="form-control" id="id_supplier" name="id_supplier" required>
                                <option value="" selected disabled>Pilih Supplier</option>
                                @foreach($supplier as $id => $value)
                                    <option value="{{ $id }}">{{ $value }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="produk_beli">Produk Beli <span class="text-danger">*</span></label>
                            <select class="form-control" id="produk_beli" name="produk_beli" required>
                                <option value="" selected disabled>Pilih Produk Beli</option>
                                @foreach($produkbeli as $dataprodukbeli)
                                    <option value="{{ $dataprodukbeli->id }}">{{ $dataprodukbeli->nama_produk_beli }} ({{ $dataprodukbeli->kategori_beli }})</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="qty">Jumlah <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="qty" name="qty" placeholder="Masukkan hanya angka">
                        </div>
                        <div class="form-group">
                            <label for="diskon">Diskon % <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="diskon" name="diskon" placeholder="Masukkan hanya angka">
                        </div>
                        <div class="text-center mt-4">
                            <button type="submit" class="btn btn-primary">Save</button>
                            <a href="{{ route('pembelian') }}" class="btn btn-secondary">Cancel</a>
                        </div>
                        {{-- @php $i = 1 @endphp
                        @foreach($produkbeli as $dataprodukbeli)
                        <div class="form-group">
                            <label for="id_salesman">Produk beli {{ $i }}</span></label>
                                <div class="card">
                                    <div class="table-responsive">
                                        <table class="table align-items-center table-flush">
                                            <thead class="thead-light">
                                                <tr class="text-center">
                                                <th scope="col">Nama Produk Beli</th>
                                                <th scope="col">Kategori Produk Beli</th>
                                                <th scope="col">Kode Produk Beli</th>
                                                <th scope="col">Harga Beli</th>
                                                <th scope="col">Stok Dimiliki</th>
                                                </tr>
                                            </thead>
                                            <tbody class="list">
                                                <tr class="text-center">
                                                    <td>{{ $dataprodukbeli->nama_produk_beli }}</td>
                                                    <td>{{ $dataprodukbeli->kategori_beli }}</td>
                                                    <td>{{ $dataprodukbeli->kode_produk_beli }}</td>
                                                    <td>{{ $dataprodukbeli->harga_beli}}</td>
                                                    <td>{{ $dataprodukbeli->stok}}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <label for="qty[]" class="mt-2">Jumlah Item {{ $i }} (Kosongkan jika tidak ada item dibeli)</span></label>
                                <input type="text" class="form-control mb-2" id="qty[]" name="qty[]" placeholder="0">
                            <div class="form-group">
                                <label for="id_produk[]" hidden>ID Produk <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="id_produk[]" name="id_produk[]" value="{{ $dataprodukbeli->id }}" hidden>
                            </div>
                            @php $i++ @endphp
                        @endforeach --}}
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
