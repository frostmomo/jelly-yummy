@extends('layouts.app', ['class' => 'bg-default'])

@section('content') 
    <div class="header bg-gradient-warning py-7 py-lg-8">
        <div class="container">
            <div class="header-body text-center mt-7 mb-7">
                <div class="row justify-content-center">
                    <div class="col-lg-5 col-md-6">
                        <a class="navbar-brand" href="{{ route('home') }}">
                            <img src="{{ asset('argon') }}/img/brand/trb.png" />
                        </a>
                        <h1 class="text-white">{{ __('Teh Jelly Yummy') }}</h1>
                    </div>
                </div>
            </div>
        </div>
        <div class="separator separator-bottom separator-skew zindex-100">
            <svg x="0" y="0" viewBox="0 0 2560 100" preserveAspectRatio="none" version="1.1" xmlns="http://www.w3.org/2000/svg">
            </svg>
        </div>
    </div>

    <div class="container mt--10 pb-5"></div>
@endsection
