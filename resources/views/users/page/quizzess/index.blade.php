@extends('layout.app')

@section('content')
    <div class="container mx-auto p-6">
        <h1 class="text-3xl font-bold text-gray-800 mb-6">Daftar Quiz Untuk Kamu</h1>

        @foreach ($quiz as $item)
            @if ($item['is_ready'])
                <div class="bg-white shadow-md rounded-lg p-5 mb-5">
                    <h2 class="text-xl font-semibold text-gray-700">{{ $item['name'] }}</h2>
                    <p class="text-gray-500">Jumlah Soal: <span class="font-medium">{{ $item['number_of_questions'] }}</span> Soal</p>

                    <div class="mt-4">
                        @if (isset($item['score']) && $item['score'] !== null)
                            <p class="text-green-600 font-medium">Sudah dikerjakan dengan nilai {{ $item['score'] }}</p>
                        @else
                            <a href="/quizzess/{{ $item['id_quiz'] }}"
                               class="inline-block bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded transition duration-200">
                                Kerjakan Sekarang
                            </a>
                        @endif
                    </div>
                </div>
            @endif
        @endforeach
    </div>
@endsection
