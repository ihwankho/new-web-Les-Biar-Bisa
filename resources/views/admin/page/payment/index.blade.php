@extends('layout.admin')

@section('title', 'Admin Payment')

@section('content')
    <h5 class="page-title">Payment</h5>

    <div>
        <a href="#"
            class="py-1 px-2 inline-block text-xs rounded-full border border-primary text-primary font-semibold">All</a>
        <a href="#"
            class="py-1 px-2 inline-block text-xs rounded-full border border-primary text-white bg-primary font-semibold">Come
            In</a>
        <a href="#"
            class="py-1 px-2 inline-block text-xs rounded-full border border-primary text-primary font-semibold">Approved</a>
        <a href="#"
            class="py-1 px-2 inline-block text-xs rounded-full border border-primary text-primary font-semibold">Unapproved</a>
    </div>

    <div class="mt-5">
        <div class="card">
            <img class="card-thumbnail" src="{{ asset('/assets/course/thumbnail1.jpg') }}" alt="thumbnail-course">
            <div class="flex my-2 justify-between items-center">
                <h3 class="font-bold">From: Filfia Antika A.</h3>
                <span class="text-[10px] font-semibold text-white py-1 px-2 rounded-full bg-primary/50">14 November
                    2023</span>
            </div>
            <p class="text-xs">Bukti pembayaran bulan 1 les private</p>
            <div class="mt-3 w-full flex gap-2">
                <a href="#"
                    class="p-1 block w-full text-xs font-medium text-white text-center bg-green-500 rounded-md">Edit
                    Course</a>
                <a href="#"
                    class="p-1 block w-full text-xs font-medium text-white text-center bg-rose-500 rounded-md">Delete
                    Course</a>
            </div>
        </div>
    </div>
@endsection
