<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - SurveiKu</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body { background: linear-gradient(135deg, #1565C0, #42A5F5); min-height: 100vh; display: flex; align-items: center; }
        .login-card { border-radius: 20px; box-shadow: 0 20px 60px rgba(0,0,0,0.2); }
        .login-header { background: linear-gradient(135deg, #1565C0, #1976D2); border-radius: 20px 20px 0 0; padding: 30px; text-align: center; }
        .info-box { background: #f8f9fa; border-radius: 8px; padding: 12px; font-size: 0.85rem; }
    </style>
</head>
<body>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="card login-card border-0">
                <div class="login-header text-white">
                    <i class="fas fa-chart-bar fa-3x mb-3"></i>
                    <h3 class="fw-bold mb-1">SurveiKu</h3>
                    <p class="mb-0 opacity-75">Sistem Survei Kepuasan Pelanggan</p>
                </div>
                <div class="card-body p-4">
                    @if($errors->any())
                        <div class="alert alert-danger">
                            <i class="fas fa-exclamation-circle me-2"></i>{{ $errors->first() }}
                        </div>
                    @endif
                    <form action="{{ route('login') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label fw-bold">Email</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                                <input type="email" name="email" class="form-control" placeholder="Masukkan email" value="{{ old('email') }}" required>
                            </div>
                        </div>
                        <div class="mb-4">
                            <label class="form-label fw-bold">Password</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-lock"></i></span>
                                <input type="password" name="password" class="form-control" placeholder="Masukkan password" required>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary w-100 py-2 fw-bold">
                            <i class="fas fa-sign-in-alt me-2"></i>Masuk
                        </button>
                    </form>
                    <hr>
                    <div class="info-box">
                        <p class="fw-bold mb-2"><i class="fas fa-info-circle me-1"></i>Akun Demo:</p>
                        <p class="mb-1"><strong>Admin:</strong> admin@survei.com / 123</p>
                        <p class="mb-0"><strong>User:</strong> user@survei.com / 321</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>