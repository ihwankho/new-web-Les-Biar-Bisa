@extends('layout.app')

@section('content')
<div class="container mx-auto p-6">
    <div class="bg-white shadow-md rounded-lg p-6 text-center">
        <h1 class="text-3xl font-bold text-gray-800 mb-4">Hasil Kuis</h1>
        <p class="text-lg text-gray-700">Skor Kamu: <span class="font-semibold">{{ $score }}</span> dari <span class="font-semibold">{{ $total }}</span> soal.</p>

        <a href="/quizzess" class="inline-block bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded mt-6 transition duration-200">
            Kembali ke Halaman Quiz
        </a>
    </div>
</div>
@endsection
