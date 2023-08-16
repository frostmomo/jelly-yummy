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
                            <a href="{{ route('produk-jual') }}" class="btn btn-secondary">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Add the necessary JavaScript to handle adding rows to the table -->
@push('js')
<script>
    // Format tanggal field in "month day, year" format (MDY)
    const tanggalInput = document.getElementById('tanggal');
    tanggalInput.addEventListener('change', function() {
        const date = new Date(this.value);
        const options = {
            month: 'short',
            day: 'numeric',
            year: 'numeric'
        };
        const formattedDate = date.toLocaleDateString('en-US', options);
        this.value = formattedDate;
    });
</script>
@endpush
@endsection