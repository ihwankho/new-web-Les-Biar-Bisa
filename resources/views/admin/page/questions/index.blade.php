@extends('layout.admin')

@section('content')
    <div class="flex justify-start gap-3">
        <div class="container w-1/2 mx-auto p-6">
            <h1 class="text-3xl font-bold mb-6">Daftar Pertanyaan untuk Quiz: {{ $quiz->name }}</h1>

            <!-- Pesan Sukses -->
            @if (session('success_quiz'))
                <div class="bg-green-500 text-white p-4 rounded-md mb-6">
                    {{ session('success_quiz') }}
                </div>
            @endif

            <!-- Tombol Tandai Quiz Siap/Tidak Siap -->
            <form action="/admin/quizzes/{{ $quiz->id }}" method="GET" class="mb-6">
                <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white py-2 px-4 rounded-md">
                    {{ $quiz->is_ready ? 'Tandai Tidak Siap' : 'Tandai Siap' }}
                </button>
            </form>

            <!-- Tambah Soal Jika Quiz Belum Siap -->
            @if (!$quiz->is_ready)
                <div class="bg-gray-100 p-6 rounded-md mb-8">
                    <h2 class="text-lg font-semibold mb-4">Tambah Soal</h2>
                    <form action="{{ route('questions.store', ['quiz' => $quiz->id]) }}" method="POST" class="space-y-4">
                        @csrf
                        <!-- Input Soal -->
                        <div>
                            <label for="question" class="block text-sm font-medium">Nama Soal</label>
                            <input type="text" name="question" id="question"
                                class="mt-1 p-2 w-full border border-gray-300 rounded-md" required>
                        </div>

                        <!-- Input Pilihan Jawaban -->
                        @for ($i = 1; $i <= 4; $i++)
                            <div>
                                <label for="pilihan{{ $i }}" class="block text-sm font-medium">Pilihan
                                    {{ $i }}</label>
                                <input type="text" name="pilihan_{{ $i }}" id="pilihan{{ $i }}"
                                    class="mt-1 p-2 w-full border border-gray-300 rounded-md" required>
                            </div>
                        @endfor

                        <!-- Pilihan Jawaban Benar -->
                        <div>
                            <label class="block text-sm font-medium">Jawaban Benar</label>
                            <div class="flex items-center space-x-4 mt-1">
                                @foreach (['A' => 'pilihan_1', 'B' => 'pilihan_2', 'C' => 'pilihan_3', 'D' => 'pilihan_4'] as $key => $value)
                                    <label class="inline-flex items-center">
                                        <input type="radio" name="jawaban_benar" value="{{ $value }}"
                                            class="mr-2" required>
                                        <span>{{ $key }}</span>
                                    </label>
                                @endforeach
                            </div>
                        </div>

                        <!-- Tombol Simpan Soal -->
                        <button type="submit" class="bg-primary text-white py-2 px-4 rounded-md">Simpan Soal</button>
                    </form>
                </div>
            @endif

            <!-- Daftar Pertanyaan -->
            @if ($questions->isEmpty())
                <p>Tidak ada pertanyaan dalam quiz ini.</p>
            @else
                <ol class="list-decimal pl-5 space-y-3">
                    @foreach ($questions as $question)
                        <li>
                            <p class="text-lg font-medium">{{ $question->question }}</p>
                            @php
                                $options = explode(',', $question->option);
                                $is_correct = null;
                                foreach ($options as $index => $value) {
                                    if (explode(':', $value)[0] == $question->is_correct) {
                                        $is_correct = chr(65 + $index);
                                    }
                                }
                            @endphp
                            @foreach ($options as $index => $answer)
                                <p>{{ chr(65 + $index) }}. {{ explode(':', $answer)[1] }}</p>
                            @endforeach
                            <p class="font-semibold">Jawaban Benar: {{ $is_correct }}</p>

                            @if (!$quiz->is_ready)
                                <form action="{{ route('questions.destroy', $question->id) }}" method="POST"
                                    class="inline-block mt-2">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="bg-red-500 hover:bg-red-600 text-white py-2 px-4 rounded-md"
                                        onclick="return confirm('Apakah Anda yakin ingin menghapus soal ini?')">Hapus
                                        Soal</button>
                                </form>
                            @endif
                        </li>
                    @endforeach
                </ol>
            @endif
        </div>
        <div class="w-1/2">
            <!-- List Pengguna yang Mengerjakan Quiz -->
            <h3 class="text-xl font-semibold mt-8 mb-4">List yang sudah mengerjakan</h3>
            <ul class="list-decimal pl-5">
                @foreach ($answers as $answer)
                    <li>{{ $answer->user->fullname }} dengan nilai {{ $answer->score }}</li>
                @endforeach
            </ul>
        </div>
    </div>
@endsection
