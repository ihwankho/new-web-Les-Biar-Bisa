@extends('layout.admin')

@section('content')
<div class="container mx-auto p-6">
    <h1 class="text-3xl font-bold text-gray-800 mb-6">Daftar Quiz</h1>

    <!-- Tombol Buat Quiz Baru -->
    <a href="{{ route('quiz.create') }}" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded mb-6 inline-block transition duration-200">
        Buat Quiz Baru
    </a>

    <!-- Tabel Quiz -->
    <table class="min-w-full bg-white shadow-md rounded-lg overflow-hidden">
        <thead>
            <tr class="bg-gray-100">
                <th class="text-left text-gray-600 font-semibold uppercase px-6 py-3">Nama Quiz</th>
                <th class="text-left text-gray-600 font-semibold uppercase px-6 py-3">Tingkatan</th>
                <th class="text-left text-gray-600 font-semibold uppercase px-6 py-3">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($quizzes as $quiz)
                <tr class="border-b">
                    <td class="px-6 py-4 text-gray-700">{{ $quiz->name }}</td>
                    <td class="px-6 py-4 text-gray-700">{{ $quiz->tingkatan->nama }}</td>
                    <td class="px-6 py-4">
                        <div class="flex space-x-3">
                            <!-- Tombol Hapus Quiz -->
                            <form action="{{ route('quiz.destroy', $quiz->id) }}" method="POST" onsubmit="return confirm('Apakah kamu yakin ingin menghapus quiz ini?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-4 rounded transition duration-200">
                                    Hapus
                                </button>
                            </form>

                            <!-- Tombol Lihat Quiz -->
                            <a href="{{ route('questions.index', $quiz->id) }}" class="bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-4 rounded transition duration-200">
                                Lihat Quiz
                            </a>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
