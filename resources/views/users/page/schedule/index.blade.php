@extends('layout.app')

@section('title', 'Schedule')

@section('content')
    <h5 class="page-title">Your course schedule - {{ $schedule->nama }}</h5>
    <div class="w-1/2 p-3 bg-primary rounded-lg mt-3">
        <img src="{{ asset('/assets/schedule/' . $schedule->jadwal) }}" alt="Schedule">
    </div>
@endsection
