@extends('layout.admin')

@section('title', 'Admin Account')

@section('content')
    <h5 class="page-title">Account</h5>
    <a href="/admin/account/create" class="btn inline-block">+ Add Account</a>
    @if (Session::has('error'))
        <div class="alert alert-danger" role="alert">
            {{ Session::get('error') }}
        </div>
    @endif
    @if (count($data) > 0)
        <div class="relative overflow-x-auto mt-5 w-max max-w-full sm:rounded-lg">
            <table class="text-sm text-left rtl:text-center text-gray-500 ">
                <thead class="text-xs text-gray-700 uppercase bg-gray-200 ">
                    <tr>
                        <th scope="col" class="px-6 py-3">NO</th>
                        <th scope="col" class="px-6 py-3">NAME</th>
                        <th scope="col" class="px-6 py-3">USERNAME</th>
                        <th scope="col" class="px-6 py-3">JENJANG</th>
                        <th scope="col" class="px-6 py-3">ACTION</th>
                    </tr>
                </thead>
                <tbody>

                    @foreach ($data as $item)
                        <tr class="font-medium">
                            <td scope="col" class="px-6 py-3">{{ $i++ }}</td>
                            <td scope="col" class="px-6 py-3">{{ $item['username'] }}</td>
                            <td scope="col" class="px-6 py-3">{{ $item['fullname'] }}</td>
                            <td scope="col" class="px-6 py-3">{{ $item['tingkatan']['nama'] }}</td>
                            <td scope="col" class="px-6 py-3 space-y-2">
                                <a href="/admin/account/edit/{{ $item['id'] }}"
                                    class="flex items-center gap-1 rounded-md bg-yellow-400 py-1 px-2 text-xs font-semibold text-white">
                                    <img width="12" src="{{ asset('/assets/icon/pencil.svg') }}" alt="icon-viewdetail">
                                    <p>Edit</p>
                                </a>
                                <form action="/admin/account/{{ $item['id'] }}" method="post">
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
        <p class="page-title">Data is empty...</p>
    @endif
@endsection
