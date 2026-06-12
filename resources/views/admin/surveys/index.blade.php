@extends('layouts.app')
@section('title', 'Kelola Survei')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="fw-bold"><i class="fas fa-clipboard-list me-2"></i>Kelola Survei</h4>
    <a href="{{ route('surveys.create') }}" class="btn btn-primary">
        <i class="fas fa-plus me-2"></i>Buat Survei Baru
    </a>
</div>
<div class="card">
    <div class="card-body">
        <table class="table table-hover">
            <thead style="background:#1976D2; color:white;">
                <tr><th>No</th><th>Judul</th><th>Status</th><th>Respons</th><th>Aksi</th></tr>
            </thead>
            <tbody>
                @forelse($surveys as $i => $survey)
                <tr>
                    <td>{{ $i+1 }}</td>
                    <td>{{ $survey->title }}</td>
                    <td>
                        <span class="badge bg-{{ $survey->is_active ? 'success' : 'secondary' }}">
                            {{ $survey->is_active ? 'Aktif' : 'Nonaktif' }}
                        </span>
                    </td>
                    <td>{{ $survey->responses_count }}</td>
                    <td>
                        <a href="{{ route('surveys.show', $survey) }}" class="btn btn-sm btn-info text-white"><i class="fas fa-chart-bar"></i></a>
                        <a href="{{ route('surveys.edit', $survey) }}" class="btn btn-sm btn-warning"><i class="fas fa-edit"></i></a>
                        <form action="{{ route('surveys.destroy', $survey) }}" method="POST" class="d-inline"
                            onsubmit="return confirm('Yakin hapus survei ini?')">
                            @csrf @method('DELETE')
                            <button class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr><td colspan="5" class="text-center text-muted">Belum ada survei</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection