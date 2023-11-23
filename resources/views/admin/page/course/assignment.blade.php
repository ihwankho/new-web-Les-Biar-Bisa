@extends('layout.admin')

@section('title', 'Admin Course')

@php
    $page = request()->segment(3);
@endphp

@section('content')
    <h1 class="font-extrabold text-lg mb-5 text-primary">{{ $course['nama'] }} - {{ $assignment['nama'] }}</h1>

    <div>
        @if ($data->count() > 0)
            @foreach ($data as $item)
                <div class="flex items-start bg-slate-50 w-1/2 gap-3 p-2 rounded-md">
                    <img src="{{ asset('/assets/icon/document_task.svg') }}" alt="icon-document_task">
                    <form action="/admin/course/task/{{ $item['id'] }}" method="post" class="w-full">
                        @method('PUT')
                        @csrf
                        <div class="flex items-center justify-between">
                            <p class="text-lg text-primary font-bold">{{ $item['nama'] }}</p>
                            <span class="text-xs bg-slate-200 p-2 rounded-md"><b>Dikumpulkan:</b>
                                {{ $item['waktu_pengumpulan'] }}</span>
                        </div>
                        <p class="text-xs"><b>From:</b> {{ $item['user'] }}</p>
                        <table class="mt-5">
                            @if ($item['file'])
                                <tr>
                                    <td><span class="font-semibold">File Pengumpulan</span></td>
                                    <td>
                                        <a class="flex ml-3 font-medium text-primary items-center"
                                            href="{{ asset('/assets/course/materi/' . $item['file']) }}"
                                            download="{{ asset('/assets/course/materi/' . $item['file']) }}"> <img
                                                src="{{ asset('/assets/icon/file.svg') }}" width="16" alt="file-icon">
                                            <p>{{ $item['file'] }}</p>
                                        </a>
                                    </td>
                                </tr>
                            @endif
                            @if ($item['url'])
                                <tr>
                                    <td><span class="font-semibold">URL Pengumpulan</span></td>
                                    <td>
                                        <a class="ml-3 text-blue-500 underline"
                                            href="{{ $item['url'] }}">{{ $item['url'] }}</a>
                                    </td>
                                </tr>
                            @endif
                            <tr>
                                <td>
                                    <span class="font-semibold">Nilai</span>
                                </td>
                                <td><input class="ml-3 p-1 rounded-md bg-white border border-primary outline-none"
                                        value="{{ $item['nilai'] }}" type="number" name="nilai"
                                        {{ $item['nilai'] ? 'disabled' : '' }} id="nilai"></td>
                            </tr>
                            <tr>
                                <td>
                                    <span class="font-semibold">Catatan</span>
                                </td>
                                <td>
                                    <textarea {{ $item['catatan'] ? 'disabled' : '' }}
                                        class="ml-3 p-1 rounded-md bg-white border border-primary outline-none" name="catatan" id="catatan"> {{ $item['catatan'] }} </textarea>
                                </td>
                            </tr>
                            @if ($item['nilai'] == null)
                                <tr>
                                    <td></td>
                                    <td>
                                        <button class="btn w-24 ml-3" type="submit">Save</button>
                                    </td>
                                </tr>
                            @endif
                        </table>
                    </form>
                </div>
            @endforeach
        @else
            <p class="page-title">Data is empty...</p>
        @endif
    </div>
@endsection
