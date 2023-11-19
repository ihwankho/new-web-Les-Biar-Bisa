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
    <p class="page-title mt-5">Collect Assignment</p>
    @php
        $page = request()->segment(1);
    @endphp

    @if ($page == 'mycourse')
        <form class="flex flex-col gap-3" method="POST" enctype="multipart/form-data"
            action="{{ route('mycourse.store', ['id_assignment' => $data['id']]) }}">
        @else
            <form class="flex flex-col gap-3" method="POST" enctype="multipart/form-data"
                action="{{ route('assignment.storeass', ['id_assignment' => $data['id']]) }}">
    @endif
    @method('POST')
    @csrf
    <table cellpadding="3">
        <tr>
            <td>
                <label class="space-x-2" for="nama">
                    <span class="font-semibold">Nama</span>
                </label>
            </td>
            <td>
                <input class="p-2 w-80 rounded-md text-xs border border-slate-400 outline-none" type="text"
                    name="nama" placeholder="Berikan nama tugas yang dikumpulkan" id="nama">
            </td>
        </tr>
        @if ($data['metode_pengumpulan'] == 'url')
            <tr>
                <td>
                    <label for="url">
                        <span class="font-semibold">URL</span>
                    </label>
                </td>
                <td>
                    <input class="p-2 w-80 rounded-md text-xs border border-slate-400 outline-none" type="text"
                        name="url" placeholder="Berikan url tugas yang dikumpulkan" id="url">
                </td>
            </tr>
        @elseif($data['metode_pengumpulan'] == 'file')
            <tr>
                <td>
                    <label for="file">
                        <span class="font-semibold">File</span>
                    </label>
                </td>
                <td>
                    <input type="file" name="file" id="file">
                </td>
            </tr>
        @else
            <tr>
                <td>
                    <label for="url">
                        <span class="font-semibold">URL</span>
                    </label>
                </td>
                <td>
                    <input class="p-2 w-80 rounded-md text-xs border border-slate-400 outline-none" type="text"
                        name="url" placeholder="Berikan url tugas yang dikumpulkan" id="url">
                </td>
            </tr>

            <tr>
                <td>
                    <label for="file">
                        <span class="font-semibold">File</span>
                    </label>
                </td>
                <td>
                    <input type="file" name="file" id="file">
                </td>
            </tr>
        @endif
        <tr>
            <td></td>
            <td>
                <button class="btn" type="submit">Add Task</button>
            </td>
        </tr>
    </table>
    </form>
@endsection
