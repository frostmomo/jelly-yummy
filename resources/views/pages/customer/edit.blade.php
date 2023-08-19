@extends('layouts.app') 

@section('content') 
@php 
    $pageTitle = "Edit Customer"; 
    $breadcrumbs = [ 
        ['label' => 'Customer', 'url' => '#'], 
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
                <div class="alert alert-danger" id="alert-message">
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div><br>
            @endif
            <div class="card shadow">
                <div class="card-header border-0">
                    <div class="text-muted text-center mt-2 mb-3" style="font-weight: bold">Edit Customer</div>
                </div>
                <div class="card-body">
                    <!-- User Registration Form -->
                    <form action="{{ route('customer.update', $customer->id) }}" method="post" id="registrationForm">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="nama_customer">Nama customer<span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="nama_customer" name="nama_customer" value="{{ $customer->nama_customer }}" required>
                        </div>
                        <div class="form-group">
                            <label for="alamat_customer">Alamat customer <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="alamat_customer" name="alamat_customer" value="{{ $customer->alamat_customer }}" required>
                        </div>
                        <div class="form-group">
                            <label for="telepon_customer">Telepon customer <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="telepon_customer" name="telepon_customer" max="15" value="{{ $customer->telepon_customer }}" required>
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
    document.addEventListener("DOMContentLoaded", function() {
        var alertMessage = document.getElementById("alert-message");
  
        if (alertMessage) {
            setTimeout(function() {
                alertMessage.remove();
            }, 5000);
        }
    });
  </script>
@endpush
@endsection
