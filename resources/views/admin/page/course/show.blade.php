@extends('layout.admin')

@section('title', 'Admin Course')

@php
    $page = request()->segment(3);
@endphp

@section('content')
    <h1 class="font-extrabold text-lg mb-5 text-primary">Hello World!</h1>
    <a href="/admin/course/{{ $page }}/materi/add" class="btn block w-max text-xs mt-5">+ Add Materi</a>
    <div class="my-3">
        @if ($filecourse->count() > 0)
            @foreach ($filecourse as $file)
                <a class="flex gap-3 w-1/2 p-2 rounded-md bg-slate-100 font-medium text-primary items-center"
                    href="{{ asset('/assets/course/materi' . $file->file) }}"
                    download="/assets/course/materi/{{ $file->file }}">
                    <img src="{{ asset('/assets/icon/file.svg') }}" alt="file-icon">
                    <p>{{ $file->nama }}</p>
                    <div class="flex w-max items-center gap-2">
                        <a href="#" class="grid place-items-center w-max p-1 rounded-md bg-orange-500"><img
                                width="18" src="{{ asset('/assets/icon/exchange.svg') }}" alt="change-icon" /></a>
                        <button class="grid place-items-center w-max p-1 rounded-md bg-rose-500"><img width="18"
                                src="{{ asset('/assets/icon/trash.svg') }}" alt="trash-icon" /></button>
                    </div>
                </a>
            @endforeach
        @else
            <p class="page-title">Data materi is empty</p>
        @endif
    </div>
    <a href="/admin/course/{{ $page }}/task/add" class="btn block w-max text-xs mt-5">+ Add Task</a>
    @if ($tasks->count() > 0)
        @foreach ($tasks as $t)
            <a href="/mycourse/task/{{ $t['id'] }}" class="block bg-slate-100 p-2 rounded-md w-1/2 my-3 relative">
                <div class="flex justify-between items-center">
                    <div class="flex items-center gap-3">
                        <img src="{{ asset('/assets/icon/document_task.svg') }}" alt="icon_documentTask">
                        <p class="font-bold text-lg text-primary uppercase">{{ $t['nama'] }}</p>
                    </div>
                    <div class="flex w-max items-center gap-2">
                        <a href="#" class="grid place-items-center w-max p-1 rounded-md bg-orange-500"><img
                                width="18" src="{{ asset('/assets/icon/pencil.svg') }}" alt="change-icon" /></a>
                        <button class="grid place-items-center w-max p-1 rounded-md bg-rose-500"><img width="18"
                                src="{{ asset('/assets/icon/trash.svg') }}" alt="trash-icon" /></button>
                    </div>
                </div>
                <p class="text-xs bg-gray-100 w-max p-1 rounded-md m-2"><b>Deadline:</b>
                    {{ $t['deadline'] }}
                </p>
            </a>
        @endforeach
    @else
        <p class="page-title">Data assignment is empty</p>

    @endif
@endsection
