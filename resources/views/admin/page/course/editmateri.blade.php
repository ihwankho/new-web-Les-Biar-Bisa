@extends('layout.admin')

@section('title', 'Create Course')

@php
    $page = request()->segment(3);
@endphp

@section('content')

    <h1 class="page-title">Edit Materi</h1>

    <form class="flex mt-5 flex-col gap-3" method="POST" enctype="multipart/form-data"
        action="/admin/course/materi/edit/{{ $materi->id }}">
        @method('PUT')
        @csrf
        <table cellpadding="3">
            <tr>
                <td>
                    <label class="space-x-2" for="nama">
                        <span class="font-semibold">Materi Name</span>
                    </label>
                </td>
                <td>
                    <input class="p-2 w-80 rounded-md text-xs border border-slate-400 outline-none" type="text"
                        value="{{ $materi->nama }}" name="nama" placeholder="Masukkan nama course anda" id="nama">
                </td>
            </tr>
            <tr>
                <td>
                    <label class="space-x-2" for="file">
                        <span class="font-semibold">File</span>
                    </label>
                </td>
                <td>
                    <input class="p-2 w-80 rounded-md text-xs border border-slate-400 outline-none" type="file"
                        name="file" placeholder="Masukkan file anda" id="file">
                </td>
            </tr>
            <tr>
                <td></td>
                <td>
                    <div class="flex gap-3 bg-slate-100 p-2 rounded-md w-max items-center font-medium text-primary">
                        <img width="18" src="{{ asset('/assets/icon/file.svg') }}" alt="icon-file">
                        <p>{{ $materi->file }}</p>
                    </div>
                </td>
            </tr>
            <tr>
                <td></td>
                <td>
                    <button class="btn" name="submit" type="submit">Edit Materi</button>
                </td>
            </tr>
        </table>
    </form>

@endsection
