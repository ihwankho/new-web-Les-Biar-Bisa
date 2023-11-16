@extends('layout.admin')

@section('title', 'Admin Course')

@section('content')
    <a href="#" class="btn">+ Add Course</a>

    <div class="flex items-center gap-3 mt-5">
        <a href="#"
            class="py-1 px-2 inline-block text-xs rounded-full border border-primary text-primary font-semibold">Sekolah
            Dasar</a>
        <a href="#"
            class="py-1 px-2 inline-block text-xs rounded-full border border-primary text-white bg-primary font-semibold">Sekolah
            Menengah Pertama</a>
        <a href="#"
            class="py-1 px-2 inline-block text-xs rounded-full border border-primary text-primary font-semibold">Sekolah
            Menengah Atas</a>
    </div>

    <div class="flex items-center gap-3 mt-5 flex-wrap">
        <div class="card">
            <img class="card-thumbnail" src="{{ asset('/assets/course/thumbnail1.jpg') }}" alt="thumbnail-course">
            <h3 class="card-title">VOCABULARY ENGLISH LANGUAGE</h3>
            <p class="text-xs bg-primary p-2 rounded-md w-max text-white font-semibold">5 Materi | 2 Assignments</p>
            <div class="mt-3 w-full flex gap-2">
                <a href="#"
                    class="p-2 block w-full text-xs font-semibold text-white text-center bg-green-500 rounded-md">Edit
                    Course</a>
                <a href="#"
                    class="p-2 block w-full text-xs font-semibold text-white text-center bg-rose-500 rounded-md">Delete
                    Course</a>
            </div>
        </div>
    </div>
@endsection
