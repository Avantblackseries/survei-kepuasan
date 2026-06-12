@extends('layouts.app')
@section('title', 'Riwayat Survei')
@section('content')
<h4 class="fw-bold mb-4"><i class="fas fa-history me-2"></i>Riwayat Pengisian Survei</h4>
@forelse($responses as $response)
<div class="card mb-3">
    <div class="card-header bg-white d-flex justify-content-between">
        <span class="fw-bold">{{ $response->survey->title }}</span>
        <small class="text-muted">{{ $response->created_at->format('d M Y H:i') }}</small>
    </div>
    <div class="card-body">
        @foreach($response->answers as $answer)
        <div class="mb-2 border-bottom pb-2">
            <p class="fw-bold mb-1 small text-muted">{{ $answer->question->question_text }}</p>
            <p class="mb-0">
                @if($answer->question->question_type === 'rating')
                    @for($i = 1; $i <= 5; $i++)
                        <i class="fas fa-star {{ $i <= $answer->answer_text ? 'text-warning' : 'text-secondary' }}"></i>
                    @endfor
                    <span class="ms-2">{{ $answer->answer_text }}/5</span>
                @else
                    {{ $answer->answer_text }}
                @endif
            </p>
        </div>
        @endforeach
    </div>
</div>
@empty
<div class="card">
    <div class="card-body text-center text-muted py-5">
        <i class="fas fa-inbox fa-3x mb-3"></i>
        <p>Kamu belum mengisi survei apapun.</p>
        <a href="{{ route('user.dashboard') }}" class="btn btn-primary">Isi Survei Sekarang</a>
    </div>
</div>
@endforelse
@endsection