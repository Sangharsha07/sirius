<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sirius</title>

    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: #f5f7fb;
            color: #1f2937;
        }

        .navbar {
            background: white;
            padding: 20px 8%;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 2px 12px rgba(0,0,0,0.08);
        }

        .logo {
            font-size: 28px;
            font-weight: bold;
            color: #2563eb;
            text-decoration: none;
        }

        .nav {
            display: flex;
            align-items: center;
            gap: 24px;
            flex-wrap: wrap;
        }

        .nav a {
            text-decoration: none;
            color: #374151;
            font-size: 16px;
        }

        .nav a:hover {
            color: #2563eb;
        }

        .logout-btn {
            background: none;
            border: none;
            color: #374151;
            font-size: 16px;
            cursor: pointer;
            padding: 0;
        }

        .logout-btn:hover {
            color: #2563eb;
        }

        .hero {
            min-height: 80vh;
            padding: 70px 8%;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 40px;
        }

        .hero-text {
            max-width: 650px;
        }

        .tagline {
            color: #2563eb;
            font-weight: bold;
        }

        h1 {
            font-size: 52px;
            line-height: 1.15;
            margin: 15px 0;
        }

        .desc {
            font-size: 18px;
            line-height: 1.7;
            color: #4b5563;
        }

        .buttons {
            margin-top: 28px;
            display: flex;
            gap: 12px;
            flex-wrap: wrap;
        }

        .btn-primary,
        .btn-secondary {
            padding: 14px 26px;
            border-radius: 10px;
            border: none;
            font-size: 16px;
            cursor: pointer;
            text-decoration: none;
            display: inline-block;
        }

        .btn-primary {
            background: #2563eb;
            color: white;
        }

        .btn-primary:hover {
            background: #1d4ed8;
        }

        .btn-secondary {
            background: white;
            color: #2563eb;
            border: 1px solid #2563eb;
        }

        .btn-secondary:hover {
            background: #eff6ff;
        }

        .card {
            background: white;
            width: 340px;
            padding: 28px;
            border-radius: 22px;
            box-shadow: 0 20px 45px rgba(37, 99, 235, 0.18);
        }

        .mood {
            background: #eff6ff;
            padding: 18px;
            border-radius: 16px;
            font-size: 20px;
            margin: 18px 0;
        }

        .bar {
            height: 12px;
            background: #e5e7eb;
            border-radius: 20px;
            overflow: hidden;
        }

        .fill {
            width: 45%;
            height: 100%;
            background: #2563eb;
        }

        .features {
            background: white;
            padding: 60px 8%;
            text-align: center;
        }

        .feature-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 22px;
            margin-top: 35px;
        }

        .feature {
            background: #f5f7fb;
            padding: 25px;
            border-radius: 16px;
            text-align: left;
        }

        .feature h3 {
            color: #2563eb;
        }

        footer {
            background: #111827;
            color: white;
            text-align: center;
            padding: 22px;
        }

        @media (max-width: 900px) {
            .navbar {
                flex-direction: column;
                gap: 15px;
            }

            .nav {
                justify-content: center;
            }

            .hero {
                flex-direction: column;
                text-align: center;
            }

            h1 {
                font-size: 36px;
            }

            .feature-grid {
                grid-template-columns: 1fr;
            }

            .card {
                width: 100%;
                max-width: 340px;
            }

            .buttons {
                justify-content: center;
            }
        }
    </style>
</head>
<body>

<header class="navbar">
    <a href="/" class="logo">Sirius</a>

    <nav class="nav">
        <a href="/">Home</a>

        @auth
            <a href="{{ route('dashboard') }}">Dashboard</a>
            <a href="/mood">Mood</a>
            <a href="/journal">Journal</a>
            <a href="/goals">Goals</a>
            <a href="/resources">Resources</a>
            <a href="/support">Support</a>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="logout-btn">
                    Logout
                </button>
            </form>
        @else
            <a href="{{ route('login') }}">Login</a>
            <a href="{{ route('register') }}">Register</a>
        @endauth
    </nav>
</header>

<section class="hero">
    <div class="hero-text">
        <p class="tagline">Student Mental Wellness Platform</p>

        <h1>Track your mood, reflect daily, and build healthier habits.</h1>

        <p class="desc">
            Sirius helps university students manage stress, write private journals,
            set wellness goals, and understand emotional patterns through simple dashboards.
        </p>

        <div class="buttons">
            @auth
                <a href="{{ route('dashboard') }}" class="btn-primary">
                    Go to Dashboard
                </a>
            @else
                <a href="{{ route('register') }}" class="btn-primary">
                    Get Started
                </a>
            @endauth

            <a href="#features" class="btn-secondary">
                Learn More
            </a>
        </div>
    </div>

    <div class="card">
        <h2>Today's Check-in</h2>

        <div class="mood">
            😊 Feeling: Calm
        </div>

        <p><strong>Stress Level</strong></p>

        <div class="bar">
            <div class="fill"></div>
        </div>

        <p style="margin-top: 20px;">
            Journal Reminder: Write one thing that went well today.
        </p>
    </div>
</section>

<section class="features" id="features">
    <h2>Core Features</h2>
    <p>Sirius combines simple tools for daily student wellness.</p>

    <div class="feature-grid">
        <div class="feature">
            <h3>Mood Tracker</h3>
            <p>Record daily mood and stress level.</p>
        </div>

        <div class="feature">
            <h3>Private Journal</h3>
            <p>Write and manage private journal entries.</p>
        </div>

        <div class="feature">
            <h3>AI Comment Filtering</h3>
            <p>Filter harmful or wrong advice on the support board.</p>
        </div>

        <div class="feature">
            <h3>Dashboard</h3>
            <p>View mood and stress trends using charts.</p>
        </div>

        <div class="feature">
            <h3>Wellness Goals</h3>
            <p>Set and track personal wellness goals.</p>
        </div>

        <div class="feature">
            <h3>Resources</h3>
            <p>Find student wellness and support resources.</p>
        </div>
    </div>
</section>

<footer>
    <p>© 2026 Sirius. Student Mental Wellness Platform.</p>
</footer>

</body>
</html>