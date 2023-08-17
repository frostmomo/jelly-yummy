@extends('layouts.app') 
@section('content') 
@php 
    $pageTitle = "Supplier"; 
    $breadcrumbs = [ 
        ['label' => 'Home', 'url' => '#'], 
    ]; 
        $activePage = "Supplier"; 

@endphp 
@include('layouts.headers.cards', compact('pageTitle', 'breadcrumbs', 'activePage'))
<br>
<div class="container-fluid mt--7">
    <div class="header-body">
        <!-- Card stats -->
        <div class="row">
          <div class="col-xl-12 col-lg-6" style="padding-bottom: 20px">
            <div class="d-flex justify-content-end">
              <a href="{{ route('supplier.create') }}" class="btn btn-primary">Tambah Supplier</i></a>
            </div>
          </div>
        </div>
      </div>
      <br>
      @if ($message = Session::get('success'))
          <div class="alert alert-success">
            <p>{{ $message }}</p>
          </div>
      @endif
      <div class="row">
        <div class="col">
          <div class="card shadow">
            <div class="card-header border-0">
              <div class="row align-items-center">
                <div class="col-10">
                  <h3 class="mb-0">Supplier</h3>
                </div>
              </div>
            </div>
            <div class="table-responsive">
              <table class="table align-items-center table-flush">
                <thead class="thead-light">
                  <tr class="text-center">
                    <th scope="col">Nama Supplier</th>
                    <th scope="col">Alamat Supplier</th>
                    <th scope="col">Telepon Supplier</th>
                    <th scope="col">Action</th>
                  </tr>
                </thead>
                <tbody>
                    {{-- For loop here --}}
                  @forelse ($supplier as $data)
                    <tr>
                      <td>{{ $data->nama_supplier }}</td>
                      <td>{{ $data->alamat_supplier }}</td>
                      <td>{{ $data->telepon_supplier }}</td>
                      <td class="text-center">
                        <div class="btn-group" role="group">
                            <a href="{{ route('supplier.edit', $data->id) }}" class="btn btn-sm btn-outline-primary" onclick="editEntry()">
                                <i class="ni ni-ruler-pencil mr-2"></i>
                                Edit
                            </a>
                            <a href="{{ route('supplier.delete', $data->id) }}" class="btn btn-sm btn-outline-danger" onclick="return confirm('Hapus data supplier ini?');">
                                <i class="ni ni-fat-remove mr-2"></i>
                                Delete
                            </a>
                        </div>
                      </td>
                    </tr>
                  @empty
                    <tr>
                      <td colspan="4" class="text-center">Tidak ada data</td>
                    </tr>
                  @endforelse
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
@endsection

@push('js')
    <script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.min.js"></script>
    <script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.extension.js"></script>
@endpush