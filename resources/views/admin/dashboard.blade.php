@extends('layouts.app')
@section('title', 'Dashboard Admin')
@section('content')
<h4 class="fw-bold mb-4"><i class="fas fa-tachometer-alt me-2"></i>Dashboard Admin</h4>
<div class="row g-3 mb-4">
    <div class="col-md-4">
        <div class="stat-card" style="background: linear-gradient(135deg, #1976D2, #42A5F5);">
            <i class="fas fa-clipboard-list fa-2x mb-2"></i>
            <h2 class="fw-bold">{{ $totalSurveys }}</h2>
            <p class="mb-0">Total Survei</p>
        </div>
    </div>
    <div class="col-md-4">
        <div class="stat-card" style="background: linear-gradient(135deg, #2E7D32, #4CAF50);">
            <i class="fas fa-poll fa-2x mb-2"></i>
            <h2 class="fw-bold">{{ $totalResponses }}</h2>
            <p class="mb-0">Total Respons</p>
        </div>
    </div>
    <div class="col-md-4">
        <div class="stat-card" style="background: linear-gradient(135deg, #E65100, #FF9800);">
            <i class="fas fa-users fa-2x mb-2"></i>
            <h2 class="fw-bold">{{ $totalUsers }}</h2>
            <p class="mb-0">Total User</p>
        </div>
    </div>
</div>
<div class="card">
    <div class="card-header bg-white fw-bold">
        <i class="fas fa-list me-2"></i>Daftar Survei
    </div>
    <div class="card-body">
        <table class="table table-hover">
            <thead style="background:#1976D2; color:white;">
                <tr><th>Judul Survei</th><th>Status</th><th>Respons</th><th>Aksi</th></tr>
            </thead>
            <tbody>
                @forelse($surveys as $survey)
                <tr>
                    <td>{{ $survey->title }}</td>
                    <td>
                        <span class="badge bg-{{ $survey->is_active ? 'success' : 'secondary' }}">
                            {{ $survey->is_active ? 'Aktif' : 'Nonaktif' }}
                        </span>
                    </td>
                    <td><span class="badge bg-primary">{{ $survey->responses_count }} respons</span></td>
                    <td>
                        <a href="{{ route('surveys.show', $survey) }}" class="btn btn-sm btn-info text-white">
                            <i class="fas fa-eye"></i> Lihat Hasil
                        </a>
                    </td>
                </tr>
                @empty
                <tr><td colspan="4" class="text-center text-muted">Belum ada survei</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection