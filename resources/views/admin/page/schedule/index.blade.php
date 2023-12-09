@extends('layout.admin')

@section('title', 'Admin Schedule')

@section('content')
    <a href="/admin/schedule/create" class="btn mb-3 inline-block">+ Add Schedule Image</a>
    @if ($data->count() > 0)
        @foreach ($data as $item)
            <p class="page-title">{{ $item['nama'] }}</p>
            <div class="flex gap-3 items-center">
                <div class="card-modify w-max mb-3">
                    <img width="426" class="block" src="{{ $item['schedule'] }}" alt="image-schedule">
                </div>
                <div class="space-y-3">
                    <a href="/admin/schedule/edit/{{ $item['id'] }}"
                        class="p-2 text-xs font-semibold bg-orange-500 flex gap-2 w-max text-white rounded-md"><img
                            src="{{ asset('/assets/icon/exchange.svg') }}" alt="exchange-icon">
                        Change</a>
                    <form action="/admin/schedule/{{ $item['id'] }}" method="post">
                        @method('DELETE')
                        @csrf
                        <button onclick="return confirm('Are you sure?')" type="submit"
                            class="p-2 text-xs font-semibold bg-rose-500 flex gap-2 w-max text-white rounded-md"><img
                                src="{{ asset('/assets/icon/remove.svg') }}" alt="remove-icon"> Remove</button>
                    </form>
                </div>
            </div>
        @endforeach
    @else
        <p class="page-title">Data schedule is Empty</p>
    @endif
@endsection
