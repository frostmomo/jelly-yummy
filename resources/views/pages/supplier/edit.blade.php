@extends('layouts.app') 

@section('content') 
@php 
    $pageTitle = "Edit Supplier"; 
    $breadcrumbs = [ 
        ['label' => 'Supplier', 'url' => '#'], 
        // ['label' => 'Add', 'url' => '#'], 
    ]; 
    $activePage = "Edit"; 
@endphp 

@include('layouts.headers.cards', compact('pageTitle', 'breadcrumbs', 'activePage'))

<br>

<div class="container-fluid mt--7">
    <div class="row justify-content-center">
        <div class="col-lg-8">
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
                    <div class="text-muted text-center mt-2 mb-3" style="font-weight: bold">Edit Supplier</div>
                </div>
                <div class="card-body">
                    <!-- User Registration Form -->
                    <form action="{{ route('supplier.update', $supplier->id) }}" method="post" id="registrationForm">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="nama_supplier">Nama Supplier<span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="nama_supplier" name="nama_supplier" value="{{ $supplier->nama_supplier }}" required>
                        </div>
                        <div class="form-group">
                            <label for="alamat_supplier">Alamat Supplier <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="alamat_supplier" name="alamat_supplier" value="{{ $supplier->alamat_supplier }}" required>
                        </div>
                        <div class="form-group">
                            <label for="telepon_supplier">Telepon Supplier <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="telepon_supplier" name="telepon_supplier" max="15" value="{{ $supplier->telepon_supplier }}" required>
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
