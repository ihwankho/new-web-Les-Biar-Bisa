@extends('users.layout.app')

@section('title', 'Payment')

@section('content')
    <h5 class="page-title">History Payment</h5>

    <a class="bg-primary p-3 rounded-md font-semibold text-white text-xs" href="#">+ Tambah Bukti Pembayaran</a>

    <div class="relative overflow-x-auto w-max max-w-full mt-5 sm:rounded-lg">
        <table class="text-sm text-left rtl:text-center text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">NO</th>
                    <th scope="col" class="px-6 py-3">IMAGE</th>
                    <th scope="col" class="px-6 py-3">NAME</th>
                    <th scope="col" class="px-6 py-3">DATE</th>
                    <th scope="col" class="px-6 py-3">STATUS</th>
                    <th scope="col" class="px-6 py-3">NOTE</th>
                    <th scope="col" class="px-6 py-3">ACTION</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td scope="col" class="px-6 py-3">1</td>
                    <td scope="col" class="px-6 py-3">image</td>
                    <td scope="col" class="px-6 py-3">Pembayaran Semester 1</td>
                    <td scope="col" class="px-6 py-3">12 Januri 2023</td>
                    <td scope="col" class="px-6 py-3">
                        <span class="bg-slate-400 font-semibold py-1 px-3 text-white rounded-full text-xs">Pending</span>
                    </td>
                    <td scope="col" class="px-6 py-3">12 Januri 2023</td>
                    <td scope="col" class="px-6 py-3">
                        <a href="#"
                            class="flex items-center gap-1 rounded-md bg-slate-400 py-1 px-2 text-xs font-semibold text-white">
                            <img width="12" src="{{ asset('/assets/icon/view_detail.svg') }}" alt="icon-viewdetail">
                            <p>Detail</p>
                        </a>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

@endsection
