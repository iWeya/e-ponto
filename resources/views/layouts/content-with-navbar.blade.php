@extends('layouts.base')

@push('html-element-classes')
    has-background-light
@endpush

@push('css')
    <link rel="stylesheet" href="{{ asset('assets/css/e-ponto-bulma-theme/css/e-ponto-bulma-theme.css') }}">
@endpush

@section('content')
    @component('components.navbar')
        @slot('color', 'primary')
        @slot('fixedPosition', 'top')
    @endcomponent

    <div class="container">
        <section class="section">
            @yield('main-content')
        </section>
    </div>
@endsection