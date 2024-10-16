@extends('layout.app')

@section('title', 'Assignment')

@section('content')
<div class="relative">
    <div class="absolute inset-0 bg-cover bg-center" style="background-image: url('/assets/background/backgroundU/Group.png'); z-index: -1; background-repeat:no-repeat; background-size: auto; width: 1570px; height: 900px; background-position: right;"></div>

    <h5 class="page-title">Your Assignment</h5>
    @if ($data->count() > 0)

        @foreach ($data as $item)
        
            <div class="mt-5">
                <h6 class="font-extrabold text-xl text-primary uppercase">{{ $item['course'] }}</h6>
                <div>
                    @foreach ($item['assignment'] as $task)
                        @if ($task['status'] == 'belum selesai')
                            <a href="/assignment/task/{{ $task['id'] }}" class="block my-3 max-w-xs">
                                <div class="flex justify-between items-center">
                                    <div class="flex items-center gap-3">
                                        <img src="{{ asset('/assets/icon/document_task.svg') }}" alt="icon_documentTask">
                                        <p class="font-bold text-lg text-primary uppercase">{{ $task['nama'] }}</p>
                                    </div>
                                    <span class="bg-slate-500 text-xs text-white font-semibold rounded-full px-3 py-1">Not
                                        Done</span>
                                </div>
                                <p class="text-xs bg-gray-100 w-max p-1 rounded-md m-2"><b>Deadline:</b>
                                    {{ $task['deadline'] }}
                                </p>
                            </a>
                        @else
                            <a href="/assignment/assignment/{{ $task['id'] }}" class="block my-3 max-w-xs">
                                <div class="flex justify-between items-center">
                                    <div class="flex items-center gap-3">
                                        <img src="{{ asset('/assets/icon/document_task.svg') }}" alt="icon_documentTask">
                                        <p class="font-bold text-lg text-primary uppercase">
                                            {{ $task['nama'] }}</p>
                                    </div>
                                    <span
                                        class="{{ $task['status'] == 'selesai' ? 'bg-green-400' : 'bg-rose-400' }} text-xs text-white font-semibold rounded-full px-3 py-1">{{ $task['status'] == 'selesai' ? 'Done' : 'Working Late' }}</span>
                                </div>
                                <p class="text-xs bg-gray-100 w-max p-1 rounded-md m-2"><b>Deadline:</b>
                                    {{ $task['deadline'] }}
                                </p>
                            </a>
                        @endif
                    @endforeach
                </div>
            </div>
        @endforeach
    @else
        <h6 class="font-bold text-primary">Assignment is Empty</h6>
    @endif
@endsection
