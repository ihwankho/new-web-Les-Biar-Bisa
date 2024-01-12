@extends('layout.app')

@section('title', 'Dashboard')

@section('content')
    <div class="pt-7">
        <h5 class="page-title">Your Course</h5>
        <p class="font-semibold bg-primary p-3 mt-2 rounded-lg text-base flex items-center gap-3 text-white w-max"><span
                class="font-extrabold text-lg">{{ $course }}</span>
            Now
            available for
            you</p>
    </div>
    <div class="pt-7">
        <h5 class="page-title">Your Assignment</h5>
        <div class="flex gap-5 items-center">
            <div class="w-max p-3 mt-2 bg-primary shadow-lg text-white rounded-lg">
                <p class="font-extrabold text-lg">{{ $assignment['notdone'] }}</p>
                <p class="font-semibold text-xs opacity-30">Not Done</p>
            </div>
            <div class="w-max p-3 mt-2 shadow-lg rounded-lg">
                <p class="font-extrabold text-lg">{{ $assignment['done'] }}</p>
                <p class="font-semibold text-xs opacity-30">Done</p>
            </div>
            <div class="w-max p-3 mt-2 shadow-lg rounded-lg">
                <p class="font-extrabold text-lg">{{ $assignment['late'] }}</p>
                <p class="font-semibold text-xs opacity-30">Working Late</p>
            </div>
            <div class="w-max p-3 mt-2 shadow-lg rounded-lg">
                <p class="font-extrabold text-lg">{{ $assignment['misseddeadline'] }}</p>
                <p class="font-semibold text-xs opacity-30">Missed Deadline</p>
            </div>
        </div>
    </div>
    <div class="pt-7">
        <h5 class="page-title">Your course schedule</h5>
        <div class="w-max max-w-lg p-3 bg-primary rounded-lg mt-3">
            <img src="{{ $schedule['jadwal'] }}" alt="Schedule">
        </div>
    </div>
@endsection
