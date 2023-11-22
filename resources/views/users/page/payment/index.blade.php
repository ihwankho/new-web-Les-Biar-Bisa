@extends('layout.app')

@section('title', 'Payment')

@section('content')
    <h5 class="page-title">
        History Payment</h5>

    <a class="bg-primary inline-block p-3 rounded-md font-semibold text-white text-xs" href="/payment/create">+ Tambah Bukti
        Pembayaran</a>

    @if (session('success'))
        <p class="alert-primary">{{ session('success') }}</p>
    @endif
    @if ($data->count() > 0)
        <div class="relative overflow-x-auto w-max max-w-full mt-5 sm:rounded-lg">
            <table class="text-sm text-left rtl:text-center text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3">NO</th>
                        <th scope="col" class="px-6 py-3">IMAGE</th>
                        <th scope="col" class="px-6 py-3">NAME</th>
                        <th scope="col" class="px-6 py-3">NOTE</th>
                        <th scope="col" class="px-6 py-3">STATUS</th>
                        <th scope="col" class="px-6 py-3">DATE</th>
                        <th scope="col" class="px-6 py-3">ACTION</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $item)
                        @php
                            $dateString = $item->date;
                            $dateTime = new DateTime($dateString);
                            $formattedDate = $dateTime->format('d F Y H:i:s');
                        @endphp
                        <tr>
                            <td scope="col" class="px-6 py-3">{{ $i++ }}</td>
                            <td scope="col" class="px-6 py-3">
                                <img width="120" class="rounded-md" src="{{ asset('assets/payment/' . $item->bukti) }}"
                                    alt="image-payment">
                            </td>
                            <td scope="col" class="px-6 py-3">{{ $item->nama }}</td>
                            <td scope="col" class="px-6 py-3">{{ $item->note }}</td>
                            <td scope="col" class="capitalize px-6 py-3">
                                @if ($item->status == 'approved')
                                    <span
                                        class="bg-green-400 font-semibold py-1 px-3 text-white rounded-full text-xs">{{ $item->status }}</span>
                                @elseif($item->status == 'unapproved')
                                    <span
                                        class="bg-rose-400 font-semibold py-1 px-3 text-white rounded-full text-xs">{{ $item->status }}</span>
                                @else
                                    <span
                                        class="bg-slate-400 font-semibold py-1 px-3 text-white rounded-full text-xs">{{ $item->status }}</span>
                                @endif
                            </td>
                            <td scope="col" class="px-6 py-3">{{ $formattedDate }}</td>
                            <td scope="col" class="space-y-2 px-6 py-3">
                                <a href="/payment/{{ $item->id }}"
                                    class="flex items-center gap-1 rounded-md bg-slate-400 py-1 px-2 text-xs font-semibold text-white">
                                    <img width="12" src="{{ asset('/assets/icon/view_detail.svg') }}"
                                        alt="icon-viewdetail">
                                    <p>Detail</p>
                                </a>
                                <a href="/payment/edit/{{ $item->id }}"
                                    class="flex items-center gap-1 rounded-md bg-yellow-400 py-1 px-2 text-xs font-semibold text-white">
                                    <img width="12" src="{{ asset('/assets/icon/pencil.svg') }}" alt="icon-viewdetail">
                                    <p>Edit</p>
                                </a>
                                <form action="/payment/delete/{{ $item->id }}" method="post">
                                    @method('DELETE')
                                    @csrf
                                    <button onclick="return confirm('Are you sure?')"
                                        class="flex border-none outline-none items-center gap-1 rounded-md bg-rose-400 py-1 px-2 text-xs font-semibold text-white"
                                        type="submit">
                                        <img width="12" src="{{ asset('/assets/icon/trash.svg') }}"
                                            alt="icon-viewdetail">
                                        <p>Delete</p>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @else
        <p class="font-bold mt-3 text-primary">Data is empty...</p>
    @endif

@endsection
