@extends('layout.admin')

@section('title', 'Admin Dashboard')

@section('content')
    <div class="flex items-center gap-3">
        <div class="card-modify text-primary w-max space-y-2">
            <div class="flex items-center gap-3">
                <img width="24" src="{{ asset('/assets/icon/student.svg') }}" alt="student-icon">
                <p class="font-extrabold text-3xl">{{ $data['active_student'] }}</p>
            </div>
            <p>Active Students</p>
        </div>
        <div class="card-modify text-primary w-max space-y-2">
            <div class="flex items-center gap-3">
                <img width="24" src="{{ asset('/assets/icon/assignment-dark.png') }}" alt="assignment-dark-icon">
                <p class="font-extrabold text-3xl">{{ $data['new_assignment'] }}</p>
            </div>
            <p>New Assignments</p>
        </div>
        <div class="card-modify text-primary w-max space-y-2">
            <div class="flex items-center gap-3">
                <img width="24" src="{{ asset('/assets/icon/payment-dark.png') }}" alt="payment-dark-icon">
                <p class="font-extrabold text-3xl">{{ $data['payment'] }}</p>
            </div>
            <p>New Payment</p>
        </div>
    </div>

    <div class="my-5">
        <div class="flex items-center justify-between">
            <h5 class="page-title">Schedule</h5>
            <a class="font-medium text-primary" href="/admin/schedule">View All</a>
        </div>
        <div class="flex items-center gap-3">
            @foreach ($data['schedule'] as $schedule)
                <div class="card-modify w-max space-y-2">
                    <img width="362" src="{{ asset('/assets/schedule/' . $schedule['jadwal']) }}" alt="schedule-image">
                    <p class="font-bold text-lg text-primary">Schedule <span
                            class="uppercase">{{ $schedule['nama'] }}</span></p>
                </div>
            @endforeach
        </div>
    </div>

    <div>
        <h5 class="page-title">Your Students</h5>
        @if ($data['students']->count() > 0)
            <div class="relative overflow-x-auto w-max max-w-full sm:rounded-lg">
                <table class="text-sm text-left rtl:text-center text-gray-500">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-200">
                        <tr>
                            <th scope="col" class="px-6 py-3">NO</th>
                            <th scope="col" class="px-6 py-3">NAME</th>
                            <th scope="col" class="px-6 py-3">USERNAME</th>
                            <th scope="col" class="px-6 py-3">JENJANG</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data['students'] as $student)
                            <tr class="font-medium">
                                <td scope="col" class="px-6 py-3">{{ $i++ }}</td>
                                <td scope="col" class="px-6 py-3">{{ $student->username }}</td>
                                <td scope="col" class="px-6 py-3">{{ $student->fullname }}</td>
                                <td scope="col" class="px-6 py-3">{{ $student->tingkatan['nama'] }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <h1>Tidak ada pelajar</h1>
        @endif
    </div>
@endsection
