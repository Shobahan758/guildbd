<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="Log in to your GameNova account.">
  <title>Login — GameNova</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&amp;family=Noto+Sans+Bengali:wght@400;500;600;700;800&amp;display=swap" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="{{ asset('css/auth.css') }}" rel="stylesheet">
  <script src="{{ asset('js/language.js') }}" defer></script>
  <script src="{{ asset('js/auth.js') }}" defer></script>
</head>
<body class="login-page d-flex align-items-center justify-content-center py-lg-4">
  <main class="auth-shell login-shell fade-up">
    <div class="row g-0 h-100">
      <section class="col-lg-7 auth-visual login-visual d-none d-lg-block" aria-labelledby="visual-title">
        <div class="auth-visual-content">
          <span class="visual-badge">Secure access</span>
          <h2 class="visual-title" id="visual-title">Your next win is <span>one login away.</span></h2>
          <p class="visual-copy">Access your orders, saved player IDs and exclusive GameNova offers from one secure dashboard.</p>
          <div class="visual-proof" aria-label="GameNova benefits">
            <span><strong>24/7</strong>Support</span>
            <span><strong>100%</strong>Secure</span>
            <span><strong>Fast</strong>Delivery</span>
          </div>
        </div>
      </section>

      <section class="col-lg-5 auth-panel login-panel d-flex flex-column justify-content-center" aria-labelledby="login-title">
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
          <div class="d-flex align-items-center gap-2">
            <details class="page-language">
              <summary aria-label="Choose language"><span aria-hidden="true">🌐</span><span class="language-label">EN</span></summary>
              <div class="language-options">
                <a class="language-option active" href="#" lang="en">English</a>
                <a class="language-option" href="#" lang="bn">বাংলা</a>
              </div>
            </details>
            <a class="back-link" href="{{ route('home') }}">← Home</a>
          </div>
        </div>

        <div class="login-form-wrap mx-auto w-100">
          <span class="login-kicker">Welcome to GameNova</span>
          <h1 class="auth-heading" id="login-title">Welcome back</h1>
          <p class="auth-subtitle">Sign in to manage orders and continue topping up.</p>

          @if (session('status'))
            <div class="alert alert-success" role="status">{{ session('status') }}</div>
          @endif

          <form action="{{ route('login.store') }}" method="post">
            @csrf
            <div class="mb-3">
              <label class="form-label" for="login-email">Email address</label>
              <div class="auth-input-wrap">
                <span class="auth-input-icon" aria-hidden="true">
                  <svg width="18" height="18" viewBox="0 0 24 24" fill="none"><path d="M4 5h16v14H4V5Z" stroke="currentColor" stroke-width="2"/><path d="m4 7 8 6 8-6" stroke="currentColor" stroke-width="2" stroke-linejoin="round"/></svg>
                </span>
                <input class="form-control @error('email') is-invalid @enderror" id="login-email" name="email" type="email" value="{{ old('email') }}" placeholder="you@example.com" autocomplete="email" required autofocus>
              </div>
              @error('email')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
            </div>

            <div class="mb-3">
              <div class="d-flex justify-content-between gap-3">
                <label class="form-label" for="login-password">Password</label>
                <a class="helper-link" href="{{ route('password.request') }}">Forgot password?</a>
              </div>
              <div class="auth-input-wrap">
                <span class="auth-input-icon" aria-hidden="true">
                  <svg width="18" height="18" viewBox="0 0 24 24" fill="none"><rect x="5" y="10" width="14" height="10" rx="2" stroke="currentColor" stroke-width="2"/><path d="M8 10V7a4 4 0 0 1 8 0v3" stroke="currentColor" stroke-width="2"/><path d="M12 14v2" stroke="currentColor" stroke-width="2" stroke-linecap="round"/></svg>
                </span>
                <input class="form-control password-control @error('password') is-invalid @enderror" id="login-password" name="password" type="password" placeholder="Enter your password" autocomplete="current-password" required>
                <button class="password-toggle" type="button" data-password-toggle="login-password" aria-label="Show password" aria-pressed="false">
                  <svg class="eye-open" width="19" height="19" viewBox="0 0 24 24" fill="none"><path d="M2 12s3.5-6 10-6 10 6 10 6-3.5 6-10 6S2 12 2 12Z" stroke="currentColor" stroke-width="2"/><circle cx="12" cy="12" r="2.5" stroke="currentColor" stroke-width="2"/></svg>
                  <svg class="eye-closed" width="19" height="19" viewBox="0 0 24 24" fill="none"><path d="m3 3 18 18M10.6 6.2C11.1 6.1 11.5 6 12 6c6.5 0 10 6 10 6a17 17 0 0 1-2.2 2.9M6.3 6.3C3.5 8.2 2 12 2 12s3.5 6 10 6c1.7 0 3.2-.4 4.5-1" stroke="currentColor" stroke-width="2" stroke-linecap="round"/></svg>
                </button>
              </div>
              @error('password')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
            </div>

            <div class="form-check mb-4">
              <input class="form-check-input" id="remember-me" name="remember" type="checkbox">
              <label class="form-check-label" for="remember-me">Keep me signed in</label>
            </div>

            <button class="btn auth-btn login-submit w-100" type="submit"><span>Login to account</span><span aria-hidden="true">→</span></button>
          </form>

          <div class="login-security">
            <span aria-hidden="true">
              <svg width="18" height="18" viewBox="0 0 24 24" fill="none"><path d="M12 3 5 6v5c0 4.6 2.8 8.3 7 10 4.2-1.7 7-5.4 7-10V6l-7-3Z" stroke="currentColor" stroke-width="2"/><path d="m9 12 2 2 4-4" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
            </span>
            <p><strong>Protected sign in</strong>Your session and password are securely encrypted.</p>
          </div>

          <p class="switch-copy login-register-prompt">New to GameNova? <a href="{{ route('register') }}">Create an account <span aria-hidden="true">→</span></a></p>
        </div>
      </section>
    </div>
  </main>
</body>
</html>
