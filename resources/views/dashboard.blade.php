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
            min-height: 100vh;
            color: #1f2937;
            background: radial-gradient(circle at 10% 8%, rgba(196, 181, 253, 0.32), transparent 25%),
                        radial-gradient(circle at 91% 17%, rgba(186, 230, 253, 0.48), transparent 28%),
                        linear-gradient(180deg, #eef4ff 0%, #f8fbff 48%, #f7f4ff 100%);
        }

        .navbar {
            position: sticky;
            top: 0;
            z-index: 1000;
            padding: 14px 7%;
            display: flex;
            justify-content: space-between;
            align-items: center;
            background: rgba(255,255,255,0.86);
            backdrop-filter: blur(18px);
            box-shadow: 0 8px 28px rgba(30, 64, 175, 0.07);
        }

        .logo {
            font-size: 28px;
            font-weight: 900;
            color: #312e81;
            text-decoration: none;
        }

        .nav {
            display: flex;
            align-items: center;
            gap: 12px;
            flex-wrap: wrap;
        }

        .nav a {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            text-decoration: none;
            color: #475569;
            font-size: 14px;
            font-weight: 800;
            padding: 9px 13px;
            border-radius: 999px;
            transition: 0.2s ease;
            border: 1px solid transparent;
        }

        .nav a:hover,
        .nav a.active,
        .nav .active {
            color: white;
            background: linear-gradient(135deg, #6366f1, #4f46e5);
            box-shadow: 0 8px 20px rgba(79, 70, 229, 0.16);
        }

        .logout-btn {
            background: linear-gradient(135deg, #6366f1, #4f46e5);
            color: white;
            border: none;
            padding: 10px 16px;
            border-radius: 10px;
            cursor: pointer;
            font-weight: 800;
        }

        .logout-btn:hover {
            filter: brightness(1.05);
        }

        .page {
            padding: 50px 7%;
            max-width: 1400px;
            margin: 0 auto;
        }

        .welcome {
            background: radial-gradient(circle at top right, rgba(255, 247, 186, 0.5), transparent 31%), linear-gradient(135deg, #3730a3, #6366f1, #7c3aed);
            color: white;
            padding: 35px;
            border-radius: 24px;
            margin-bottom: 30px;
            box-shadow: 0 20px 50px rgba(79, 70, 229, 0.2);
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
            background: rgba(255,255,255,0.95);
            padding: 28px;
            border-radius: 20px;
            border: 1px solid rgba(226,232,240,0.9);
            box-shadow: 0 20px 52px rgba(30,41,59,0.1);
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
            background: linear-gradient(135deg, #2563eb, #3b82f6);
            color: white;
            text-decoration: none;
            padding: 12px 18px;
            border-radius: 10px;
            font-weight: 800;
        }

        .card a:hover {
            filter: brightness(1.05);
        }

        .stats {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 18px;
            margin-bottom: 30px;
        }

        .stat {
            background: rgba(255,255,255,0.95);
            padding: 24px;
            border-radius: 18px;
            border: 1px solid rgba(226,232,240,0.9);
            box-shadow: 0 20px 52px rgba(30,41,59,0.08);
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
            background: #08142f;
            color: white;
            text-align: center;
            padding: 28px;
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
    <link rel="icon" type="image/png" href="{{ asset('images/favicon.png') }}">
    <link rel="apple-touch-icon" href="{{ asset('images/favicon.png') }}">
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
@include('partials.helpline-widget')

</body>
</html>