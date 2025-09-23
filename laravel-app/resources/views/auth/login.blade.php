@extends('layouts.master')

@section('title','Login / Register')

@push('styles')
<style>
  body {
    height: 110vh;
    margin: 0;
    display: flex;
    justify-content: center;
    align-items: center;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    background: linear-gradient(to right, rgba(255, 153, 102, 0.4), rgba(102, 153, 255, 0.4)),
                url("https://images.unsplash.com/photo-1501785888041-af3ef285b470?auto=format&fit=crop&w=1920&q=80");
    background-size: cover;
    background-position: center;
  }
  .auth-box {
    width: 420px;
    padding: 25px 25px 20px;
    border-radius: 16px;
    background: rgba(255, 255, 255, 0.78);
    backdrop-filter: blur(10px);
    -webkit-backdrop-filter: blur(10px);
    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.25);
    text-align: left;
  }
  .nav-pills {
    background: #f1f1f1;
    border-radius: 25px;
    padding: 3px;
    margin-bottom: 20px;
  }
  .nav-pills .nav-link {
    border-radius: 20px;
    font-weight: 500;
    color: #555;
  }
  .nav-pills .nav-link.active {
    background-color: #fff;
    color: #000;
    box-shadow: 0 2px 6px rgba(0,0,0,0.1);
  }
  .form-control {
    border-radius: 10px;
    border: 1px solid #ddd;
    padding: 10px;
    font-size: 14px;
  }
  .form-label {
    font-size: 14px;
    font-weight: 500;
    margin-bottom: 4px;
  }
  .btn-signin {
    background-color: #000;
    color: #fff;
    width: 100%;
    border-radius: 10px;
    padding: 10px;
    font-weight: 500;
  }
  .btn-signin:hover { background-color: #222; }
  .demo-info {
    background: linear-gradient(135deg, rgba(255,153,102,0.9), rgba(102,153,255,0.9));
    color: #fff;
    padding: 10px;
    border-radius: 12px;
    margin-top: 18px;
    text-align: center;
    font-size: 14px;
    font-weight: 500;
  }
  .title {
    text-align: center;
    margin-bottom: 15px;
  }
  .text-danger {
    font-size: 13px;
    margin-top: 4px;
    display: block;
  }
</style>
@endpush

@section('content')
<div class="auth-container">
  <!-- Heading -->
  <div class="title">
    <h4 class="fw-bold">Social</h4>
    <p class="text-muted">Connect with friends and share your moments</p>
  </div>

  <div class="auth-box">
    <!-- Nav pills -->
    <ul class="nav nav-pills justify-content-between" id="pills-tab" role="tablist">
      <li class="nav-item flex-fill" role="presentation">
        <button class="nav-link active w-100" id="login-tab" data-bs-toggle="pill" data-bs-target="#login" type="button" role="tab">Login</button>
      </li>
      <li class="nav-item flex-fill" role="presentation">
        <button class="nav-link w-100" id="register-tab" data-bs-toggle="pill" data-bs-target="#register" type="button" role="tab">Register</button>
      </li>
    </ul>

    <!-- Tab content -->
    <div class="tab-content">
      <!-- Login Tab -->
      <div class="tab-pane fade show active" id="login" role="tabpanel">
        <h6 class="fw-bold mb-2">Welcome back</h6>
        <p class="text-muted small mb-3">Enter your credentials to access your account</p>
        <form method="POST" action="{{ route('auth.login') }}">
          @csrf
          <div class="mb-3">
            <label class="form-label">Email or Username</label>
            <input type="text" name="login" class="form-control @error('login') is-invalid @enderror" placeholder="Enter your email or username" value="{{ old('login') }}">
            @error('login')
              <span class="text-danger">{{ $message }}</span>
            @enderror
          </div>
          <div class="mb-3">
            <label class="form-label">Password</label>
            <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="Enter your password">
            @error('password')
              <span class="text-danger">{{ $message }}</span>
            @enderror
          </div>
          <button type="submit" class="btn btn-signin">Sign in</button>
        </form>
      </div>

      <!-- Register Tab -->
      <div class="tab-pane fade" id="register" role="tabpanel">
        <h6 class="fw-bold mb-2">Create Account</h6>
        <p class="text-muted small mb-3">Join our community and start sharing</p>
        <form method="POST" action="{{ route('auth.register') }}">
          @csrf
          <div class="mb-3">
            <label class="form-label">Email</label>
            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" placeholder="Enter your email" value="{{ old('email') }}">
            @error('email')
              <span class="text-danger">{{ $message }}</span>
            @enderror
          </div>
          <div class="mb-3">
            <label class="form-label">Username</label>
            <input type="text" name="username" class="form-control @error('username') is-invalid @enderror" placeholder="Choose a username" value="{{ old('username') }}">
            @error('username')
              <span class="text-danger">{{ $message }}</span>
            @enderror
          </div>
          <div class="mb-3">
            <label class="form-label">Password</label>
            <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="Create a password">
            @error('password')
              <span class="text-danger">{{ $message }}</span>
            @enderror
          </div>
          <div class="mb-3">
            <label class="form-label">Profile Picture URL (optional)</label>
            <input type="text" name="profile_pic" class="form-control @error('profile_pic') is-invalid @enderror" placeholder="https://example.com/your-photo.jpg" value="{{ old('profile_pic') }}">
            @error('profile_pic')
              <span class="text-danger">{{ $message }}</span>
            @enderror
          </div>
          <button type="submit" class="btn btn-signin">Register</button>
        </form>
      </div>
    </div>
  </div>

  <!-- Demo info inside box with gradient -->
  <div class="demo-info">
    Demo account for testing:<br>
    Email: <strong>demo@example.com</strong> , Password: <strong>demo123</strong>
  </div>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener("DOMContentLoaded", function () {
        // If register form has errors, switch to register tab
        let hasRegisterError = {{ $errors->has('email') || $errors->has('username') || $errors->has('password') || $errors->has('profile_pic') ? 'true' : 'false' }};
        let activeTab = hasRegisterError ? 'register' : @json(session('tab', 'login'));

        let triggerEl = document.querySelector(`#${activeTab}-tab`);
        if (triggerEl) {
            new bootstrap.Tab(triggerEl).show();
        }
    });
</script>
@endpush