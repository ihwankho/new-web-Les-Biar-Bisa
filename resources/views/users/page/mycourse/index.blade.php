@extends('layout.app')

@section('title', 'My Course')

@section('content')
    <h1 class="page-title">Your Course</h1>
    <div class="flex items-start gap-3">
        @if ($courses->count() > 0)
            @foreach ($courses as $course)
                <a href="{{ route('mycourse.show', ['mycourse' => $course->id]) }}" class="card block">
                    <img class="card-thumbnail" src="{{ asset('/assets/course/' . $course->thumbnail) }}"
                        alt="Thumbnail-Course">
                    <h3 class="card-title">{{ $course->nama }}</h3>
                    <p class="text-xs bg-primary p-2 rounded-md w-max text-white font-semibold">{{ $file_courses }} Materi |
                        {{ $assignments }} Assignments</p>
                </a>
            @endforeach
        @else
            <h6 class="font-bold text-primary">Data is empty...</h6>
        @endif
    </div>
@endsection
