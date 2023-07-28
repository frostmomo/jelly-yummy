@extends('layouts.app')

@section('content')
@php
    $pageTitle = "Dashboard";
    $breadcrumbs = [
        ['label' => 'Home', 'url' => '#'],
    ];
    $activePage = "Dashboard";
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
                        <div class="chart">
                            {{-- Do something here --}}
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
@endpush