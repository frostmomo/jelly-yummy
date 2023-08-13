@extends('layouts.app') 

@section('content') 
@php 
    $pageTitle = "Edit User"; 
    $breadcrumbs = [ 
        ['label' => 'User', 'url' => '#'], 
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
                    <div class="text-muted text-center mt-2 mb-3" style="font-weight: bold">Edit User</div>
                </div>
                <div class="card-body">
                    <!-- User Registration Form -->
                    <form action="{{ route('user.update', $user->id) }}" method="post" id="registrationForm">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="name">Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="name" name="name" value="{{ $user->name }}" required>
                        </div>
                        <div class="form-group">
                            <label for="email">Email <span class="text-danger">*</span></label>
                            <input type="email" class="form-control" id="email" name="email" value="{{ $user->email }}" required>
                        </div>
                        <div class="form-group">
                            <label for="role">Role <span class="text-danger">*</span></label>
                            <select class="form-control" id="role" name="role" required>
                                <option value="" selected disabled>Pilih Role</option>
                                <option value="Admin Kas" @if($user->level == 'Admin Kas') selected @endif>Admin Kas</option>
                                <option value="Admin Penjualan" @if($user->level == 'Admin Penjualan') selected @endif>Admin Penjualan</option>
                            </select>
                        </div>
                        <!-- Form Footer -->
                        <div class="text-center mt-4">
                            <button type="submit" class="btn btn-primary">Save</button>
                            <a href="{{ route('user') }}" class="btn btn-secondary">Cancel</a>
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
