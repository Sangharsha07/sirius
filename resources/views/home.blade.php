<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sirius | Student Mental Wellness</title>

    <link rel="icon" type="image/png" href="/images/favicon.png?v=99">
    <link rel="shortcut icon" type="image/png" href="/images/favicon.png?v=99">
    <link rel="apple-touch-icon" href="/images/favicon.png?v=99">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, Helvetica, sans-serif;
        }

        html {
            scroll-behavior: smooth;
        }

        body {
            background: #eef6ff;
            color: #1f2937;
        }

        .page-bg {
            min-height: 100vh;
            background:
                radial-gradient(circle at 55% 28%, rgba(255, 244, 184, 0.95) 0%, rgba(255, 244, 184, 0.35) 8%, transparent 18%),
                radial-gradient(circle at 80% 20%, rgba(255,255,255,0.8) 0%, transparent 16%),
                linear-gradient(135deg, #123c91 0%, #3b82f6 42%, #c7d2fe 72%, #fff7ed 100%);
            position: relative;
            overflow: hidden;
        }

        .page-bg::before {
            content: "";
            position: absolute;
            inset: 0;
            background-image:
                radial-gradient(circle, rgba(255,255,255,0.85) 1px, transparent 1px),
                radial-gradient(circle, rgba(255,255,255,0.45) 1px, transparent 1px);
            background-size: 90px 90px, 140px 140px;
            background-position: 20px 30px, 70px 90px;
            opacity: 0.7;
            pointer-events: none;
        }

        .navbar {
            position: relative;
            z-index: 5;
            padding: 24px 8%;
            display: flex;
            justify-content: space-between;
            align-items: center;
            color: white;
        }

        .logo-wrap {
            display: flex;
            align-items: center;
            gap: 12px;
            text-decoration: none;
            color: white;
            font-size: 30px;
            font-weight: bold;
        }

        .logo-img {
            width: 54px;
            height: 54px;
            object-fit: contain;
            border-radius: 50%;
            background: rgba(255,255,255,0.18);
            box-shadow: 0 8px 25px rgba(255,255,255,0.18);
        }

        .nav {
            display: flex;
            align-items: center;
            gap: 22px;
            flex-wrap: wrap;
        }

        .nav a {
            text-decoration: none;
            color: rgba(255,255,255,0.92);
            font-size: 16px;
            font-weight: bold;
        }

        .nav a:hover {
            color: #fff3b0;
        }

        .logout-btn {
            background: rgba(255,255,255,0.16);
            border: 1px solid rgba(255,255,255,0.35);
            color: white;
            font-size: 16px;
            cursor: pointer;
            padding: 9px 14px;
            border-radius: 999px;
            font-weight: bold;
        }

        .logout-btn:hover {
            background: rgba(255,255,255,0.28);
        }

        .hero {
            position: relative;
            z-index: 2;
            min-height: 72vh;
            padding: 65px 8% 90px;
            display: grid;
            grid-template-columns: 1.15fr 0.85fr;
            align-items: center;
            gap: 50px;
        }

        .hero-text {
            max-width: 720px;
        }

        .support-link {
            display: inline-block;
            padding: 11px 17px;
            margin-bottom: 24px;
            border-radius: 999px;
            color: white;
            text-decoration: none;
            font-weight: bold;
            background: rgba(255,255,255,0.18);
            border: 1px solid rgba(255,255,255,0.38);
            backdrop-filter: blur(10px);
        }

        .support-link:hover {
            background: rgba(255,255,255,0.28);
        }

        .tagline {
            color: #fff3b0;
            font-weight: bold;
            margin-bottom: 14px;
            font-size: 17px;
        }

        h1 {
            font-size: 58px;
            line-height: 1.12;
            color: #071b4d;
            margin-bottom: 22px;
            letter-spacing: -1px;
        }

        .highlight {
            color: #4f46e5;
        }

        .desc {
            font-size: 19px;
            line-height: 1.8;
            color: #1f2f56;
            max-width: 650px;
        }

        .buttons {
            margin-top: 32px;
            display: flex;
            gap: 16px;
            flex-wrap: wrap;
        }

        .btn-primary,
        .btn-secondary {
            padding: 15px 28px;
            border-radius: 999px;
            font-size: 16px;
            cursor: pointer;
            text-decoration: none;
            display: inline-block;
            font-weight: bold;
            transition: 0.2s ease;
        }

        .btn-primary {
            background: #4f46e5;
            color: white;
            box-shadow: 0 14px 30px rgba(79,70,229,0.28);
        }

        .btn-primary:hover {
            background: #4338ca;
            transform: translateY(-2px);
        }

        .btn-secondary {
            background: rgba(255,255,255,0.62);
            color: #3730a3;
            border: 1px solid rgba(79,70,229,0.35);
            backdrop-filter: blur(8px);
        }

        .btn-secondary:hover {
            background: white;
            transform: translateY(-2px);
        }

        .hero-visual {
            position: relative;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .star-orbit {
            position: absolute;
            width: 360px;
            height: 360px;
            border: 1px dashed rgba(255,255,255,0.55);
            border-radius: 50%;
            animation: spin 28s linear infinite;
        }

        .star-orbit::before,
        .star-orbit::after {
            content: "✦";
            position: absolute;
            color: #fff3b0;
            font-size: 24px;
        }

        .star-orbit::before {
            top: 28px;
            left: 65px;
        }

        .star-orbit::after {
            right: 45px;
            bottom: 45px;
        }

        .big-star {
            position: absolute;
            font-size: 145px;
            color: #fff6bf;
            text-shadow: 0 0 35px rgba(255,246,191,0.85);
            animation: pulse 3s ease-in-out infinite;
        }

        .check-card {
            position: relative;
            z-index: 3;
            background: rgba(255,255,255,0.88);
            width: 390px;
            padding: 32px;
            border-radius: 30px;
            box-shadow: 0 24px 60px rgba(30,64,175,0.28);
            backdrop-filter: blur(14px);
            border: 1px solid rgba(255,255,255,0.72);
            margin-top: 170px;
        }

        .check-card h2 {
            font-size: 27px;
            margin-bottom: 18px;
            color: #111827;
        }

        .mood {
            background: #eff6ff;
            padding: 18px;
            border-radius: 18px;
            font-size: 19px;
            margin: 18px 0;
            color: #1f2937;
        }

        .bar {
            height: 12px;
            background: #e5e7eb;
            border-radius: 20px;
            overflow: hidden;
            margin-top: 10px;
        }

        .fill {
            width: 45%;
            height: 100%;
            background: linear-gradient(90deg, #6366f1, #3b82f6);
            border-radius: 20px;
        }

        .reminder {
            margin-top: 22px;
            color: #374151;
            line-height: 1.6;
        }

        .features {
            position: relative;
            z-index: 5;
            background: white;
            margin: -45px 6% 0;
            padding: 42px;
            border-radius: 34px;
            box-shadow: 0 18px 50px rgba(15,23,42,0.12);
            text-align: center;
        }

        .features h2 {
            font-size: 32px;
            color: #111827;
            margin-bottom: 10px;
        }

        .features > p {
            color: #4b5563;
            font-size: 17px;
            margin-bottom: 30px;
        }

        .feature-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 22px;
        }

        .feature-card {
            display: block;
            text-decoration: none;
            color: #1f2937;
            padding: 30px;
            border-radius: 24px;
            text-align: center;
            transition: 0.22s ease;
            min-height: 205px;
            border: 1px solid rgba(255,255,255,0.8);
        }

        .feature-card:nth-child(1) {
            background: linear-gradient(135deg, #f3e8ff, #eef2ff);
        }

        .feature-card:nth-child(2) {
            background: linear-gradient(135deg, #e0f2fe, #eff6ff);
        }

        .feature-card:nth-child(3) {
            background: linear-gradient(135deg, #f5e8ff, #eef2ff);
        }

        .feature-card:nth-child(4) {
            background: linear-gradient(135deg, #fee2e2, #fff7ed);
        }

        .feature-card:nth-child(5) {
            background: linear-gradient(135deg, #dcfce7, #ecfeff);
        }

        .feature-card:nth-child(6) {
            background: linear-gradient(135deg, #fef3c7, #fff7ed);
        }

        .feature-card:hover {
            transform: translateY(-7px);
            box-shadow: 0 18px 35px rgba(15,23,42,0.13);
        }

        .feature-icon {
            font-size: 42px;
            margin-bottom: 18px;
        }

        .feature-card h3 {
            color: #2563eb;
            font-size: 21px;
            margin-bottom: 12px;
        }

        .feature-card p {
            color: #374151;
            font-size: 15px;
            line-height: 1.6;
        }

        .arrow {
            display: inline-block;
            margin-top: 16px;
            color: #4f46e5;
            font-size: 22px;
            font-weight: bold;
        }

        footer {
            background: #08142f;
            color: white;
            text-align: center;
            padding: 28px;
            margin-top: 0;
        }

        @keyframes pulse {
            0%, 100% {
                transform: scale(1);
                opacity: 0.9;
            }

            50% {
                transform: scale(1.08);
                opacity: 1;
            }
        }

        @keyframes spin {
            from {
                transform: rotate(0deg);
            }

            to {
                transform: rotate(360deg);
            }
        }

        @media (max-width: 1000px) {
            .navbar {
                flex-direction: column;
                gap: 18px;
            }

            .nav {
                justify-content: center;
            }

            .hero {
                grid-template-columns: 1fr;
                text-align: center;
            }

            .desc {
                margin: 0 auto;
            }

            .buttons {
                justify-content: center;
            }

            .check-card {
                margin-top: 80px;
            }

            .feature-grid {
                grid-template-columns: 1fr 1fr;
            }

            h1 {
                font-size: 44px;
            }
        }

        @media (max-width: 650px) {
            .hero {
                padding: 45px 6% 90px;
            }

            h1 {
                font-size: 36px;
            }

            .check-card {
                width: 100%;
                max-width: 370px;
            }

            .feature-grid {
                grid-template-columns: 1fr;
            }

            .features {
                margin: -35px 4% 0;
                padding: 28px;
            }
        }
    </style>
</head>
<body>

<div class="page-bg">

    <header class="navbar">
        <a href="/" class="logo-wrap">
            <img src="{{ asset('images/siriuslogo.png') }}" alt="Sirius Logo" class="logo-img">
            <span>Sirius</span>
        </a>

        <nav class="nav">
            <a href="/">Home</a>

            @auth
                <a href="{{ route('dashboard') }}">Dashboard</a>
                <a href="{{ route('mood.index') }}">Mood</a>
                <a href="{{ route('journal') }}">Journal</a>
                <a href="{{ route('goals') }}">Goals</a>
                <a href="{{ route('resources') }}">Resources</a>
                <a href="{{ route('support.index') }}">Support</a>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="logout-btn">
                        Logout
                    </button>
                </form>
            @else
                <a href="{{ route('support.index') }}">Support</a>
                <a href="{{ route('login') }}">Login</a>
                <a href="{{ route('register') }}">Register</a>
            @endauth
        </nav>
    </header>

    <section class="hero">
        <div class="hero-text">
            <a href="{{ route('resources') }}" class="support-link">
                💙 Need support? Resources →
            </a>

            <p class="tagline">⭐ You matter. Take it one day at a time.</p>

            <h1>
                Track your mood, reflect daily, and build
                <span class="highlight">healthier habits.</span>
            </h1>

            <p class="desc">
                Sirius helps university students manage stress, write private journals,
                set wellness goals, and understand emotional patterns through simple dashboards.
            </p>

            <div class="buttons">
                @auth
                    <a href="{{ route('dashboard') }}" class="btn-primary">
                        ✨ Go to Dashboard
                    </a>
                @else
                    <a href="{{ route('register') }}" class="btn-primary">
                        ✨ Get Started
                    </a>
                @endauth

                <a href="#features" class="btn-secondary">
                    ✦ Learn More
                </a>
            </div>
        </div>

        <div class="hero-visual">
            <div class="star-orbit"></div>
            <div class="big-star">✦</div>

            <div class="check-card">
                <h2>⭐ Today's Check-in</h2>

                <div class="mood">
                    😊 <strong>Feeling: Calm</strong><br>
                    <small>That's wonderful. Keep going.</small>
                </div>

                <p><strong>Stress Level</strong></p>

                <div class="bar">
                    <div class="fill"></div>
                </div>

                <p class="reminder">
                    <strong>Journal Reminder:</strong>
                    Write one thing that went well today.
                </p>

                <p class="reminder">
                    🌙 Small steps. Brighter days.
                </p>
            </div>
        </div>
    </section>

</div>

<section class="features" id="features">
    <h2>✨ Core Features ✨</h2>
    <p>Sirius combines simple tools for daily student wellness.</p>

    <div class="feature-grid">

        <a href="{{ route('mood.index') }}" class="feature-card">
            <div class="feature-icon">☁️</div>
            <h3>Mood Tracker</h3>
            <p>Record daily mood and stress level.</p>
            <span class="arrow">→</span>
        </a>

        <a href="{{ route('journal') }}" class="feature-card">
            <div class="feature-icon">📘</div>
            <h3>Private Journal</h3>
            <p>Write and manage private journal entries.</p>
            <span class="arrow">→</span>
        </a>

        <a href="{{ route('support.index') }}" class="feature-card">
            <div class="feature-icon">💬</div>
            <h3>AI Comment Filtering</h3>
            <p>Filter harmful or wrong advice on the support board.</p>
            <span class="arrow">→</span>
        </a>

        <a href="{{ route('dashboard') }}" class="feature-card">
            <div class="feature-icon">📊</div>
            <h3>Dashboard</h3>
            <p>View mood and stress trends using charts.</p>
            <span class="arrow">→</span>
        </a>

        <a href="{{ route('goals') }}" class="feature-card">
            <div class="feature-icon">🌱</div>
            <h3>Wellness Goals</h3>
            <p>Set and track personal wellness goals.</p>
            <span class="arrow">→</span>
        </a>

        <a href="{{ route('resources') }}" class="feature-card">
            <div class="feature-icon">🌻</div>
            <h3>Resources</h3>
            <p>Find student wellness and support resources.</p>
            <span class="arrow">→</span>
        </a>

    </div>
</section>

<footer>
    <p>✦ © 2026 Sirius. Student Mental Wellness Platform. ✦</p>
</footer>

@include('partials.helpline-widget')

</body>
</html>