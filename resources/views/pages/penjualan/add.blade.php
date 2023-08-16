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
            <div class="card shadow">
                <div class="card-header border-0">
                    <div class="text-muted text-center mt-2 mb-3" style="font-weight: bold">Buat Penjualan</div>
                </div>
                <div class="card-body">
                    <!-- User Registration Form -->
                    <form action="{{ route('register') }}" method="POST" id="penjualanForm">
                        @csrf
                        <div class="form-group">
                            <label for="idUser">ID User <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="idUser" name="idUser" required>
                        </div>
                        <div class="form-group">
                            <label for="idCustomer">ID Customer <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="idCustomer" name="idCustomer" required>
                        </div>
                        <div class="form-group">
                            <label for="idSalesman">ID Salesman <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="idSalesman" name="idSalesman" required>
                        </div>
                        <div class="form-group">
                            <label for="totalItem">Total Item <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="totalItem" name="totalItem" required>
                        </div>
                        <div class="form-group">
                            <label for="diskon">Diskon <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="diskon" name="diskon" required>
                        </div>
                        <div class="form-group">
                            <label for="subtotal">Subtotal <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="subtotal" name="subtotal" required>
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
