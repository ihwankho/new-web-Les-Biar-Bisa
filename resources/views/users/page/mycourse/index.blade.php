@extends('users.layout.app')

@section('title', 'My Course')

@section('content')
    <h1 class="page-title">Your Course</h1>
    <div>
        <div class="card">
            <img class="card-thumbnail" src="{{ asset('/assets/course/thumbnail1.jpg') }}" alt="Thumbnail-Course">
            <h3 class="card-title">VOCABULARY ENGLISH LANGUAGE</h3>
            <p class="text-xs bg-primary p-2 rounded-md w-max text-white font-semibold">5 Materi | 2 Assignments</p>
        </div>
    </div>
@endsection
