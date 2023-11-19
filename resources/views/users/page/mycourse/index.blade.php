@extends('layout.app')

@section('title', 'My Course')

@section('content')
    <h1 class="page-title">Your Course</h1>
    <div>
        @if ($courses->count() > 0)
            @foreach ($courses as $course)
                <a href="{{ route('mycourse.show', ['mycourse' => $course->id]) }}" class="card block">
                    <img class="card-thumbnail" src="{{ asset('/assets/course/thumbnail1.jpg') }}" alt="Thumbnail-Course">
                    <h3 class="card-title">{{ $course->nama }}</h3>
                    <p class="text-xs bg-primary p-2 rounded-md w-max text-white font-semibold">{{ $file_courses }} Materi |
                        {{ $assignments }} Assignments</p>
                </a>
            @endforeach
        @else
            <h1 class="font-bold text-xl text-primary">Data is empty...</h1>
        @endif
    </div>
@endsection
