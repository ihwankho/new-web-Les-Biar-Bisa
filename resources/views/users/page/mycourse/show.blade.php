@extends('layout.app')

@section('title', 'Detail Course')

@section('content')
    <h1 class="font-extrabold text-lg text-primary uppercase">{{ $course->nama }}</h1>
    <p class="font-semibold text-primary">{{ $course->deskripsi }}</p>
    <div class="mt-5 grid grid-cols-2 gap-3 justify-between">
        <div>
            @if ($file_course->count() > 0)
                @foreach ($file_course as $file)
                    <a class="flex gap-3 font-medium text-primary items-center"
                        href="{{ asset('/assets/course/materi/' . $file->file) }}" download="{{ $file->file }}">
                        <img src="{{ asset('/assets/icon/file.svg') }}" alt="file-icon">
                        <p>{{ $file->nama }}</p>
                    </a>
                @endforeach
            @else
                <h6 class="font-semibold text-primary">Materi kosong...</h6>
            @endif
        </div>
        <div>
            <h3 class="font-extrabold text-xl text-primary">Task</h3>
            @if ($assignment->count() > 0)
                @foreach ($assignment as $task)
                    <a href="#" class="block my-3 max-w-xs">
                        <div class="flex justify-between items-center">
                            <div class="flex items-center gap-3">
                                <img src="{{ asset('/assets/icon/document_task.svg') }}" alt="icon_documentTask">
                                <p class="font-bold text-lg text-primary uppercase">{{ $task->nama }}</p>
                            </div>
                            <span class="bg-primary text-xs text-white font-semibold rounded-full px-3 py-1">Done</span>
                        </div>
                        <p class="text-xs bg-gray-100 w-max p-1 rounded-md m-2"><b>Deadline:</b> 07 November 2023 20:00</p>
                    </a>
                @endforeach
            @else
                <h6 class="font-semibold text-primary">Task kosong...</h6>
            @endif
        </div>
    </div>
@endsection
