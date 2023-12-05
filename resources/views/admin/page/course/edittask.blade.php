@extends('layout.admin')

@section('title', 'Edit Course')

@php
    $page = request()->segment(3);
@endphp

@section('content')

    <h1 class="page-title">Edit Task</h1>

    <form class="flex mt-5 flex-col gap-3" method="POST" enctype="multipart/form-data"
        action="/admin/course/task/edit/{{ $task['id'] }}">
        @method('PUT')
        @csrf
        <table cellpadding="3">
            <tr>
                <td>
                    <label class="space-x-2" for="nama">
                        <span class="font-semibold">Task Name</span>
                    </label>
                </td>
                <td>
                    <input class="p-2 w-80 rounded-md text-xs border border-slate-400 outline-none" type="text"
                        value="{{ $task['nama'] }}" name="nama" placeholder="Masukkan nama course anda" id="nama">
                </td>
            </tr>
            <tr>
                <td>
                    <label class="space-x-2" for="catatan">
                        <span class="font-semibold">Catatan</span>
                    </label>
                </td>
                <td>
                    <textarea class="p-2 w-80 rounded-md text-xs border border-slate-400 outline-none" type="text" name="catatan"
                        placeholder="Masukkan catatan course anda" id="catatan">{{ $task['catatan'] }}</textarea>
                </td>
            </tr>
            <tr>
                <td>
                    <label class="space-x-2" for="deadline">
                        <span class="font-semibold">Deadline</span>
                    </label>
                </td>
                <td>
                    <input class="p-2 w-80 rounded-md text-xs border border-slate-400 outline-none" type="datetime-local"
                        value="{{ $task['deadline'] }}" name="deadline" placeholder="Masukkan deadline course anda"
                        id="deadline">
                </td>
            </tr>
            <tr>
                <td>
                    <label class="space-x-2" for="metode_pengumpulan">
                        <span class="font-semibold">Tingkatan</span>
                    </label>
                </td>
                <td>
                    <select class="p-2 rounded-md" name="metode_pengumpulan" id="metode_pengumpulan">
                        <option disabled selected="false" value="">Metode Pengumpulan</option>
                        <option value="url" {{ $task['metode_pengumpulan'] == 'url' ? 'selected' : '' }}>URL Saja
                        </option>
                        <option value="file" {{ $task['metode_pengumpulan'] == 'file' ? 'selected' : '' }}>File Saja
                        </option>
                        <option value="semua" {{ $task['metode_pengumpulan'] == 'semua' ? 'selected' : '' }}>URL & File
                        </option>
                    </select>
                </td>
            </tr>
            <tr>
                <td></td>
                <td>
                    <button class="btn" name="submit" type="submit">Edit Task</button>
                </td>
            </tr>
        </table>
    </form>

@endsection
