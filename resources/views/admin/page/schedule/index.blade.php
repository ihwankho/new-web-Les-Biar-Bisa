@extends('layout.admin')

@section('title', 'Admin Schedule')

@section('content')
    <p class="page-title">Schedule Sekolah Dasar</p>
    <div class="flex gap-3 items-center">
        <div class="card-modify w-max mb-3">
            <img width="426" src="{{ asset('/assets/schedule/schedule1.jpeg') }}" alt="schedule-sd">
        </div>
        <div class="space-y-3">
            <span class="p-2 text-xs font-semibold bg-orange-500 flex gap-2 w-max text-white rounded-md"><img
                    src="{{ asset('/assets/icon/exchange.svg') }}" alt="exchange-icon">
                Change</span>
            <span class="p-2 text-xs font-semibold bg-rose-500 flex gap-2 w-max text-white rounded-md"><img
                    src="{{ asset('/assets/icon/remove.svg') }}" alt="remove-icon"> Remove</span>
        </div>
    </div>
    <p class="page-title">Schedule Sekolah Menengah Pertama</p>
    <a href="#" class="btn mb-3 inline-block">+ Add Schedule Image</a>
    <p class="page-title">Schedule Sekolah Menengah Atas</p>
    <div class="flex gap-3 items-center">
        <div class="card-modify w-max mb-3">
            <img width="426" src="{{ asset('/assets/schedule/schedule1.jpeg') }}" alt="schedule-sd">
        </div>
        <div class="space-y-3">
            <span class="p-2 text-xs font-semibold bg-orange-500 flex gap-2 w-max text-white rounded-md"><img
                    src="{{ asset('/assets/icon/exchange.svg') }}" alt="exchange-icon">
                Change</span>
            <span class="p-2 text-xs font-semibold bg-rose-500 flex gap-2 w-max text-white rounded-md"><img
                    src="{{ asset('/assets/icon/remove.svg') }}" alt="remove-icon"> Remove</span>
        </div>
    </div>
@endsection
