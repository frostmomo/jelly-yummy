@extends('layouts.app') 
@section('content') 
@php 
    $pageTitle = "User"; 
    $breadcrumbs = [ 
        // ['label' => 'Home', 'url' => '#'], 
        // ['label' => 'Maps', 'url' => '#'], 
    ]; 
        $activePage = "User"; 

@endphp 
@include('layouts.headers.cards', compact('pageTitle', 'breadcrumbs', 'activePage'))
<br>
<div class="container-fluid mt--7">
    <div class="header-body">
        <!-- Card stats -->
        <div class="row">
          <div class="col-xl-10 col-lg-6">
          </div>
          <div class="col-xl-2 col-lg-6" style="padding-bottom: 20px">
            <a href="{{ route('user.create') }}" class="btn btn-primary btn-block">
              Buat User
            </a>
          </div>
      </div>
        </div>
      </div>
      <br>
      <div class="row">
        <div class="col">
          <div class="card shadow">
            <div class="card-header border-0">
              <div class="row align-items-center">
                <div class="col-10">
                  <h3 class="mb-0">User</h3>
                </div>
                <div class="col-2">
                  <form action="{{ route('home') }}" method="GET" class="form-inline">
                      <div class="input-group input-group-rounded input-group-merge">
                          <input type="search" name="query" class="form-control form-control-rounded" placeholder="Search">
                          <div class="input-group-prepend">
                              <button type="submit" class="input-group-text">
                                  <i class="fa fa-search"></i>
                              </button>
                          </div>
                      </div>
                  </form>
              </div>
              </div>
            </div>
            <div class="table-responsive">
              <table class="table align-items-center table-flush">
                <thead class="thead-light">
                  <tr>
                    <th scope="col">Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Role</th>
                    <th scope="col">Action</th>
                  </tr>
                </thead>
                <tbody>
                    {{-- For loop here --}}
                  <tr>
                    <td>Jajang Spakbor</td>
                    <td>jspro@mail.com</td>
                    <td>Developer</td>
                    <td class="text-center">
                      <div class="btn-group" role="group">
                          <button type="button" class="btn btn-sm btn-outline-primary" onclick="editEntry()">
                              <i class="ni ni-ruler-pencil mr-2"></i>
                              Edit
                          </button>
                          <button type="button" class="btn btn-sm btn-outline-danger" onclick="deleteEntry()">
                              <i class="ni ni-fat-remove mr-2"></i>
                              Delete
                          </button>
                      </div>
                  </td>
                  </tr>
                  <tr>
                    <td>Jajang Spakbor</td>
                    <td>jspro@mail.com</td>
                    <td>Developer</td>
                    <td class="text-center">
                      <div class="btn-group" role="group">
                          <button type="button" class="btn btn-sm btn-outline-primary" onclick="editEntry()">
                              <i class="ni ni-ruler-pencil mr-2"></i>
                              Edit
                          </button>
                          <button type="button" class="btn btn-sm btn-outline-danger" onclick="deleteEntry()">
                              <i class="ni ni-fat-remove mr-2"></i>
                              Delete
                          </button>
                      </div>
                  </td>
                  </tr>
                </tbody>
              </table>
            </div>
            <div class="card-footer py-4">
              <nav class="d-flex justify-content-end" aria-label="..."></nav>
            </div>
          </div>
        </div>
      </div>
      @include('layouts.footers.auth')
    </div>
@endsection

@push('js')
    <script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.min.js"></script>
    <script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.extension.js"></script>
@endpush