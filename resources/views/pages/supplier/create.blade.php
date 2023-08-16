@extends('layouts.app') 

@section('content') 
@php 
    $pageTitle = "Buat Supplier"; 
    $breadcrumbs = [ 
        ['label' => 'Supplier', 'url' => '#'], 
        // ['label' => 'Add', 'url' => '#'], 
    ]; 
    $activePage = "Create"; 
@endphp 

@include('layouts.headers.cards', compact('pageTitle', 'breadcrumbs', 'activePage'))

<br>

<div class="container-fluid mt--7">
    <div class="row" style="padding-top: 88px">
        <div class="col">
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
                    <div class="text-muted text-center mt-2 mb-3" style="font-weight: bold">Buat Supplier</div>
                </div>
                <div class="card-body">
                    <!-- User Registration Form -->
                    <form action="{{ route('supplier.store') }}" method="POST" id="registrationForm">
                        @csrf
                        <div class="form-group">
                            <label for="nama_supplier">Nama Supplier<span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="nama_supplier" name="nama_supplier" value="{{ old('nama_supplier') }}" required>
                        </div>
                        <div class="form-group">
                            <label for="alamat_supplier">Alamat Supplier<span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="alamat_supplier" name="alamat_supplier" value="{{ old('alamat_supplier') }}" required>
                        </div>
                        <div class="form-group">
                            <label for="telepon_supplier">Telepon Supplier<span class="text-danger">*</span></label>
                            <input type="tel" pattern="[0-9]*" class="form-control" id="telepon_supplier" name="telepon_supplier" maxlength="15" value="{{ old('telepon_supplier') }}" required>
                        </div>
                        <!-- Form Footer -->
                        <div class="text-center mt-4">
                            <button type="submit" class="btn btn-primary">Save</button>
                            <a href="{{ route('supplier') }}" class="btn btn-secondary">Cancel</a>
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
    const teleponSupplierField = document.getElementById('telepon_supplier');
    
    teleponSupplierField.addEventListener('input', function(event) {
        // Remove non-numeric characters from the input value
        this.value = this.value.replace(/\D/g, '');
    });

    document.getElementById('registrationForm').addEventListener('submit', function(event) {
        const teleponValue = teleponSupplierField.value;
        if (teleponValue !== '' && isNaN(teleponValue)) {
            event.preventDefault();
            alert('Telepon Supplier must contain only numeric characters.');
        }
    });
</script>
@endpush
@endsection
