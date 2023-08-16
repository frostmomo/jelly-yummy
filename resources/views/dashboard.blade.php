@extends('layouts.app')

@section('content')
@php
    $pageTitle = "Dashboard";
    $breadcrumbs = [
        ['label' => 'Home', 'url' => '#'],
    ];
    $activePage = "Dashboard";  
    $totalPemasukan = 350897; 
    $totalPengeluaran = 2356; 
    $saldoKas = 924;
@endphp
    @include('layouts.headers.cards', compact('pageTitle', 'breadcrumbs', 'activePage'))
    <br>
    
    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col-xl-12">
                <div class="card shadow">
                    <div class="card-header bg-transparent">
                        <div class="row align-items-center">
                            <div class="col">
                                <br>
                                <h2 class="mb-0">Selamat Datang, {{ auth()->user()->name }}</h2>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        {{-- Do something / charts etc --}}
                        <div class="row">
                            <div class="col-xl-4 col-lg-6">
                              <div class="card card-stats mb-4 mb-xl-0">
                                <div class="card-body">
                                  <div class="row">
                                    <div class="col">
                                      <h5 class="card-title text-uppercase text-muted mb-0">Total Pemasukan</h5>
                                      <span class="h2 font-weight-bold mb-0">{{ $totalPemasukan }}</span>
                                    </div>
                                    <div class="col-auto">
                                      <div class="icon icon-shape bg-success text-white rounded-circle shadow">
                                        <i class="fas fa-money-bill-wave"></i>
                                      </div>
                                    </div>
                                  </div>
                                  <p class="mt-3 mb-0 text-muted text-sm">
                                    <span class="text-success mr-2">
                                      <i class="fa fa-arrow-up"></i> 3.48% </span>
                                    <span class="text-nowrap">Since last month</span>
                                  </p>
                                </div>
                              </div>
                            </div>
                            <div class="col-xl-4 col-lg-6">
                              <div class="card card-stats mb-4 mb-xl-0">
                                <div class="card-body">
                                  <div class="row">
                                    <div class="col">
                                      <h5 class="card-title text-uppercase text-muted mb-0">Total Pengeluaran</h5>
                                      <span class="h2 font-weight-bold mb-0">{{ $totalPengeluaran }}</span>
                                    </div>
                                    <div class="col-auto">
                                      <div class="icon icon-shape bg-danger text-white rounded-circle shadow">
                                        <i class="fas fa-shopping-cart"></i>
                                      </div>
                                    </div>
                                  </div>
                                  <p class="mt-3 mb-0 text-muted text-sm">
                                    <span class="text-danger mr-2">
                                      <i class="fas fa-arrow-down"></i> 3.48% </span>
                                    <span class="text-nowrap">Since last week</span>
                                  </p>
                                </div>
                              </div>
                            </div>
                            <div class="col-xl-4 col-lg-6">
                              <div class="card card-stats mb-4 mb-xl-0">
                                <div class="card-body">
                                  <div class="row">
                                    <div class="col">
                                      <h5 class="card-title text-uppercase text-muted mb-0">Saldo Kas</h5>
                                      <span class="h2 font-weight-bold mb-0">{{ $saldoKas }}</span>
                                    </div>
                                    <div class="col-auto">
                                      <div class="icon icon-shape bg-warning text-white rounded-circle shadow">
                                        <i class="fas fa-money-bill"></i>
                                      </div>
                                    </div>
                                  </div>
                                  <p class="mt-3 mb-0 text-muted text-sm">
                                    <span class="text-warning mr-2">
                                      <i class="fas fa-arrow-down"></i> 1.10% </span>
                                    <span class="text-nowrap">Since yesterday</span>
                                  </p>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                        </div>
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
    
    <script>
        // Initialize and configure the first chart
        var ctx1 = document.getElementById('chart-sales-light-1').getContext('2d');
        var chart1 = new Chart(ctx1, {
            type: 'bar', // Change to the desired chart type
            data: {
                // Add your chart data here
            },
            options: {
                // Configure chart options
            }
        });
        
        // Initialize and configure the second chart
        var ctx2 = document.getElementById('chart-sales-light-2').getContext('2d');
        var chart2 = new Chart(ctx2, {
            type: 'line', // Change to the desired chart type
            data: {
                // Add your chart data here
            },
            options: {
                // Configure chart options
            }
        });
        
        // Initialize and configure the third chart
        var ctx3 = document.getElementById('chart-sales-light-3').getContext('2d');
        var chart3 = new Chart(ctx3, {
            type: 'pie', // Change to the desired chart type
            data: {
                // Add your chart data here
            },
            options: {
                // Configure chart options
            }
        });
    </script>
@endpush
