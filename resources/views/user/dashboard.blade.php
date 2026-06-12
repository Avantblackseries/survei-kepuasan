@extends('layouts.app')
@section('title', 'Dashboard User')
@section('content')
<h4 class="fw-bold mb-2"><i class="fas fa-home me-2"></i>Selamat Datang, {{ Auth::user()->name }}!</h4>
<p class="text-muted mb-4">Berikut survei yang tersedia untuk kamu isi.</p>
@forelse($surveys as $survey)
<div class="card mb-3">
    <div class="card-body">
        <div class="d-flex justify-content-between align-items-start">
            <div>
                <h5 class="fw-bold">{{ $survey->title }}</h5>
                <p class="text-muted mb-2">{{ $survey->description }}</p>
                <small class="text-muted">
                    <i class="fas fa-question-circle me-1"></i>{{ $survey->questions->count() }} pertanyaan
                </small>
            </div>
            <div>
                @if(in_array($survey->id, $completedSurveyIds))
                    <span class="badge bg-success p-2"><i class="fas fa-check me-1"></i>Sudah Diisi</span>
                @else
                    <a href="{{ route('survey.take', $survey) }}" class="btn btn-primary">
                        <i class="fas fa-pen me-2"></i>Isi Survei
                    </a>
                @endif
            </div>
        </div>
    </div>
</div>
@empty
<div class="card">
    <div class="card-body text-center text-muted py-5">
        <i class="fas fa-clipboard fa-3x mb-3"></i>
        <p>Belum ada survei yang tersedia.</p>
    </div>
</div>
@endforelse
@endsection