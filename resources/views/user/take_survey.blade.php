@extends('layouts.app')
@section('title', 'Isi Survei')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="fw-bold"><i class="fas fa-pen me-2"></i>{{ $survey->title }}</h4>
</div>
<div class="alert alert-info">
    <i class="fas fa-info-circle me-2"></i>{{ $survey->description }}
</div>
<form action="{{ route('survey.submit', $survey) }}" method="POST">
    @csrf
    @foreach($survey->questions as $i => $question)
    <div class="card mb-3">
        <div class="card-header bg-white fw-bold">
            {{ $i+1 }}. {{ $question->question_text }}
        </div>
        <div class="card-body">
            @if($question->question_type === 'rating')
                <p class="text-muted small mb-2">Pilih rating 1 (Sangat Buruk) - 5 (Sangat Baik)</p>
                <div class="d-flex gap-3">
                    @for($r = 1; $r <= 5; $r++)
                    <div class="form-check">
                        <input type="radio" name="answers[{{ $question->id }}]" value="{{ $r }}"
                            class="form-check-input" id="q{{ $question->id }}r{{ $r }}" required>
                        <label class="form-check-label" for="q{{ $question->id }}r{{ $r }}">
                            <i class="fas fa-star text-warning"></i> {{ $r }}
                        </label>
                    </div>
                    @endfor
                </div>
            @elseif($question->question_type === 'multiple_choice')
                @foreach($question->options_array as $option)
                <div class="form-check">
                    <input type="radio" name="answers[{{ $question->id }}]" value="{{ trim($option) }}"
                        class="form-check-input" required>
                    <label class="form-check-label">{{ trim($option) }}</label>
                </div>
                @endforeach
            @else
                <textarea name="answers[{{ $question->id }}]" class="form-control" rows="3"
                    placeholder="Tulis jawaban Anda..." required></textarea>
            @endif
        </div>
    </div>
    @endforeach
    <div class="d-flex gap-2">
        <button type="submit" class="btn btn-success btn-lg"
            onclick="return confirm('Yakin ingin mengirim survei ini?')">
            <i class="fas fa-paper-plane me-2"></i>Kirim Survei
        </button>
        <a href="{{ route('user.dashboard') }}" class="btn btn-secondary btn-lg">
            <i class="fas fa-arrow-left me-2"></i>Kembali
        </a>
    </div>
</form>
@endsection