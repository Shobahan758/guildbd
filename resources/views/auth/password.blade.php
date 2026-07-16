<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="Reset your GameNova account password.">
  <title>{{ $mode === 'forgot' ? 'Forgot Password' : 'Reset Password' }} — GameNova</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&amp;family=Noto+Sans+Bengali:wght@400;500;600;700;800&amp;display=swap" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="{{ asset('css/auth.css') }}" rel="stylesheet">
</head>
<body class="d-flex align-items-center justify-content-center py-lg-4">
  <main class="auth-shell fade-up">
    <div class="row g-0 h-100">
      <section class="col-lg-6 auth-visual d-none d-lg-block" aria-labelledby="visual-title">
        <div class="auth-visual-content">
          <span class="visual-badge">Account recovery</span>
          <h2 class="visual-title" id="visual-title">Get back to your game <span>securely.</span></h2>
          <p class="visual-copy">Use your registered email address to securely choose a new password.</p>
        </div>
      </section>

      <section class="col-lg-6 auth-panel d-flex flex-column justify-content-center" aria-labelledby="password-title">
        <div class="auth-topbar d-flex align-items-center justify-content-between gap-3">
          <a class="brand" href="{{ route('home') }}" aria-label="GameNova home">
            <span class="brand-mark" aria-hidden="true">
              <svg width="24" height="24" viewBox="0 0 24 24" fill="none">
                <path d="M8 7h8a4 4 0 0 1 4 4v2a4 4 0 0 1-4 4l-2.2-2h-3.6L8 17a4 4 0 0 1-4-4v-2a4 4 0 0 1 4-4Z" stroke="currentColor" stroke-width="2"/>
                <path d="M8 10v4M6 12h4M16 11h.01M18 13h.01" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
              </svg>
            </span>
            <span>Game<span class="brand-accent">Nova</span></span>
          </a>
          <a class="back-link" href="{{ route('login') }}">← Login</a>
        </div>

        <div class="mx-auto w-100" style="max-width: 460px;">
          <h1 class="auth-heading" id="password-title">{{ $mode === 'forgot' ? 'Forgot password?' : 'Create new password' }}</h1>
          <p class="auth-subtitle">{{ $mode === 'forgot' ? 'Enter your account email and we will send you a secure reset link.' : 'Choose a strong new password for your GameNova account.' }}</p>

          @if ($errors->any())<div class="alert alert-danger" role="alert">{{ $errors->first() }}</div>@endif
          @if (session('status'))<div class="alert alert-success" role="status">{{ session('status') }}</div>@endif

          @if ($mode === 'forgot')
            <form action="{{ route('password.email') }}" method="post">
              @csrf
              <div class="mb-4">
                <label class="form-label" for="reset-email">Email address</label>
                <input class="form-control" id="reset-email" name="email" type="email" value="{{ old('email') }}" placeholder="you@example.com" autocomplete="email" required autofocus>
              </div>
              <button class="btn auth-btn w-100" type="submit">Email password reset link</button>
            </form>
          @else
            <form action="{{ route('password.update') }}" method="post">
              @csrf
              <input type="hidden" name="token" value="{{ $token }}">
              <div class="mb-3">
                <label class="form-label" for="reset-email">Email address</label>
                <input class="form-control" id="reset-email" name="email" type="email" value="{{ old('email', $email) }}" autocomplete="email" required>
              </div>
              <div class="mb-3">
                <label class="form-label" for="reset-password">New password</label>
                <input class="form-control" id="reset-password" name="password" type="password" placeholder="Minimum 8 characters" autocomplete="new-password" required autofocus>
              </div>
              <div class="mb-4">
                <label class="form-label" for="reset-password-confirmation">Confirm password</label>
                <input class="form-control" id="reset-password-confirmation" name="password_confirmation" type="password" placeholder="Repeat new password" autocomplete="new-password" required>
              </div>
              <button class="btn auth-btn w-100" type="submit">Reset password</button>
            </form>
          @endif

          <p class="switch-copy">Remembered your password? <a href="{{ route('login') }}">Back to login</a></p>
        </div>
      </section>
    </div>
  </main>
</body>
</html>
