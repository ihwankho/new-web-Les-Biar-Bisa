@extends('layout.admin')

@section('title', 'Edit Schedule')

@section('content')

    <h1 class="page-title">Edit Schedule</h1>

    <form class="flex mt-5 flex-col gap-3" method="POST" enctype="multipart/form-data"
        action="/admin/schedule/update/{{ $schedule['id'] }}">
        @method('POST')
        @csrf
        <table cellpadding="3">
            <tr>
                <td>
                    <label class="space-x-2" for="nama">
                        <span class="font-semibold">Tingkatan</span>
                    </label>
                </td>
                <td>
                    <select class="p-2 rounded-md" name="nama" id="nama">
                        <option disabled selected="false" value="">Pilih Tingkatan</option>
                        <option value="SD" {{ $schedule['nama'] == 'SD' ? 'selected' : '' }}>Sekolah Dasar</option>
                        <option value="SMP" {{ $schedule['nama'] == 'SMP' ? 'selected' : '' }}>Sekolah Menengah Pertama
                        </option>
                        <option value="SMA" {{ $schedule['nama'] == 'SMA' ? 'selected' : '' }}>Sekolah Menengah Atas
                        </option>
                    </select>
                </td>
            </tr>
            <tr>
                <td>
                    <label for="jadwal">
                        <span class="font-semibold">Jadwal</span>
                    </label>
                </td>
                <td>
                    <input type="file" name="jadwal" id="jadwal">
                </td>
            </tr>
            <tr>
                <td></td>
                <td>
                    <img class="w-1/2 rounded-md" src="{{ $schedule['jadwal'] }}" alt="schedule-image">
                </td>
            </tr>
            <tr>
                <td></td>
                <td>
                    <button class="btn" name="submit" type="submit">Simpan</button>
                </td>
            </tr>
        </table>
    </form>

@endsection
