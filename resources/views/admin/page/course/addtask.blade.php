@extends('layout.admin')

@section('title', 'Create Course')

@php
    $page = request()->segment(3);
@endphp

@section('content')

    <h1 class="page-title">Add New Task Assignment</h1>

    <form class="flex mt-5 flex-col gap-3" method="POST" enctype="multipart/form-data"
        action="/admin/course/{{ $page }}/task">
        @method('POST')
        @csrf
        <table cellpadding="3">
            <tr>
                <td>
                    <label class="space-x-2" for="nama">
                        <span class="font-semibold">Assignment Name</span>
                    </label>
                </td>
                <td>
                    <input class="p-2 w-80 rounded-md text-xs border border-slate-400 outline-none" type="text"
                        name="nama" placeholder="Masukkan nama course anda" id="nama">
                </td>
            </tr>
            <tr>
                <td>
                    <label class="space-x-2" for="pengumpulan">
                        <span class="font-semibold">Metode Pengumpulan</span>
                    </label>
                </td>
                <td>
                    <select class="p-2 w-80 rounded-md text-xs border border-slate-400 outline-none" type="text"
                        name="pengumpulan" placeholder="Masukkan pengumpulan course anda" id="pengumpulan">
                        <option selected value="" disabled>Pilih Metode Pengumpulan</option>
                        <option value="url">URL Saja</option>
                        <option value="file">File Saja</option>
                        <option value="semua">URL & File</option>
                    </select>
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
                        name="deadline" placeholder="Masukkan deadline course anda" id="deadline">
                </td>
            </tr>
            <tr>
                <td>
                    <label class="space-x-2" for="catatan">
                        <span class="font-semibold">Assignment Noted</span>
                    </label>
                </td>
                <td>
                    <textarea rows="3" class="p-2 w-80 rounded-md text-xs border border-slate-400 outline-none" name="catatan"
                        placeholder="Masukkan catatan course anda" id="catatan"></textarea>
                </td>
            </tr>
            <tr>
                <td></td>
                <td>
                    <button class="btn" name="submit" type="submit">Add Materi</button>
                </td>
            </tr>
        </table>
    </form>

@endsection
