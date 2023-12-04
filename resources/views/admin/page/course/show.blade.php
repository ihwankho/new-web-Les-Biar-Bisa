@extends('layout.admin')

@section('title', 'Admin Course')

@php
    $page = request()->segment(3);
@endphp

@section('content')
    <a href="/admin/course/{{ $page }}/materi/add" class="btn block w-max text-xs mt-5">+ Add Materi</a>
    <div class="my-3">
        @if ($filecourse->count() > 0)
            @foreach ($filecourse as $file)
                <div class="flex gap-3 w-max p-2 rounded-md bg-slate-100 font-medium text-primary items-center">
                    <a class="flex gap-3 w-full p-2 rounded-md bg-slate-100 font-medium text-primary items-center"
                        href="{{ asset('/assets/course/materi' . $file['file']) }}"
                        download="/assets/course/materi/{{ $file['file'] }}">
                        <img src="{{ asset('/assets/icon/file.svg') }}" alt="file-icon">
                        <p>{{ $file['nama'] }}</p>
                        <div class="flex w-max items-center gap-2 mr-2">
                            <a href="/admin/course/materi/edit/{{ $file['id'] }}"
                                class="grid place-items-center w-max p-1 rounded-md bg-orange-500"><img width="30"
                                    src="{{ asset('/assets/icon/exchange.svg') }}" alt="change-icon" /></a>
                            <form action="/admin/course/materi/delete/{{ $file['id'] }}" method="post">
                                @method('DELETE')
                                @csrf
                                <button onclick="return confirm('Are you sure?')"
                                    class="grid place-items-center w-max p-1 rounded-md bg-rose-500"><img width="10"
                                        src="{{ asset('/assets/icon/trash.svg') }}" alt="trash-icon" /></button>
                            </form>
                        </div>
                    </a>
                </div>
            @endforeach
        @else
            <p class="page-title">Data materi is empty</p>
        @endif
    </div>
    <a href="/admin/course/{{ $page }}/task/add" class="btn block w-max text-xs mt-5">+ Add Task</a>
    @if ($tasks->count() > 0)
        @foreach ($tasks as $t)
            <div class="block bg-slate-100 p-2 w-1/5 rounded-md  my-3 relative">
                <a href="/admin/course/task/{{ $t['id'] }}" class="block">
                    <div class="flex justify-between items-center">
                        <div class="flex items-center gap-3">
                            <img src="{{ asset('/assets/icon/document_task.svg') }}" alt="icon_documentTask">
                            <p class="font-bold text-lg text-primary uppercase">{{ $t['nama'] }}</p>
                        </div>
                        <div class="flex w-max items-center gap-2">
                            <a href="/admin/course/task/edit/{{ $t['id'] }}"
                                class="grid place-items-center w-max p-1 rounded-md bg-orange-500"><img width="10"
                                    src="{{ asset('/assets/icon/pencil.svg') }}" alt="change-icon" /></a>
                            <form action="/admin/course/task/delete/{{ $t['id'] }}" method="post">
                                @method('DELETE')
                                @csrf
                                <button onclick="return confirm('Are you sure?')"
                                    class="grid place-items-center w-max p-1 rounded-md bg-rose-500"><img width="10"
                                        src="{{ asset('/assets/icon/trash.svg') }}" alt="trash-icon" /></button>
                            </form>
                        </div>
                    </div>
                    <p class="text-xs bg-gray-100 w-max p-1 rounded-md"><b>Deadline:</b>
                        {{ $t['deadline'] }}
                    </p>
                </a>
            </div>
        @endforeach
    @else
        <p class="page-title">Data assignment is empty</p>

    @endif
@endsection
