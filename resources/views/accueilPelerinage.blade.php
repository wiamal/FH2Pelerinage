@extends('dashboard.dashboard')
@section('styles')
    <link rel="stylesheet" href="{{ asset('css/pelerinage.css') }}">
@endsection

@section('content')
    @livewire('pelerinage.accueil')
@endsection
