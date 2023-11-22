@extends('layout.admin')

@section('title', 'Admin Payment')

@section('content')
    <h5 class="page-title">Payment</h5>

    <div>
        <a href="/admin/payment"
            class="py-1 px-2 inline-block text-xs rounded-full border border-primary text-primary font-semibold">All</a>
        <a href="/admin/payment/come"
            class="py-1 px-2 inline-block text-xs rounded-full border border-primary text-primary font-semibold">Come
            In</a>
        <a href="/admin/payment/approved"
            class="py-1 px-2 inline-block text-xs rounded-full border border-primary text-primary font-semibold">Approved</a>
        <a href="/admin/payment/unapproved"
            class="py-1 px-2 inline-block text-xs rounded-full border border-primary text-white bg-primary font-semibold">Unapproved</a>
    </div>

    <div class="mt-5">
        @if ($data->count() > 0)
            @foreach ($data as $pay)
                <div class="card">
                    <img class="card-thumbnail" src="{{ asset('/assets/payment/' . $pay->bukti) }}" alt="thumbnail-course">
                    <div class="flex my-2 justify-between items-center">
                        <h3 class="font-bold">From: {{ $pay->users->fullname }}</h3>
                        <span
                            class="text-[7px] font-medium text-white py-1 px-2 rounded-full bg-primary/50">{{ $dateTime[$i - 1] }}</span>
                    </div>
                    @php
                        $i++;
                    @endphp
                    <p class="text-xs">{{ $pay->note }}</p>
                    <div class="mt-3 w-full flex gap-2">
                        @if ($pay->status == 'pending')
                            <form class="block w-full " action="/admin/payment/{{ $pay->id }}" method="post">
                                @method('PUT')
                                @csrf
                                <button onclick="return confirm('Are you sure?')" type="submit"
                                    class="p-1 block w-full text-xs font-medium text-white text-center bg-green-500 rounded-md">Approved</button>
                            </form>
                            <form class="block w-full " action="/admin/payment/{{ $pay->id }}" method="post">
                                @method('POST')
                                @csrf
                                <button onclick="return confirm('Are you sure?')" type="submit"
                                    class="p-1 block w-full text-xs font-medium text-white text-center bg-rose-500 rounded-md">Unapproved</button>
                            </form>
                        @else
                            @if ($pay->status == 'approved')
                                <button disabled type="submit"
                                    class="p-1 cursor-not-allowed block w-full text-xs font-medium text-green-500 text-center bg-green-200 rounded-md">Approved</button>
                            @else
                                <button disabled type="submit"
                                    class="p-1 cursor-not-allowed block w-full text-xs font-medium text-rose-500 text-center bg-rose-200 rounded-md">Unapproved</button>
                            @endif
                        @endif
                    </div>
                </div>
            @endforeach
        @else
            <p class="page-title">Data payments is empty</p>
        @endif
    </div>
@endsection
