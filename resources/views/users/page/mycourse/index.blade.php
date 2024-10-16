@extends('layout.app')

@section('title', 'My Course')

@section('content')
<div class="relative">
    <div class="absolute inset-0 bg-cover bg-center" style="background-image: url('/assets/background/backgroundU/Group.png'); z-index: -1; background-repeat:no-repeat; background-size: auto; width: 1570px; height: 900px; background-position: right;"></div>
    <h1 class="page-title">Your Course</h1>
    <div class="flex items-start gap-3">
        @if (count($courses) > 0)
            @foreach ($courses as $course)
                <a href="{{ route('mycourse.show', ['mycourse' => $course['id']]) }}" class="card block">
                    <img class="card-thumbnail" src="{{ $course['thumbnail'] }}" alt="Thumbnail-Course">
                    <h3 class="card-title">{{ $course['nama'] }}</h3>
                    <p class="text-xs bg-primary p-2 rounded-md w-max text-white font-semibold">{{ $file_courses }} Materi |
                        {{ $assignments }} Assignments</p>
                </a>
            @endforeach
        @else
            <h6 class="font-bold text-primary">Data is empty...</h6>
        @endif
    </div>
@endsection
