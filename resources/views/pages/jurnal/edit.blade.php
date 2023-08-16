@extends('layouts.app') 

@section('content') 
@php 
    $pageTitle = "Edit Jurnal"; 
    $breadcrumbs = [ 
        ['label' => 'Jurnal', 'url' => '#'], 
        // ['label' => 'Add', 'url' => '#'], 
    ]; 
    $activePage = "Edit"; 
@endphp 

@include('layouts.headers.cards', compact('pageTitle', 'breadcrumbs', 'activePage'))

<div class="container-fluid mt--7" style="padding-top: 50px">
    <div class="row" style="padding-top: 88px">
        <div class="col">
            <div class="card shadow">
                <div class="card-header border-0">
                    <div class="text-muted text-center mt-2 mb-3" style="font-weight: bold">Buat Cash</div>
                </div>
                <div class="card-body">
                    <form action="{{ route('jurnal.edit') }}" method="UPDATE">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="deskripsi">Deskripsi <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="deskripsi" name="deskripsi" required>
                                </div>
                                <div class="form-group">
                                    <label for="jenis">Jenis <span class="text-danger">*</span></label>
                                    <select class="form-control" id="jenis" name="jenis" required>
                                        <option value="Pemasukan">Pemasukan</option>
                                        <option value="Pengeluaran">Pengeluaran</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="nominal">Nominal <span class="text-danger">*</span></label>
                                    <input type="number" class="form-control" id="nominal" name="nominal" required>
                                </div>
                                <div class="form-group">
                                    <label for="tanggal">Tanggal <span class="text-danger">*</span></label>
                                    <input type="date" class="form-control" id="tanggal" name="tanggal" required>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="detail">DETAIL</label>
                            <table class="table" id="detail">
                                <thead>
                                    <tr>
                                        <th>Item</th>
                                        <th>Harga</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- Rows will be added dynamically using JavaScript -->
                                </tbody>
                            </table>
                        </div>
                        <button type="button" class="btn btn-primary" id="tambahData">Tambah Data</button>
                    
                        <!-- Form Footer -->
                        <div class="text-center mt-4">
                            <button type="submit" class="btn btn-primary">Save</button>
                            <a href="{{ route('jurnal') }}" class="btn btn-secondary">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@push('js')
    <script>
        document.getElementById('tambahData').addEventListener('click', function() {
            var tableBody = document.querySelector('#detail tbody');
            var newRow = document.createElement('tr');
            newRow.innerHTML = `
                <td><input type="text" class="form-control" name="item[]"></td>
                <td><input type="number" class="form-control" name="harga[]"></td>
                <td><button type="button" class="btn btn-danger btn-sm hapusData">Hapus</button></td>
            `;
            tableBody.appendChild(newRow);
        });

        // Handle removing rows
        document.addEventListener('click', function(e) {
            if (e.target.classList.contains('hapusData')) {
                e.target.closest('tr').remove();
            }
        });

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
