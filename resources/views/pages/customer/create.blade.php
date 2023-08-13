@extends('layouts.app') 

@section('content') 
@php 
    $pageTitle = "Buat Customer"; 
    $breadcrumbs = [ 
        ['label' => 'Customer', 'url' => '#'], 
        // ['label' => 'Add', 'url' => '#'], 
    ]; 
    $activePage = "Create"; 
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
                    <div class="text-muted text-center mt-2 mb-3" style="font-weight: bold">Buat Customer</div>
                </div>
                <div class="card-body">
                    <!-- User Registration Form -->
                    <form action="{{ route('customer.store') }}" method="POST" id="registrationForm">
                        @csrf
                        <div class="form-group">
                            <label for="nama_customer">Nama Customer<span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="nama_customer" name="nama_customer" value="{{ old('nama_customer') }}" required>
                        </div>
                        <div class="form-group">
                            <label for="alamat_customer">Alamat Customer<span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="alamat_customer" name="alamat_customer" value="{{ old('alamat_customer') }}" required>
                        </div>
                        <div class="form-group">
                            <label for="telepon_customer">Telepon Customer<span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="telepon_customer" name="telepon_customer" maxlength="15" value="{{ old('telepon_customer') }}" required>
                        </div>
                        <!-- Form Footer -->
                        <div class="text-center mt-4">
                            <button type="submit" class="btn btn-primary">Save</button>
                            <a href="{{ route('customer') }}" class="btn btn-secondary">Cancel</a>
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
