@extends('layouts.app')
@section('title', 'Buat Survei')
@section('content')
<h4 class="fw-bold mb-4"><i class="fas fa-plus me-2"></i>Buat Survei Baru</h4>
<div class="card">
    <div class="card-body">
        <form action="{{ route('surveys.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label class="fw-bold">Judul Survei *</label>
                <input type="text" name="title" class="form-control" placeholder="Contoh: Survei Kepuasan Q1 2024" required>
            </div>
            <div class="mb-3">
                <label class="fw-bold">Deskripsi</label>
                <textarea name="description" class="form-control" rows="3" placeholder="Deskripsi survei..."></textarea>
            </div>
            <div class="mb-4">
                <div class="form-check">
                    <input type="checkbox" name="is_active" class="form-check-input" id="is_active" checked>
                    <label class="form-check-label" for="is_active">Survei Aktif</label>
                </div>
            </div>
            <h5 class="fw-bold mb-3">Pertanyaan Survei</h5>
            <div id="questions-container">
                <div class="card mb-3 question-item border-primary">
                    <div class="card-body">
                        <div class="mb-2">
                            <label class="fw-bold">Pertanyaan 1</label>
                            <input type="text" name="questions[0][question_text]" class="form-control" placeholder="Tulis pertanyaan..." required>
                        </div>
                        <div class="mb-2">
                            <label class="fw-bold">Tipe Jawaban</label>
                            <select name="questions[0][question_type]" class="form-select question-type">
                                <option value="rating">Rating (1-5)</option>
                                <option value="text">Teks Bebas</option>
                                <option value="multiple_choice">Pilihan Ganda</option>
                            </select>
                        </div>
                        <div class="options-field" style="display:none;">
                            <label class="fw-bold">Pilihan (pisahkan dengan koma)</label>
                            <input type="text" name="questions[0][options]" class="form-control" placeholder="Pilihan A, Pilihan B, Pilihan C">
                        </div>
                    </div>
                </div>
            </div>
            <button type="button" class="btn btn-outline-primary mb-4" id="add-question">
                <i class="fas fa-plus me-2"></i>Tambah Pertanyaan
            </button>
            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-primary"><i class="fas fa-save me-2"></i>Simpan Survei</button>
                <a href="{{ route('surveys.index') }}" class="btn btn-secondary"><i class="fas fa-arrow-left me-2"></i>Kembali</a>
            </div>
        </form>
    </div>
</div>
@endsection
@section('scripts')
<script>
let questionCount = 1;
document.getElementById('add-question').addEventListener('click', function() {
    const container = document.getElementById('questions-container');
    const div = document.createElement('div');
    div.className = 'card mb-3 question-item border-primary';
    div.innerHTML = `
        <div class="card-body">
            <div class="mb-2">
                <label class="fw-bold">Pertanyaan ${questionCount + 1}</label>
                <input type="text" name="questions[${questionCount}][question_text]" class="form-control" placeholder="Tulis pertanyaan..." required>
            </div>
            <div class="mb-2">
                <label class="fw-bold">Tipe Jawaban</label>
                <select name="questions[${questionCount}][question_type]" class="form-select question-type">
                    <option value="rating">Rating (1-5)</option>
                    <option value="text">Teks Bebas</option>
                    <option value="multiple_choice">Pilihan Ganda</option>
                </select>
            </div>
            <div class="options-field" style="display:none;">
                <label class="fw-bold">Pilihan (pisahkan dengan koma)</label>
                <input type="text" name="questions[${questionCount}][options]" class="form-control" placeholder="Pilihan A, Pilihan B, Pilihan C">
            </div>
            <button type="button" class="btn btn-sm btn-danger mt-2 remove-question"><i class="fas fa-trash me-1"></i>Hapus</button>
        </div>`;
    container.appendChild(div);
    questionCount++;
    attachEvents();
});

function attachEvents() {
    document.querySelectorAll('.question-type').forEach(select => {
        select.addEventListener('change', function() {
            const optionsField = this.closest('.card-body').querySelector('.options-field');
            optionsField.style.display = this.value === 'multiple_choice' ? 'block' : 'none';
        });
    });
    document.querySelectorAll('.remove-question').forEach(btn => {
        btn.addEventListener('click', function() {
            this.closest('.question-item').remove();
        });
    });
}
attachEvents();
</script>
@endsection