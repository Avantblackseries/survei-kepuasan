@extends('layouts.app')
@section('title', 'Hasil Survei')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="fw-bold"><i class="fas fa-chart-bar me-2"></i>Hasil: {{ $survey->title }}</h4>
    <a href="{{ route('surveys.index') }}" class="btn btn-secondary"><i class="fas fa-arrow-left me-2"></i>Kembali</a>
</div>
<div class="row g-3 mb-4">
    <div class="col-md-4">
        <div class="card text-center p-3">
            <h2 class="fw-bold text-primary">{{ $survey->responses->count() }}</h2>
            <p class="text-muted mb-0">Total Responden</p>
        </div>
    </div>
</div>
@foreach($survey->questions as $question)
<div class="card mb-3">
    <div class="card-header bg-white fw-bold">
        <i class="fas fa-question-circle me-2 text-primary"></i>{{ $question->question_text }}
        <span class="badge bg-secondary ms-2">{{ $question->question_type }}</span>
    </div>
    <div class="card-body">
        @if($question->question_type === 'rating')
            <div class="d-flex align-items-center gap-3">
                <h2 class="fw-bold text-warning mb-0">{{ $avgRatings[$question->id] ?? 0 }}</h2>
                <div>
                    @for($i = 1; $i <= 5; $i++)
                        <i class="fas fa-star {{ $i <= ($avgRatings[$question->id] ?? 0) ? 'text-warning' : 'text-secondary' }}"></i>
                    @endfor
                    <p class="text-muted mb-0 small">Rata-rata dari {{ $question->answers->count() }} jawaban</p>
                </div>
            </div>
        @elseif($question->question_type === 'multiple_choice')
            @php
                $answerCounts = $question->answers->groupBy('answer_text')->map->count();
                $total = $question->answers->count();
            @endphp
            @foreach($answerCounts as $choice => $count)
                <div class="mb-2">
                    <div class="d-flex justify-content-between">
                        <span>{{ $choice }}</span>
                        <span>{{ $count }} ({{ $total > 0 ? round($count/$total*100) : 0 }}%)</span>
                    </div>
                    <div class="progress">
                        <div class="progress-bar bg-primary" style="width: {{ $total > 0 ? $count/$total*100 : 0 }}%"></div>
                    </div>
                </div>
            @endforeach
        @else
            <div style="max-height:200px; overflow-y:auto;">
                @foreach($question->answers as $answer)
                    <div class="border-bottom py-2">
                        <i class="fas fa-comment-dots me-2 text-muted"></i>{{ $answer->answer_text }}
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</div>
@endforeach
@endsection