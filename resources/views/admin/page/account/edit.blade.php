@extends('layout.admin')

@section('title', 'Edit Account')

@section('content')

    <h1 class="page-title">Edit Account</h1>

    <form class="flex mt-5 flex-col gap-3" method="POST" enctype="multipart/form-data"
        action="/admin/account/{{ $users->id }}">
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
                        <option disabled selected="false" value="">Pilih Tingkatan</option>
                        @foreach ($tingkatan as $item)
                            @if ($item->nama == 'SD')
                                <option value="{{ $item->id }}"
                                    {{ $users->id_tingkatan == $item->id ? 'selected=true' : '' }}>
                                    Sekolah Dasar
                                </option>
                            @elseif($item->nama == 'SMP')
                                <option value="{{ $item->id }}"
                                    {{ $users->id_tingkatan == $item->id ? 'selected=true' : '' }}>
                                    Sekolah Menengah
                                    Pertama</option>
                            @elseif($item->nama == 'SMA')
                                <option value="{{ $item->id }}"
                                    {{ $users->id_tingkatan == $item->id ? 'selected=true' : '' }}>
                                    Sekolah Menengah
                                    Atas</option>
                            @endif
                        @endforeach
                    </select>
                </td>
            </tr>
            <tr>
                <td>
                    <label class="space-x-2" for="username">
                        <span class="font-semibold">Username</span>
                    </label>
                </td>
                <td>
                    <input class="p-2 w-80 rounded-md text-xs border border-slate-400 outline-none" type="text"
                        name="username" value="{{ $users->username }}" placeholder="Masukkan username anda" id="username">
                </td>
            </tr>
            <tr>
                <td>
                    <label class="space-x-2" for="fullname">
                        <span class="font-semibold">Nama Lengkap</span>
                    </label>
                </td>
                <td>
                    <input class="p-2 w-80 rounded-md text-xs border border-slate-400 outline-none" type="text"
                        name="fullname" value="{{ $users->fullname }}" placeholder="Masukkan fullname anda" id="fullname">
                </td>
            </tr>
            <tr>
                <td>
                    <label class="space-x-2" for="password">
                        <span class="font-semibold">Password</span>
                    </label>
                </td>
                <td>
                    <input class="p-2 w-80 rounded-md text-xs border border-slate-400 outline-none" type="password"
                        name="password" placeholder="Masukkan password anda" id="password">
                </td>
            </tr>
            <tr>
                <td></td>
                <td>
                    <button class="btn" name="submit" type="submit">Edit Account</button>
                </td>
            </tr>
        </table>
    </form>

@endsection
