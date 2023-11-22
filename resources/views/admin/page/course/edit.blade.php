@extends('layout.admin')

@section('title', 'Create Course')

@section('content')

    <h1 class="page-title">Add New Course</h1>

    <form class="flex mt-5 flex-col gap-3" method="POST" enctype="multipart/form-data"
        action="/admin/course/{{ $course->id }}">
        @method('PUT')
        @csrf
        <table cellpadding="3">
            <tr>
                <td>
                    <label class="space-x-2" for="tingkatan">
                        <span class="font-semibold">Tingkatan</span>
                    </label>
                </td>
                <td>
                    <select class="p-2 w-80 rounded-md" name="tingkatan" id="tingkatan">
                        <option disabled selected value="">Pilih Tingkatan</option>
                        @foreach ($tingkatan as $item)
                            @if ($item->nama == 'SD')
                                <option value="{{ $item->id }}"
                                    {{ $course->id_tingkatan == $item->id ? 'selected' : '' }}>Sekolah Dasar</option>
                            @elseif($item->nama == 'SMP')
                                <option value="{{ $item->id }}"
                                    {{ $course->id_tingkatan == $item->id ? 'selected' : '' }}>Sekolah Menengah Pertama
                                </option>
                            @elseif($item->nama == 'SMA')
                                <option value="{{ $item->id }}"
                                    {{ $course->id_tingkatan == $item->id ? 'selected' : '' }}>Sekolah Menengah Atas
                                </option>
                            @endif
                        @endforeach
                    </select>
                </td>
            </tr>
            <tr>
                <td>
                    <label class="space-x-2" for="nama">
                        <span class="font-semibold">Course</span>
                    </label>
                </td>
                <td>
                    <input class="p-2 w-80 rounded-md text-xs border border-slate-400 outline-none" type="text"
                        value="{{ $course->nama }}" name="nama" placeholder="Masukkan nama course anda" id="nama">
                </td>
            </tr>
            <tr>
                <td>
                    <label class="space-x-2" for="deskripsi">
                        <span class="font-semibold">Deskripsi</span>
                    </label>
                </td>
                <td>
                    <textarea rows="3" class="p-2 w-80 rounded-md text-xs border border-slate-400 outline-none" type="text"
                        name="deskripsi" placeholder="Masukkan deskripsi anda" id="deskripsi">{{ $course->deskripsi }}</textarea>
                </td>
            </tr>
            <tr>
                <td>
                    <label class="space-x-2" for="thumbnail">
                        <span class="font-semibold">Thumbnail</span>
                    </label>
                </td>
                <td>
                    <input class="p-2 w-80 rounded-md text-xs border border-slate-400 outline-none" type="file"
                        name="thumbnail" placeholder="Masukkan thumbnail anda" id="thumbnail">
                </td>
            </tr>
            <tr>
                <td></td>
                <td>
                    <img class="w-1/2 rounded-md" src="{{ asset('/assets/course/' . $course->thumbnail) }}"
                        alt="course-image">
                </td>
            </tr>
            <tr>
                <td></td>
                <td>
                    <button class="btn" name="submit" type="submit">Create Course</button>
                </td>
            </tr>
        </table>
    </form>

@endsection
