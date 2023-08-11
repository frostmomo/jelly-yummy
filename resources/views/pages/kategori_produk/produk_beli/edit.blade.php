@extends('layouts.app') 

@section('content') 
@php 
    $pageTitle = "Edit Kategori Produk Beli"; 
    $breadcrumbs = [ 
        ['label' => 'Kategori Produk Beli', 'url' => '#'], 
        // ['label' => 'Add', 'url' => '#'], 
    ]; 
    $activePage = "Edit"; 
@endphp 

@include('layouts.headers.cards', compact('pageTitle', 'breadcrumbs', 'activePage'))

<br>

<div class="container-fluid mt--7">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card shadow">
                <div class="card-header border-0">
                    <div class="text-muted text-center mt-2 mb-3" style="font-weight: bold">Buat Kategori Beli</div>
                </div>
                <div class="card-body">
                    <form action="{{ route('produk-beli.create') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="deskripsi">Kategori Beli <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="deskripsi" name="deskripsi" required>
                                </div>
                            </div>
                        </div>

                        <!-- Form Footer -->
                        <div class="text-center mt-4">
                            <button type="submit" class="btn btn-primary">Save</button>
                            <a href="{{ route('produk-beli') }}" class="btn btn-secondary">Cancel</a>
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
        tanggalInput.addEventListener('change', function () {
            const date = new Date(this.value);
            const options = { month: 'short', day: 'numeric', year: 'numeric' };
            const formattedDate = date.toLocaleDateString('en-US', options);
            this.value = formattedDate;
        });
    </script>
@endpush
@endsection
