@extends('layout.app')

@section('title', 'Assignment Task')

@section('content')
    <h1 class="font-extrabold text-xl text-primary uppercase">{{ $data['assignment_nama'] }} - {{ $data['course_nama'] }}
    </h1>
    <div class="flex items-center gap-3">
        <p class="text-xs bg-gray-100 w-max p-1 rounded-md m-2"><b>Deadline:</b> {{ $data['deadline'] }}</p>
        @if ($data['status'] == 'belum selesai')
            <span class="bg-slate-500 text-xs text-white font-semibold rounded-full px-3 py-1">Not Done</span>
        @else
            <span
                class="{{ $data['status'] == 'selesai' ? 'bg-green-400' : 'bg-rose-400' }} text-xs text-white font-semibold rounded-full px-3 py-1">{{ $data['status'] == 'selesai' ? 'Done' : 'Working Late' }}</span>
        @endif
    </div>
    <p class="page-title mt-5">Status Pengajuan Tugas</p>
    <table class="w-max rounded-md" cellpadding="3">
        <tr>
            <td class="font-medium border border-primary px-6 py-3">Status Pengajuan</td>
            <td class="border border-primary  px-6 py-3">
                {{ $data['nilai'] == null ? 'Tugas Terkirim' : 'Tugas Sudah Dinilai' }}</td>
        </tr>
        <tr>
            <td class="font-medium border border-primary px-6 py-3">Waktu Pengajuan</td>
            <td class="border border-primary  px-6 py-3">{{ $data['waktu_pengajuan'] }}</td>
        </tr>
        <tr>
            <td class="font-medium border border-primary px-6 py-3">Nama</td>
            <td class="border border-primary  px-6 py-3">{{ $data['nama'] }}</td>
        </tr>
        @if ($data['url'] != null)
            <tr>
                <td class="font-medium border border-primary px-6 py-3">Pengajuan URL</td>
                <td class="border border-primary  px-6 py-3">{{ $data['url'] }}</td>
            </tr>
        @endif
        @if ($data['file'] != null)
            <tr>
                <td class="font-medium border border-primary px-6 py-3">Pengajuan File</td>
                <td class="border border-primary  px-6 py-3">{{ $data['file'] }}</td>
            </tr>
        @endif
        <tr>
            <td class="font-medium border border-primary px-6 py-3">Nilai</td>
            <td class="border border-primary  px-6 py-3">
                {{ $data['nilai'] != null ? $data['nilai'] . '/100' : 'Belum ada' }}</td>
        </tr>
        <tr>
            <td class="font-medium border border-primary px-6 py-3">Catatan</td>
            <td class="border border-primary  px-6 py-3">
                {{ $data['catatan'] != null ? $data['catatan'] : 'Belum ada' }}</td>
        </tr>
        <tr>
            <td></td>
            <td class="flex items-center gap-3">
                <form action="/assignment/delete/{{ $data['id_score'] }}" method="post">
                    @method('DELETE')
                    @csrf
                    <button onclick="return confirm('Are you sure?')" type="submit" name="submit"
                        class="flex items-center gap-2 text-xs btn-danger">
                        <img src="{{ asset('/assets/icon/remove.svg') }}" alt="remove-icon">
                        <span>Remove your assignment</span>
                    </button>
                </form>
            </td>
        </tr>
    </table>
@endsection
