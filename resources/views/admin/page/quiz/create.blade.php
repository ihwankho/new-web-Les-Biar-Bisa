@extends('layout.admin')

@section('content')
<div class="container">
    <h1 class="text-2xl font-bold mb-5">Buat Quiz Baru</h1>

    <form action="{{ route('quiz.store') }}" method="POST">
        @csrf
        <div class="mb-4">
            <label for="name" class="block text-gray-700">Nama Quiz:</label>
            <input type="text" id="name" name="name" class="border border-gray-300 p-2 w-full" required>
        </div>
    
        <div class="mb-4">
            <label for="tingkatan" class="block text-gray-700">Tingkatan:</label>
            <select id="tingkatan" name="id_tingkatan" class="border border-gray-300 p-2 w-full" required>
                @foreach($tingkatan as $t)
                    <option value="{{ $t->id }}">{{ $t->nama }}</option>
                @endforeach
            </select>
        </div>
    
        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Simpan</button>
    </form>
    
</div>
@endsection
