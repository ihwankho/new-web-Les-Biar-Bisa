@extends('layout.admin')

@section('title', 'Admin Account')

@section('content')
    <h5 class="page-title">Account</h5>
    <a href="#" class="btn inline-block">+ Add Account</a>
    <div class="relative overflow-x-auto w-max max-w-full sm:rounded-lg">
        <table class="text-sm text-left rtl:text-center text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">NO</th>
                    <th scope="col" class="px-6 py-3">NAME</th>
                    <th scope="col" class="px-6 py-3">USERNAME</th>
                    <th scope="col" class="px-6 py-3">JENJANG</th>
                </tr>
            </thead>
            <tbody>
                <tr class="font-medium">
                    <td scope="col" class="px-6 py-3">1</td>
                    <td scope="col" class="px-6 py-3">FILFIA ANTIKA A.</td>
                    <td scope="col" class="px-6 py-3">@filfia</td>
                    <td scope="col" class="px-6 py-3">SMA</td>
                </tr>
            </tbody>
        </table>
    </div>
@endsection
