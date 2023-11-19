@extends('layout.app')

@section('title', 'Detail Payment')

@section('content')
    <h1 class="page-title">Detail Payment</h1>

    <div class="rounded-md p-3 border border-slate-300 w-max shadow-md bg-white">
        <img class="h-96 rounded-md" src="{{ asset('/assets/payment/' . $payment->bukti) }}" alt="payment">
        <table cellpadding='3' class="mt-3">
            <tr>
                <td class="font-semibold">ID</td>
                <td>: {{ $payment->id }}</td>
            </tr>
            <tr>
                <td class="font-semibold">Tanggal</td>
                <td>: {{ $payment->created_at }}</td>
            </tr>
            <tr>
                <td class="font-semibold">Status</td>
                <td>: <span
                        class="bg-slate-400 font-semibold py-1 px-3 text-white rounded-full text-xs">{{ $payment->created_at }}</span>
                </td>
            </tr>
            <tr>
                <td class="font-semibold">Nama</td>
                <td>: {{ $payment->nama }}</td>
            </tr>
            <tr>
                <td class="font-semibold">Catatan</td>
                <td>: {{ $payment->note }}</td>
            </tr>
        </table>
    </div>
@endsection
