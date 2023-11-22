@extends('layout.admin')

@section('title', 'Admin Course')

@section('content')
    <a href="/admin/course/create" class="btn">+ Add Course</a>

    <div class="flex items-center gap-3 mt-5">
        <a href="#"
            class="py-1 px-2 inline-block text-xs rounded-full border border-primary text-white bg-primary font-semibold">All</a>
        <a href="#"
            class="py-1 px-2 inline-block text-xs rounded-full border border-primary text-primary font-semibold">Sekolah
            Dasar</a>
        <a href="#"
            class="py-1 px-2 inline-block text-xs rounded-full border border-primary text-primary font-semibold">Sekolah
            Menengah Pertama</a>
        <a href="#"
            class="py-1 px-2 inline-block text-xs rounded-full border border-primary text-primary font-semibold">Sekolah
            Menengah Atas</a>
    </div>

    <div class="flex items-start gap-3 mt-5 flex-wrap">
        @if ($data->count() > 0)
            @foreach ($data as $item)
                <a href="/admin/course/{{ $item['id'] }}" class="card block relative">
                    <img class="card-thumbnail" src="{{ asset('/assets/course/' . $item['thumbnail']) }}"
                        alt="thumbnail-course">
                    <span
                        class="text-xs absolute top-5 right-5 py-1 px-2 bg-green-500 rounded-full font-medium text-white">{{ $item['tingkatan']['nama'] }}</span>
                    <h3 class="card-title uppercase">{{ $item['nama'] }}</h3>
                    <p class="text-xs bg-primary p-2 rounded-md w-max text-white font-semibold">{{ $item['materi'] }} Materi
                        | {{ $item['assignment'] }} Assignments</p>
                    <div class="mt-3 w-full flex gap-2">
                        <a href="/admin/course/edit/{{ $item['id'] }}"
                            class="p-2 block w-full text-xs font-semibold text-white text-center bg-green-500 rounded-md">Edit
                            Course</a>
                        <form class="block w-full" action="/admin/course/{{ $item['id'] }}" method="post">
                            @method('DELETE')
                            @csrf
                            <button type="submit"
                                class="p-2 block w-full text-xs font-semibold text-white text-center bg-rose-500 rounded-md">Delete
                                Course</button>
                        </form>
                    </div>
                </a>
            @endforeach
        @else
            <p class="page-title">Data is empty</p>
        @endif
    </div>
@endsection
