<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="GameNova — fast and secure game top-ups in Bangladesh.">
  <title>GameNova — Instant Game Top-Up</title>

  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&amp;family=Noto+Sans+Bengali:wght@400;500;600;700;800&amp;display=swap" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="{{ asset('js/language.js') }}" defer></script>

  <style>
    :root {
      --primary: #7c3aed;
      --primary-dark: #5b21b6;
      --cyan: #22d3ee;
      --coral: #fb7185;
      --navy: #0b1026;
      --ink: #151a33;
      --muted: #69708a;
      --surface: #f5f3ff;
      --line: #e8e5f3;
    }

    * { box-sizing: border-box; }

    html { scroll-behavior: smooth; }

    body {
      margin: 0;
      overflow-x: hidden;
      color: var(--ink);
      font-family: "Inter", "Noto Sans Bengali", sans-serif;
      background: #fff;
    }

    a { text-decoration: none; }

    .site-header {
      position: sticky;
      top: 0;
      z-index: 10;
      background: rgba(255, 255, 255, 0.94);
      border-bottom: 1px solid var(--line);
      box-shadow: 0 0.35rem 1.8rem rgba(48, 35, 92, 0.05);
      backdrop-filter: blur(14px);
    }

    .brand {
      display: inline-flex;
      align-items: center;
      gap: 0.65rem;
      color: var(--ink);
      font-size: 1.3rem;
      font-weight: 800;
      letter-spacing: -0.04em;
    }

    .brand:hover { color: var(--ink); }

    .brand-mark {
      display: grid;
      width: 2.7rem;
      height: 2.7rem;
      color: #fff;
      background: linear-gradient(135deg, var(--primary), #a855f7 55%, var(--cyan));
      border-radius: 0.9rem;
      box-shadow: 0 0.65rem 1.3rem rgba(124, 58, 237, 0.25);
      place-items: center;
      transform: rotate(-5deg);
    }

    .brand-mark svg { transform: rotate(5deg); }
    .brand-accent { color: var(--primary); }

    .search-box {
      overflow: hidden;
      background: var(--surface);
      border: 1px solid transparent;
      border-radius: 0.85rem;
      transition: border-color 200ms ease, box-shadow 200ms ease;
    }

    .search-box:focus-within {
      border-color: rgba(124, 58, 237, 0.45);
      box-shadow: 0 0 0 0.25rem rgba(124, 58, 237, 0.09);
    }

    .search-box .form-control {
      flex: 1 1 0;
      width: 1%;
      min-width: 0;
      min-height: 48px;
      padding-inline: 1rem;
      color: var(--ink);
      background: transparent;
      border: 0;
      box-shadow: none;
    }

    .search-btn {
      min-width: 110px;
      color: #fff;
      font-weight: 700;
      background: linear-gradient(135deg, var(--primary), #9333ea);
      border: 0;
      transition: filter 200ms ease;
    }

    .search-btn:hover { color: #fff; filter: brightness(1.08); }

    .nav-link-custom {
      color: #4b5068;
      font-size: 0.92rem;
      font-weight: 700;
      transition: color 180ms ease;
    }

    .nav-link-custom:hover { color: var(--primary); }

    .login-btn {
      padding: 0.65rem 1.1rem;
      color: var(--primary);
      background: rgba(124, 58, 237, 0.08);
      border-radius: 0.7rem;
    }

    .language-menu {
      position: relative;
      margin: 0;
    }

    .language-menu summary {
      display: inline-flex;
      align-items: center;
      gap: 0.4rem;
      padding: 0.62rem 0.8rem;
      color: #4b5068;
      font-size: 0.82rem;
      font-weight: 700;
      background: #fff;
      border: 1px solid var(--line);
      border-radius: 0.7rem;
      cursor: pointer;
      list-style: none;
      user-select: none;
      transition: color 180ms ease, border-color 180ms ease, background 180ms ease;
    }

    .language-menu summary::-webkit-details-marker { display: none; }

    .language-menu summary:hover,
    .language-menu[open] summary {
      color: var(--primary);
      background: var(--surface);
      border-color: rgba(124, 58, 237, 0.25);
    }

    .language-menu summary::after {
      font-size: 0.65rem;
      content: "▾";
      transition: transform 180ms ease;
    }

    .language-menu[open] summary::after { transform: rotate(180deg); }

    .language-options {
      position: absolute;
      top: calc(100% + 0.65rem);
      right: 0;
      width: 155px;
      overflow: hidden;
      padding: 0.4rem;
      background: #fff;
      border: 1px solid var(--line);
      border-radius: 0.8rem;
      box-shadow: 0 1rem 2.5rem rgba(42, 31, 86, 0.16);
    }

    .language-option {
      display: flex;
      align-items: center;
      justify-content: space-between;
      padding: 0.65rem 0.75rem;
      color: #4b5068;
      font-size: 0.82rem;
      font-weight: 600;
      border-radius: 0.55rem;
    }

    .language-option:hover,
    .language-option.active {
      color: var(--primary);
      background: var(--surface);
    }

    .language-option.active::after {
      color: var(--primary);
      content: "✓";
    }

    .promo-area {
      padding: 2rem 0 1rem;
      background:
        radial-gradient(circle at 15% 10%, rgba(34, 211, 238, 0.12), transparent 25rem),
        linear-gradient(180deg, #fbfaff 0%, #fff 100%);
    }

    .promo-banner {
      position: relative;
      min-height: 390px;
      overflow: hidden;
      background: var(--navy) url("{{ asset('assets/gaming-hero.png') }}") center / cover no-repeat;
      border-radius: 1.5rem;
      box-shadow: 0 1.5rem 3.5rem rgba(13, 15, 47, 0.2);
    }

    .promo-banner::after {
      position: absolute;
      inset: 0;
      background: linear-gradient(90deg, rgba(5, 10, 36, 0.22), transparent 60%);
      content: "";
      pointer-events: none;
    }

    .promo-content {
      position: relative;
      z-index: 2;
      max-width: 590px;
      padding: clamp(2rem, 6vw, 4.5rem);
    }

    .promo-badge {
      display: inline-flex;
      align-items: center;
      gap: 0.55rem;
      padding: 0.5rem 0.85rem;
      color: #c4f7ff;
      font-size: 0.75rem;
      font-weight: 700;
      letter-spacing: 0.08em;
      text-transform: uppercase;
      background: rgba(34, 211, 238, 0.12);
      border: 1px solid rgba(34, 211, 238, 0.28);
      border-radius: 999px;
    }

    .promo-badge::before {
      width: 0.45rem;
      height: 0.45rem;
      background: var(--cyan);
      border-radius: 50%;
      box-shadow: 0 0 0.8rem var(--cyan);
      content: "";
    }

    .promo-title {
      margin: 1.1rem 0 1rem;
      color: #fff;
      font-size: clamp(2.25rem, 5vw, 4.2rem);
      font-weight: 800;
      line-height: 1.02;
      letter-spacing: -0.055em;
    }

    .promo-title span {
      color: var(--cyan);
      text-shadow: 0 0 1.5rem rgba(34, 211, 238, 0.38);
    }

    .promo-text {
      max-width: 470px;
      color: #c7cbe1;
      font-size: 1rem;
      line-height: 1.7;
    }

    .promo-btn {
      padding: 0.8rem 1.35rem;
      color: #fff;
      font-weight: 700;
      background: linear-gradient(135deg, var(--primary), #a855f7);
      border: 0;
      border-radius: 0.8rem;
      box-shadow: 0 0.8rem 1.8rem rgba(124, 58, 237, 0.35);
      transition: transform 220ms ease, box-shadow 220ms ease;
    }

    .promo-btn:hover {
      color: #fff;
      transform: translateY(-3px);
      box-shadow: 0 1.1rem 2.2rem rgba(124, 58, 237, 0.45);
    }

    .slider-dot {
      display: inline-block;
      width: 0.45rem;
      height: 0.45rem;
      background: rgba(255, 255, 255, 0.4);
      border-radius: 999px;
    }

    .slider-dot.active { width: 1.5rem; background: var(--cyan); }

    .benefit-bar {
      position: relative;
      z-index: 3;
      margin-top: -1.15rem;
    }

    .benefit-inner {
      background: #fff;
      border: 1px solid var(--line);
      border-radius: 1rem;
      box-shadow: 0 0.9rem 2.3rem rgba(56, 43, 102, 0.1);
    }

    .benefit-item {
      display: flex;
      align-items: center;
      justify-content: center;
      gap: 0.75rem;
      padding: 1rem;
      color: #555c75;
      font-size: 0.84rem;
      font-weight: 600;
    }

    .benefit-icon {
      display: grid;
      flex: 0 0 auto;
      width: 2.2rem;
      height: 2.2rem;
      color: var(--primary);
      background: rgba(124, 58, 237, 0.1);
      border-radius: 0.7rem;
      place-items: center;
    }

    .games-section { padding: 4.5rem 0 5.5rem; }

    .section-kicker {
      color: var(--primary);
      font-size: 0.76rem;
      font-weight: 800;
      letter-spacing: 0.13em;
      text-transform: uppercase;
    }

    .section-title {
      margin-top: 0.35rem;
      font-size: clamp(1.8rem, 4vw, 2.65rem);
      font-weight: 800;
      letter-spacing: -0.045em;
    }

    .section-title span { color: var(--primary); }

    .view-link {
      color: var(--primary);
      font-size: 0.9rem;
      font-weight: 700;
    }

    .game-card {
      display: block;
      height: 100%;
      overflow: hidden;
      color: var(--ink);
      background: #fff;
      border: 1px solid var(--line);
      border-radius: 1.1rem;
      box-shadow: 0 0.65rem 1.8rem rgba(50, 39, 91, 0.08);
      transition: transform 260ms ease, box-shadow 260ms ease, border-color 260ms ease;
    }

    .game-card:hover {
      color: var(--ink);
      border-color: rgba(124, 58, 237, 0.28);
      box-shadow: 0 1.15rem 2.5rem rgba(50, 39, 91, 0.16);
      transform: translateY(-7px);
    }

    .game-art {
      position: relative;
      min-height: 190px;
      overflow: hidden;
    }

    .game-art::after {
      position: absolute;
      inset: 0;
      background: linear-gradient(180deg, transparent 55%, rgba(7, 10, 30, 0.2));
      content: "";
      pointer-events: none;
    }

    .game-art img {
      position: absolute;
      inset: 0;
      width: 100%;
      height: 100%;
      object-fit: cover;
      transition: transform 350ms ease, filter 350ms ease;
    }

    .game-card:hover .game-art img { transform: scale(1.07); filter: saturate(1.08); }

    .art-2 img { object-position: center; }
    .art-3 img { object-position: center; }
    .art-5 img { object-position: center 25%; }

    .art-1 { background: linear-gradient(145deg, #4c1d95, #7c3aed 55%, #22d3ee); }
    .art-2 { background: linear-gradient(145deg, #0f172a, #0891b2 58%, #67e8f9); }
    .art-3 { background: linear-gradient(145deg, #701a75, #c026d3 58%, #fb7185); }
    .art-4 { background: linear-gradient(145deg, #172554, #2563eb 58%, #38bdf8); }
    .art-5 { background: linear-gradient(145deg, #3f1d52, #db2777 58%, #fb7185); }

    .game-symbol {
      position: relative;
      z-index: 1;
      display: grid;
      width: 6.2rem;
      height: 6.2rem;
      color: #fff;
      font-size: 2.4rem;
      font-weight: 800;
      letter-spacing: -0.08em;
      background: rgba(7, 11, 35, 0.34);
      border: 1px solid rgba(255, 255, 255, 0.24);
      border-radius: 1.8rem;
      box-shadow: inset 0 0 1.6rem rgba(255, 255, 255, 0.08), 0 0.9rem 2rem rgba(6, 8, 30, 0.25);
      backdrop-filter: blur(8px);
      place-items: center;
      transform: rotate(-5deg);
    }

    .game-symbol small {
      position: absolute;
      right: 0.65rem;
      bottom: 0.55rem;
      color: var(--cyan);
      font-size: 0.63rem;
      letter-spacing: 0;
    }

    .game-info { padding: 1rem 1.05rem 1.1rem; }

    .game-name {
      margin: 0 0 0.35rem;
      font-size: 0.92rem;
      font-weight: 800;
    }

    .game-meta {
      margin: 0;
      color: var(--muted);
      font-size: 0.76rem;
    }

    .status-dot {
      display: inline-block;
      width: 0.45rem;
      height: 0.45rem;
      margin-right: 0.3rem;
      background: #10b981;
      border-radius: 50%;
    }

    .how-section {
      padding: 0 0 6rem;
      background: #fff;
    }

    .how-shell {
      position: relative;
      isolation: isolate;
      overflow: hidden;
      padding: clamp(1.5rem, 4vw, 3.5rem);
      color: #fff;
      background:
        radial-gradient(circle at 85% 5%, rgba(34, 211, 238, 0.2), transparent 22rem),
        radial-gradient(circle at 10% 100%, rgba(124, 58, 237, 0.35), transparent 25rem),
        var(--navy);
      border-radius: 1.6rem;
      box-shadow: 0 1.6rem 4rem rgba(11, 16, 38, 0.2);
    }

    .how-shell::before {
      position: absolute;
      inset: 0;
      z-index: -1;
      opacity: 0.12;
      background-image: radial-gradient(rgba(255, 255, 255, 0.9) 1px, transparent 1px);
      background-size: 24px 24px;
      content: "";
    }

    .how-kicker {
      color: var(--cyan);
      font-size: 0.75rem;
      font-weight: 800;
      letter-spacing: 0.13em;
      text-transform: uppercase;
    }

    .how-title {
      max-width: 560px;
      margin: 0.45rem 0 0;
      font-size: clamp(1.85rem, 4vw, 3rem);
      font-weight: 800;
      line-height: 1.12;
      letter-spacing: -0.05em;
    }

    .how-copy {
      max-width: 540px;
      margin: 1rem 0 0;
      color: #aeb5d0;
      font-size: 0.9rem;
      line-height: 1.75;
    }

    .live-pill {
      display: inline-flex;
      align-items: center;
      gap: 0.55rem;
      padding: 0.6rem 0.85rem;
      color: #cbfae7;
      font-size: 0.72rem;
      font-weight: 700;
      background: rgba(16, 185, 129, 0.12);
      border: 1px solid rgba(16, 185, 129, 0.25);
      border-radius: 999px;
    }

    .live-pill::before {
      width: 0.5rem;
      height: 0.5rem;
      background: #10b981;
      border-radius: 50%;
      box-shadow: 0 0 0 0.3rem rgba(16, 185, 129, 0.12);
      content: "";
      animation: livePulse 1.8s ease-in-out infinite;
    }

    .process-card {
      position: relative;
      height: 100%;
      min-height: 205px;
      padding: 1.35rem;
      overflow: hidden;
      background: rgba(255, 255, 255, 0.07);
      border: 1px solid rgba(255, 255, 255, 0.1);
      border-radius: 1rem;
      backdrop-filter: blur(8px);
      transition: transform 220ms ease, background 220ms ease, border-color 220ms ease;
    }

    .process-card:hover {
      background: rgba(255, 255, 255, 0.1);
      border-color: rgba(34, 211, 238, 0.3);
      transform: translateY(-6px);
    }

    .process-number {
      position: absolute;
      top: -1rem;
      right: 0.7rem;
      color: rgba(255, 255, 255, 0.07);
      font-size: 5.5rem;
      font-weight: 800;
      line-height: 1;
    }

    .process-icon {
      display: grid;
      width: 2.8rem;
      height: 2.8rem;
      color: var(--cyan);
      background: rgba(34, 211, 238, 0.12);
      border: 1px solid rgba(34, 211, 238, 0.18);
      border-radius: 0.8rem;
      place-items: center;
    }

    .process-card h3 {
      position: relative;
      margin: 1rem 0 0.5rem;
      font-size: 1rem;
      font-weight: 800;
    }

    .process-card p {
      position: relative;
      margin: 0;
      color: #aeb5d0;
      font-size: 0.78rem;
      line-height: 1.65;
    }

    .support-panel {
      display: flex;
      min-height: 100%;
      flex-direction: column;
      justify-content: space-between;
      padding: 1.5rem;
      background: linear-gradient(145deg, rgba(124, 58, 237, 0.75), rgba(72, 34, 155, 0.8));
      border: 1px solid rgba(255, 255, 255, 0.14);
      border-radius: 1rem;
      box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.12);
    }

    .support-panel h3 { margin: 0.9rem 0 0.55rem; font-size: 1.3rem; font-weight: 800; }
    .support-panel p { margin: 0; color: #ddd6fe; font-size: 0.8rem; line-height: 1.65; }

    .support-action {
      display: inline-flex;
      align-items: center;
      justify-content: space-between;
      gap: 1rem;
      margin-top: 1.4rem;
      padding: 0.75rem 0.9rem;
      color: var(--navy);
      font-size: 0.78rem;
      font-weight: 800;
      background: #fff;
      border-radius: 0.7rem;
      transition: transform 180ms ease;
    }

    .support-action:hover { color: var(--navy); transform: translateX(3px); }

    @keyframes livePulse {
      0%, 100% { opacity: 1; transform: scale(1); }
      50% { opacity: 0.55; transform: scale(0.75); }
    }

    .site-footer {
      position: relative;
      overflow: hidden;
      color: #c8cbe0;
      background: var(--navy);
    }

    .site-footer::before {
      position: absolute;
      top: -14rem;
      left: -10rem;
      width: 30rem;
      height: 30rem;
      background: radial-gradient(circle, rgba(124, 58, 237, 0.3), transparent 68%);
      border-radius: 50%;
      content: "";
    }

    .footer-content { position: relative; padding: 4.5rem 0 3rem; }

    .footer-heading {
      margin-bottom: 1.2rem;
      color: #fff;
      font-size: 0.78rem;
      font-weight: 700;
      letter-spacing: 0.12em;
      text-transform: uppercase;
    }

    .footer-copy { max-width: 320px; font-size: 0.87rem; line-height: 1.8; }

    .footer-links {
      display: grid;
      gap: 0.7rem;
      margin: 0;
      padding: 0;
      list-style: none;
    }

    .footer-links a { color: #aeb3ca; font-size: 0.86rem; transition: color 180ms ease; }
    .footer-links a:hover { color: var(--cyan); }

    .contact-pill {
      display: inline-flex;
      align-items: center;
      gap: 0.7rem;
      padding: 0.75rem 1rem;
      color: #fff;
      font-size: 0.88rem;
      background: rgba(255, 255, 255, 0.07);
      border: 1px solid rgba(255, 255, 255, 0.11);
      border-radius: 0.85rem;
    }

    .contact-pill svg { color: var(--cyan); }

    .social-link {
      display: grid;
      width: 2.35rem;
      height: 2.35rem;
      color: #fff;
      background: rgba(255, 255, 255, 0.08);
      border-radius: 0.75rem;
      place-items: center;
      transition: transform 200ms ease, background 200ms ease;
    }

    .social-link:hover { color: #fff; background: var(--primary); transform: translateY(-3px); }

    .copyright {
      position: relative;
      padding: 1.1rem 0;
      color: #888fae;
      font-size: 0.76rem;
      border-top: 1px solid rgba(255, 255, 255, 0.09);
    }

    .fade-up { animation: fadeUp 700ms cubic-bezier(0.22, 1, 0.36, 1) both; }
    .delay-1 { animation-delay: 100ms; }
    .delay-2 { animation-delay: 220ms; }

    @keyframes fadeUp {
      from { opacity: 0; transform: translateY(22px); }
      to { opacity: 1; transform: translateY(0); }
    }

    @media (max-width: 991.98px) {
      .site-header .container > .d-flex {
        display: grid !important;
        grid-template-columns: minmax(0, 1fr) auto;
      }
      .header-search {
        grid-row: 2;
        grid-column: 1 / -1;
        width: 100%;
        min-width: 0;
      }
      .account-nav { grid-row: 1; grid-column: 2; }
      .search-box { width: 100%; }
      .promo-banner { min-height: 360px; background-position: 58% center; }
      .promo-content { max-width: 520px; }
      .benefit-item { justify-content: flex-start; }
    }

    @media (max-width: 767.98px) {
      .promo-area { padding-top: 1rem; }
      .promo-banner { min-height: 500px; background-position: 68% center; }
      .promo-banner::before {
        position: absolute;
        inset: 0;
        background: linear-gradient(180deg, rgba(5, 10, 36, 0.2) 20%, rgba(5, 10, 36, 0.93) 78%);
        content: "";
      }
      .promo-content {
        position: absolute;
        right: 0;
        bottom: 0;
        left: 0;
        padding: 2rem;
      }
      .promo-title { max-width: 420px; }
      .promo-text { display: none; }
      .benefit-bar { margin-top: 1rem; }
      .games-section { padding: 3.5rem 0 4rem; }
      .how-section { padding-bottom: 4rem; }
    }

    @media (max-width: 575.98px) {
      .brand-text { font-size: 1.1rem; }
      .brand-mark { width: 2.35rem; height: 2.35rem; }
      .account-nav { gap: 0.5rem !important; }
      .language-menu summary { padding: 0.58rem 0.68rem; }
      .language-label { display: none; }
      .search-btn { min-width: 86px; }
      .promo-banner { min-height: 440px; border-radius: 1rem; }
      .promo-content { padding: 1.4rem; }
      .promo-title { max-width: 310px; font-size: 2.15rem; }
      .game-art { min-height: 155px; }
      .game-symbol { width: 5.2rem; height: 5.2rem; font-size: 1.9rem; border-radius: 1.4rem; }
      .game-info { padding: 0.85rem; }
      .game-name { font-size: 0.82rem; }
      .footer-content { padding-top: 3.5rem; }
    }

    @media (prefers-reduced-motion: reduce) {
      *, *::before, *::after {
        scroll-behavior: auto !important;
        animation-duration: 0.01ms !important;
        animation-iteration-count: 1 !important;
        transition-duration: 0.01ms !important;
      }
    }
  </style>
</head>
<body>
  <header class="site-header">
    <div class="container py-3">
      <div class="d-flex flex-wrap align-items-center gap-3 gap-lg-4">
        <a class="brand me-lg-2" href="{{ route('home') }}" aria-label="GameNova home">
          <span class="brand-mark" aria-hidden="true">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none">
              <path d="M8 7h8a4 4 0 0 1 4 4v2a4 4 0 0 1-4 4l-2.2-2h-3.6L8 17a4 4 0 0 1-4-4v-2a4 4 0 0 1 4-4Z" stroke="currentColor" stroke-width="2"/>
              <path d="M8 10v4M6 12h4M16 11h.01M18 13h.01" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
            </svg>
          </span>
          <span class="brand-text">Game<span class="brand-accent">Nova</span></span>
        </a>

        <form class="header-search flex-grow-1" role="search">
          <div class="search-box d-flex">
            <input class="form-control" type="search" placeholder="Search games and vouchers" aria-label="Search games and vouchers">
            <button class="search-btn px-3" type="submit">Search</button>
          </div>
        </form>

        <nav class="account-nav d-flex align-items-center gap-3 ms-auto" aria-label="Account navigation">
          <a class="nav-link-custom d-none d-sm-inline" href="#games">Browse</a>
          <a class="nav-link-custom d-none d-sm-inline" href="{{ route('register') }}">Register</a>
          <details class="language-menu">
            <summary aria-label="Choose language">
              <span aria-hidden="true">🌐</span>
              <span class="language-label">EN</span>
            </summary>
            <div class="language-options">
              <a class="language-option active" href="{{ route('home') }}" lang="en">English</a>
              <a class="language-option" href="{{ route('home', ['lang' => 'bn']) }}" lang="bn">বাংলা</a>
            </div>
          </details>
          <a class="nav-link-custom login-btn" href="{{ route('login') }}">Login</a>
        </nav>
      </div>
    </div>
  </header>

  <main>
    <section class="promo-area" aria-labelledby="promo-title">
      <div class="container">
        <div class="promo-banner fade-up">
          <div class="promo-content">
            <span class="promo-badge">Instant delivery</span>
            <h1 class="promo-title" id="promo-title">Level up your game<br><span>in seconds.</span></h1>
            <p class="promo-text">Top up your favourite games securely with bKash, Nagad and cards. Better value, instant delivery, zero hassle.</p>
            <a class="btn promo-btn mt-2" href="#games">Explore Top-Ups</a>
            <div class="d-flex gap-2 mt-4" aria-label="Slide 1 of 3">
              <span class="slider-dot active"></span>
              <span class="slider-dot"></span>
              <span class="slider-dot"></span>
            </div>
          </div>
        </div>

        <div class="benefit-bar fade-up delay-1">
          <div class="benefit-inner">
            <div class="row row-cols-2 row-cols-lg-4 g-0">
              <div class="col benefit-item">
                <span class="benefit-icon" aria-hidden="true">⚡</span>
                Instant delivery
              </div>
              <div class="col benefit-item">
                <span class="benefit-icon" aria-hidden="true">✓</span>
                Secure payment
              </div>
              <div class="col benefit-item">
                <span class="benefit-icon" aria-hidden="true">৳</span>
                Best local price
              </div>
              <div class="col benefit-item">
                <span class="benefit-icon" aria-hidden="true">24</span>
                24/7 support
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <section class="games-section" id="games" aria-labelledby="games-title">
      <div class="container">
        <div class="d-flex align-items-end justify-content-between gap-3 mb-4 mb-md-5">
          <div>
            <p class="section-kicker mb-0">Popular right now</p>
            <h2 class="section-title mb-0" id="games-title">New Game <span>Top-Ups</span></h2>
          </div>
          <a class="view-link text-nowrap" href="#">View all →</a>
        </div>

        <div class="row row-cols-2 row-cols-md-3 row-cols-lg-5 g-3 g-xl-4">
          <div class="col fade-up">
            <a class="game-card" href="{{ route('games.show', 'free-fire') }}" aria-label="Top up Free Fire diamonds">
              <div class="game-art art-1">
                <img src="{{ asset('assets/games/free-fire.jpg') }}" alt="Free Fire Diamonds artwork" width="1920" height="1080" loading="lazy">
              </div>
              <div class="game-info">
                <h3 class="game-name">Free Fire Diamonds</h3>
                <p class="game-meta"><span class="status-dot"></span>Instant top-up</p>
              </div>
            </a>
          </div>

          <div class="col fade-up delay-1">
            <a class="game-card" href="{{ route('games.show', 'pubg-mobile') }}" aria-label="Top up PUBG Mobile UC">
              <div class="game-art art-2">
                <img src="{{ asset('assets/games/pubg-mobile.jpg') }}" alt="PUBG Mobile UC artwork" width="400" height="400" loading="lazy">
              </div>
              <div class="game-info">
                <h3 class="game-name">PUBG Mobile UC</h3>
                <p class="game-meta"><span class="status-dot"></span>Global server</p>
              </div>
            </a>
          </div>

          <div class="col fade-up delay-2">
            <a class="game-card" href="{{ route('games.show', 'mobile-legends') }}" aria-label="Top up Mobile Legends diamonds">
              <div class="game-art art-3">
                <img src="{{ asset('assets/games/mobile-legends.jpg') }}" alt="Mobile Legends artwork" width="600" height="315" loading="lazy">
              </div>
              <div class="game-info">
                <h3 class="game-name">Mobile Legends</h3>
                <p class="game-meta"><span class="status-dot"></span>Weekly pass</p>
              </div>
            </a>
          </div>

          <div class="col fade-up delay-1">
            <a class="game-card" href="{{ route('games.show', 'call-of-duty') }}" aria-label="Top up Call of Duty Mobile CP">
              <div class="game-art art-4">
                <img src="{{ asset('assets/games/call-of-duty-mobile.jpg') }}" alt="Call of Duty Mobile CP artwork" width="3840" height="2160" loading="lazy">
              </div>
              <div class="game-info">
                <h3 class="game-name">Call of Duty CP</h3>
                <p class="game-meta"><span class="status-dot"></span>Garena server</p>
              </div>
            </a>
          </div>

          <div class="col fade-up delay-2">
            <a class="game-card" href="{{ route('games.show', 'valorant') }}" aria-label="Buy Valorant points">
              <div class="game-art art-5">
                <img src="{{ asset('assets/games/valorant.webp') }}" alt="Valorant Points artwork" width="1200" height="630" loading="lazy">
              </div>
              <div class="game-info">
                <h3 class="game-name">Valorant Points</h3>
                <p class="game-meta"><span class="status-dot"></span>Digital code</p>
              </div>
            </a>
          </div>
        </div>
      </div>
    </section>

    <section class="how-section" aria-labelledby="how-title">
      <div class="container">
        <div class="how-shell">
          <div class="row align-items-end g-4 mb-4 mb-lg-5">
            <div class="col-lg-8">
              <p class="how-kicker mb-0">Simple. Fast. Secure.</p>
              <h2 class="how-title" id="how-title">From player ID to game credit in three easy steps.</h2>
              <p class="how-copy">No complicated checkout and no long waiting time. Choose your game, complete the payment and get back to playing.</p>
            </div>
            <div class="col-lg-4 text-lg-end">
              <span class="live-pill">Delivery systems online</span>
            </div>
          </div>

          <div class="row g-3 g-xl-4">
            <div class="col-md-4 col-xl-3">
              <article class="process-card">
                <span class="process-number" aria-hidden="true">01</span>
                <span class="process-icon" aria-hidden="true">
                  <svg width="21" height="21" viewBox="0 0 24 24" fill="none">
                    <path d="M4 6h16M4 12h10M4 18h7" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                  </svg>
                </span>
                <h3>Choose your game</h3>
                <p>Select a game and pick the recharge package that fits your needs.</p>
              </article>
            </div>

            <div class="col-md-4 col-xl-3">
              <article class="process-card">
                <span class="process-number" aria-hidden="true">02</span>
                <span class="process-icon" aria-hidden="true">
                  <svg width="21" height="21" viewBox="0 0 24 24" fill="none">
                    <path d="M12 21a9 9 0 1 0 0-18 9 9 0 0 0 0 18Z" stroke="currentColor" stroke-width="2"/>
                    <path d="M9 12h6M12 9v6" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                  </svg>
                </span>
                <h3>Enter player details</h3>
                <p>Add your player ID carefully so your credit reaches the correct account.</p>
              </article>
            </div>

            <div class="col-md-4 col-xl-3">
              <article class="process-card">
                <span class="process-number" aria-hidden="true">03</span>
                <span class="process-icon" aria-hidden="true">
                  <svg width="21" height="21" viewBox="0 0 24 24" fill="none">
                    <path d="M3 7h18v10H3V7Z" stroke="currentColor" stroke-width="2"/>
                    <path d="M3 10h18M7 14h3" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                  </svg>
                </span>
                <h3>Pay and receive</h3>
                <p>Pay securely with your preferred method and receive your top-up instantly.</p>
              </article>
            </div>

            <div class="col-xl-3">
              <aside class="support-panel">
                <div>
                  <span class="process-icon" aria-hidden="true">
                    <svg width="21" height="21" viewBox="0 0 24 24" fill="none">
                      <path d="M4 13a8 8 0 0 1 16 0M4 13v4a2 2 0 0 0 2 2h2v-7H4v1ZM20 13v4a2 2 0 0 1-2 2h-2v-7h4v1Z" stroke="currentColor" stroke-width="2" stroke-linejoin="round"/>
                    </svg>
                  </span>
                  <h3>Need a hand?</h3>
                  <p>Our support team is ready to help with orders and payment questions, day or night.</p>
                </div>
                <a class="support-action" href="mailto:support@gamenova.com">
                  <span>Chat with support</span>
                  <span aria-hidden="true">→</span>
                </a>
              </aside>
            </div>
          </div>
        </div>
      </div>
    </section>
  </main>

  <footer class="site-footer">
    <div class="container footer-content">
      <div class="row g-4 g-lg-5">
        <div class="col-lg-4">
          <a class="brand mb-3" href="{{ route('home') }}" aria-label="GameNova home">
            <span class="brand-mark" aria-hidden="true">G</span>
            <span class="text-white">Game<span class="brand-accent">Nova</span></span>
          </a>
          <p class="footer-copy mb-4">Bangladesh's fast, secure and friendly destination for game credits, vouchers and digital products.</p>
          <a class="contact-pill" href="tel:+8801700000000">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" aria-hidden="true">
              <path d="M22 16.9v3a2 2 0 0 1-2.18 2 19.8 19.8 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6A19.8 19.8 0 0 1 2.12 4.18 2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72c.13.96.36 1.9.69 2.8a2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45c.91.33 1.85.56 2.81.69A2 2 0 0 1 22 16.9Z" stroke="currentColor" stroke-width="2"/>
            </svg>
            +880 1700-000000
          </a>
        </div>

        <div class="col-6 col-lg-2">
          <h2 class="footer-heading">Support</h2>
          <ul class="footer-links">
            <li><a href="#">Help center</a></li>
            <li><a href="#">Contact us</a></li>
            <li><a href="#">Order status</a></li>
            <li><a href="#">Refund policy</a></li>
          </ul>
        </div>

        <div class="col-6 col-lg-2">
          <h2 class="footer-heading">Company</h2>
          <ul class="footer-links">
            <li><a href="#">About us</a></li>
            <li><a href="#">Terms &amp; conditions</a></li>
            <li><a href="#">Privacy policy</a></li>
            <li><a href="#">Become a seller</a></li>
          </ul>
        </div>

        <div class="col-lg-4">
          <h2 class="footer-heading">Stay connected</h2>
          <p class="footer-copy mb-3">Get new offers, gaming news and exclusive promo codes.</p>
          <div class="d-flex gap-2">
            <a class="social-link" href="#" aria-label="Facebook">f</a>
            <a class="social-link" href="#" aria-label="YouTube">▶</a>
            <a class="social-link" href="#" aria-label="Instagram">◎</a>
          </div>
        </div>
      </div>
    </div>

    <div class="container copyright d-flex flex-column flex-sm-row justify-content-between gap-2">
      <span>© 2026 GameNova. All rights reserved.</span>
      <span>Made for gamers in Bangladesh 🇧🇩</span>
    </div>
  </footer>
</body>
</html>
