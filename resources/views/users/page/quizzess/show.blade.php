@extends('layout.app')

@section('content')
    <div class="container mx-auto p-6">
        <h1 class="text-3xl font-bold text-gray-800 mb-6">Daftar Soal Untuk Kamu</h1>

        <form action="/quizzess/{{ $quiz_id }}" method="POST">
            @csrf

            @foreach ($questions as $questionIndex => $items)
                <div class="mb-6">
                    <p class="text-xl font-semibold text-gray-700">{{$questionIndex + 1}} {{ $items->question }}</p>
                    <ul class="mt-2 space-y-2">
                        @php
                            $options = explode(',', $items->option);
                        @endphp
                        @foreach ($options as $index => $item)
                            <li>
                                <input type="radio" name="answers[{{ $items->id }}]"
                                    value="{{ explode(':', $item)[0] }}"
                                    id="option-{{ $items->id }}-{{ $index }}"
                                    class="mr-2 text-blue-600 focus:ring-blue-500">
                                <label for="option-{{ $items->id }}-{{ $index }}" class="text-gray-700">
                                    {{ chr(65 + $index) }}. {{ explode(':', $item)[1] }}
                                </label>
                            </li>
                        @endforeach
                    </ul>
                </div>
            @endforeach

            <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded transition duration-200">
                Submit
            </button>
        </form>
    </div>
@endsection
