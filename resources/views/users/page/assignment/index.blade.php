@extends('layout.app')

@section('title', 'Assignment')

@section('content')
    <h5 class="page-title">Your Assignment</h5>
    <div class="mt-5">
        <h6 class="font-extrabold text-xl text-primary">VOCABULARY ENGLISH LANGUAGE</h6>
        <div>
            <div class="my-3 max-w-xs">
                <div class="flex justify-between items-center">
                    <div class="flex items-center gap-3">
                        <img src="{{ asset('/assets/icon/document_task.svg') }}" alt="icon_documentTask">
                        <p class="font-bold text-lg text-primary">QUIZ 1</p>
                    </div>
                    <span class="bg-primary text-xs text-white font-semibold rounded-full px-3 py-1">Done</span>
                </div>
                <p class="text-xs bg-gray-100 w-max p-1 rounded-md m-2"><b>Deadline:</b> 07 November 2023 20:00</p>
            </div>
            <div class="my-3 max-w-xs">
                <div class="flex justify-between items-center">
                    <div class="flex items-center gap-3">
                        <img src="{{ asset('/assets/icon/document_task.svg') }}" alt="icon_documentTask">
                        <p class="font-bold text-lg text-primary">QUIZ 1</p>
                    </div>
                    <span class="bg-primary text-xs text-white font-semibold rounded-full px-3 py-1">Done</span>
                </div>
                <p class="text-xs bg-gray-100 w-max p-1 rounded-md m-2"><b>Deadline:</b> 07 November 2023 20:00</p>
            </div>
        </div>
    </div>
@endsection
