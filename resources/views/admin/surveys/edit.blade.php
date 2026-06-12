@extends('layouts.app')
@section('title', 'Edit Survei')
@section('content')
<h4 class="fw-bold mb-4"><i class="fas fa-edit me-2"></i>Edit Survei</h4>
<div class="card">
    <div class="card-body">
        <form action="{{ route('surveys.update', $survey) }}" method="POST">
            @csrf @method('PUT')
            <div class="mb-3">
                <label class="fw-bold">Judul Survei *</label>
                <input type="text" name="title" class="form-control" value="{{ $survey->title }}" required>
            </div>
            <div class="mb-3">
                <label class="fw-bold">Deskripsi</label>
                <textarea name="description" class="form-control" rows="3">{{ $survey->description }}</textarea>
            </div>
            <div class="mb-4">
                <div class="form-check">
                    <input type="checkbox" name="is_active" class="form-check-input" id="is_active" {{ $survey->is_active ? 'checked' : '' }}>
                    <label class="form-check-label" for="is_active">Survei Aktif</label>
                </div>
            </div>
            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-warning"><i class="fas fa-save me-2"></i>Simpan Perubahan</button>
                <a href="{{ route('surveys.index') }}" class="btn btn-secondary"><i class="fas fa-arrow-left me-2"></i>Kembali</a>
            </div>
        </form>
    </div>
</div>
@endsection