@extends('layout.admin')

@section('content')
<div class="container">
    <h1>Tambah Soal untuk Quiz: {{ $quiz->name }}</h1>

    <form action="/" method="POST">
        @csrf
        <input type="hidden" name="quiz_id" value="{{ $quiz->id }}">

        <div class="form-group">
            <label for="question">Nama Soal</label>
            <input type="text" class="form-control" id="question" name="question" required>
        </div>

        <div class="form-group">
            <label for="type">Jenis Soal</label>
            <select class="form-control" id="type" name="type" required>
                <option value="multiple_choice">Pilihan Ganda</option>
                <option value="essay">Essay</option>
            </select>
        </div>

        <div id="multipleChoiceOptions" style="display: none;">
            <h4>Pilihan Ganda</h4>
            <div class="form-group">
                <label for="option1">Pilihan 1</label>
                <input type="text" class="form-control" name="options[]" required>
            </div>
            <div class="form-group">
                <label for="option2">Pilihan 2</label>
                <input type="text" class="form-control" name="options[]" required>
            </div>
            <button type="button" class="btn btn-secondary" id="addOption">Tambah Pilihan</button>
        </div>

        <div class="form-group" id="essayOptions" style="display: none;">
            <label for="essay">Jawaban Essay</label>
            <textarea class="form-control" name="essay_answer" rows="3" required></textarea>
        </div>

        <button type="submit" class="btn btn-primary">Simpan Soal</button>
    </form>
</div>

<script>
    document.getElementById('type').addEventListener('change', function() {
        const selectedType = this.value;
        const multipleChoiceOptions = document.getElementById('multipleChoiceOptions');
        const essayOptions = document.getElementById('essayOptions');

        if (selectedType === 'multiple_choice') {
            multipleChoiceOptions.style.display = 'block';
            essayOptions.style.display = 'none';
        } else {
            multipleChoiceOptions.style.display = 'none';
            essayOptions.style.display = 'block';
        }
    });

    document.getElementById('addOption').addEventListener('click', function() {
        const newOption = document.createElement('div');
        newOption.className = 'form-group';
        newOption.innerHTML = `
            <label for="option">Pilihan</label>
            <input type="text" class="form-control" name="options[]" required>
        `;
        document.getElementById('multipleChoiceOptions').appendChild(newOption);
    });
</script>
@endsection
