@extends('layouts.app') 

@section('content') 
@php 
    $pageTitle = "Buat Salesman"; 
    $breadcrumbs = [ 
        ['label' => 'Salesman', 'url' => '#'], 
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
                    <div class="text-muted text-center mt-2 mb-3" style="font-weight: bold">Buat Salesman</div>
                </div>
                <div class="card-body">
                    <!-- User Registration Form -->
                    <form action="{{ route('salesman.store') }}" method="POST" id="registrationForm">
                        @csrf
                        <div class="form-group">
                            <label for="nama_salesman">Nama Salesman<span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="nama_salesman" name="nama_salesman" value="{{ old('nama_salesman') }}" required>
                        </div>
                        <div class="form-group">
                            <label for="alamat_salesman">Alamat Salesman<span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="alamat_salesman" name="alamat_salesman" value="{{ old('alamat_salesman') }}" required>
                        </div>
                        <!-- Form Footer -->
                        <div class="text-center mt-4">
                            <button type="submit" class="btn btn-primary">Save</button>
                            <a href="{{ route('salesman') }}" class="btn btn-secondary">Cancel</a>
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
