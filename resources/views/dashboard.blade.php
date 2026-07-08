<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard | Sirius</title>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, Helvetica, sans-serif;
        }

        body {
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
            gap: 22px;
            flex-wrap: wrap;
        }

        .nav a {
            text-decoration: none;
            color: #374151;
            font-size: 16px;
        }

        .nav a:hover,
        .nav a.active {
            color: #2563eb;
        }

        .logout-btn {
            background: #ef4444;
            color: white;
            border: none;
            padding: 10px 16px;
            border-radius: 10px;
            cursor: pointer;
            font-weight: bold;
        }

        .logout-btn:hover {
            background: #dc2626;
        }

        .page {
            padding: 50px 8%;
        }

        .welcome {
            background: linear-gradient(135deg, #2563eb, #60a5fa);
            color: white;
            padding: 35px;
            border-radius: 24px;
            margin-bottom: 30px;
            box-shadow: 0 12px 30px rgba(37, 99, 235, 0.22);
        }

        .welcome h1 {
            font-size: 38px;
            margin-bottom: 10px;
        }

        .welcome p {
            font-size: 18px;
            line-height: 1.6;
        }

        .grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 24px;
            margin-bottom: 30px;
        }

        .card {
            background: white;
            padding: 28px;
            border-radius: 20px;
            box-shadow: 0 8px 25px rgba(0,0,0,0.07);
        }

        .card h2 {
            color: #111827;
            margin-bottom: 12px;
        }

        .card p {
            color: #4b5563;
            line-height: 1.6;
            margin-bottom: 18px;
        }

        .card a {
            display: inline-block;
            background: #2563eb;
            color: white;
            text-decoration: none;
            padding: 12px 18px;
            border-radius: 10px;
            font-weight: bold;
        }

        .card a:hover {
            background: #1d4ed8;
        }

        .stats {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 18px;
            margin-bottom: 30px;
        }

        .stat {
            background: white;
            padding: 24px;
            border-radius: 18px;
            box-shadow: 0 8px 25px rgba(0,0,0,0.06);
            text-align: center;
        }

        .stat h3 {
            font-size: 34px;
            color: #2563eb;
            margin-bottom: 8px;
        }

        .stat p {
            color: #4b5563;
        }

        .section-title {
            font-size: 28px;
            margin-bottom: 20px;
            color: #111827;
        }

        footer {
            background: #111827;
            color: white;
            text-align: center;
            padding: 22px;
            margin-top: 40px;
        }

        @media (max-width: 1000px) {
            .grid {
                grid-template-columns: 1fr 1fr;
            }

            .stats {
                grid-template-columns: 1fr 1fr;
            }
        }

        @media (max-width: 700px) {
            .navbar {
                flex-direction: column;
                gap: 15px;
            }

            .grid,
            .stats {
                grid-template-columns: 1fr;
            }

            .welcome h1 {
                font-size: 30px;
            }
        }
    </style>
</head>
<body>

<header class="navbar">
    <a href="/" class="logo">Sirius</a>

    <nav class="nav">
        <a href="/" >Home</a>
        <a href="{{ route('dashboard') }}" class="active">Dashboard</a>
        <a href="{{ route('mood.index') }}">Mood</a>
        <a href="/journal">Journal</a>
        <a href="/goals">Goals</a>
        <a href="/resources">Resources</a>
        <a href="{{ route('support.index') }}">Support</a>

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="logout-btn">
                Logout
            </button>
        </form>
    </nav>
</header>

<section class="page">

    <div class="welcome">
        <h1>Welcome, {{ Auth::user()->name }} 👋</h1>
        <p>
            This is your Sirius dashboard. From here, you can track your mood,
            write journals, set wellness goals, and join the anonymous support board.
        </p>
    </div>

    <div class="stats">
        <div class="stat">
            <h3>😊</h3>
            <p>Current Mood</p>
        </div>

        <div class="stat">
            <h3>45%</h3>
            <p>Stress Level</p>
        </div>

        <div class="stat">
            <h3>3</h3>
            <p>Goals Active</p>
        </div>

        <div class="stat">
            <h3>AI</h3>
            <p>Advice Filtering</p>
        </div>
    </div>

    <h2 class="section-title">Sirius Tools</h2>

    <div class="grid">
        <div class="card">
            <h2>Mood Tracker</h2>
            <p>
                Record your daily mood, stress level, energy level, and triggers.
            </p>
            <a href="{{ route('mood.index') }}">Open Mood Tracker</a>
        </div>

        <div class="card">
            <h2>Private Journal</h2>
            <p>
                Write private reflections and keep track of your thoughts.
            </p>
            <a href="/journal">Open Journal</a>
        </div>

        <div class="card">
            <h2>Wellness Goals</h2>
            <p>
                Set goals like sleeping better, studying consistently, or taking breaks.
            </p>
            <a href="/goals">Open Goals</a>
        </div>

        <div class="card">
            <h2>Resources</h2>
            <p>
                Find helpful wellness resources for students.
            </p>
            <a href="/resources">Open Resources</a>
        </div>

        <div class="card">
            <h2>Support Board</h2>
            <p>
                Post anonymously and receive supportive advice from others.
            </p>
            <a href="{{ route('support.index') }}">Open Support Board</a>
        </div>

        <div class="card">
            <h2>Profile</h2>
            <p>
                Manage your Breeze account information and password.
            </p>
            <a href="{{ route('profile.edit') }}">Edit Profile</a>
        </div>
    </div>

</section>

<footer>
    <p>© 2026 Sirius. Student Mental Wellness Platform.</p>
</footer>

</body>
</html>