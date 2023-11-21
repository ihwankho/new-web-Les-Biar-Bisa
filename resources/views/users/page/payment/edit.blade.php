@extends('layout.app')

@section('title', 'Edit payment')

@section('content')
    <h1 class="page-title">Tambah Pembayaran</h1>
    <div class="p-3 text-white rounded-md w-max bg-green-400">
        <p class="font-medium">Silahkan melakukan transfer ke
            <br> BANK BRI a.n Subayil
        </p>
        <p class="font-extrabold">2342 - 23943 - 382498 - 98234</p>
    </div>
    <form class="flex mt-5 flex-col gap-3" method="POST" enctype="multipart/form-data"
        action="/payment/update/{{ $data->id }}">
        @method('PUT')
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
                        value="{{ $data->nama }}" name="nama" placeholder="Berikan nama pembayaran..." id="nama">
                </td>
            </tr>
            <tr>
                <td>
                    <label class="space-x-2" for="catatan">
                        <span class="font-semibold">Catatan</span>
                    </label>
                </td>
                <td>
                    <input class="p-2 w-80 rounded-md text-xs border border-slate-400 outline-none" type="text"
                        value="{{ $data->note }}" name="catatan" placeholder="Berikan catatan..." id="catatan">
                </td>
            </tr>
            <tr>
                <td>
                    <label for="bukti">
                        <span class="font-semibold">Bukti</span>
                    </label>
                </td>
                <td>
                    <input type="file" name="bukti" id="bukti">
                </td>
            </tr>
            <tr>
                <td></td>
                <td>
                    <img width="132" src="{{ asset('/assets/payment/' . $data->bukti) }}" alt="image-payment">
                </td>
            </tr>
            <tr>
                <td>
                </td>
                <td>
                    <button class="btn" type="submit">Simpan</button>
                </td>
            </tr>
        </table>
    </form>
@endsection
