@extends('layouts.app')

@section('content')
@php
$pageTitle = "Edit Kategori Produk Jual";
$breadcrumbs = [
['label' => 'Kategori Produk Jual', 'url' => '#'],
// ['label' => 'Add', 'url' => '#'],
];
$activePage = "Edit";
@endphp

@include('layouts.headers.cards', compact('pageTitle', 'breadcrumbs', 'activePage'))
 
<br>

<div class="container-fluid mt--7">
    <div class="row" style="padding-top: 88px">
        <div class="col">
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
                    <div class="text-muted text-center mt-2 mb-3" style="font-weight: bold">Buat Kategori Jual</div>
                </div>
                <div class="card-body">
                    <form action="{{ route('kategori-jual.update', $kategorijual->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="kategori_jual">Kategori Jual <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="kategori_jual" name="kategori_jual" value="{{ $kategorijual->kategori_jual }}" required>
                                </div>
                            </div>
                        </div>

                        <!-- Form Footer -->
                        <div class="text-center mt-4">
                            <button type="submit" class="btn btn-primary">Save</button>
                            <a href="{{ route('kategori-jual') }}" class="btn btn-secondary">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
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