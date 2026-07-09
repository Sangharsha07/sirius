<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wellness Resources | Sirius</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: Arial, Helvetica, sans-serif; }
        body { background: #f5f7fb; color: #1f2937; }
        .navbar { background: white; padding: 20px 8%; display: flex; justify-content: space-between; align-items: center; box-shadow: 0 2px 12px rgba(0,0,0,0.08); }
        .logo { font-size: 28px; font-weight: bold; color: #2563eb; text-decoration: none; }
        .nav { display: flex; align-items: center; gap: 20px; flex-wrap: wrap; }
        .nav a { text-decoration: none; color: #374151; font-size: 16px; }
        .nav a:hover, .nav a.active { color: #2563eb; }
        .logout-btn { background: #ef4444; color: white; border: none; padding: 9px 14px; border-radius: 10px; cursor: pointer; font-weight: bold; }
        .logout-btn:hover { background: #dc2626; }
        .page { padding: 50px 8%; }
        .page h1 { font-size: 42px; color: #111827; margin-bottom: 10px; }
        .page-desc { color: #4b5563; font-size: 18px; line-height: 1.6; margin-bottom: 30px; max-width: 800px; }
        .grid { display: grid; grid-template-columns: repeat(2, 1fr); gap: 24px; margin-bottom: 30px; }
        .card { background: white; padding: 28px; border-radius: 20px; box-shadow: 0 8px 25px rgba(0,0,0,0.07); display: flex; flex-direction: column; justify-content: space-between; min-height: 180px; }
        .card h2 { color: #111827; font-size: 22px; margin-bottom: 10px; }
        .card p { color: #4b5563; line-height: 1.6; margin-bottom: 18px; font-size: 15px; }
        .card button { width: fit-content; background: #2563eb; color: white; border: none; padding: 10px 18px; border-radius: 10px; font-weight: bold; cursor: pointer; font-size: 15px; }
        .card button:hover { background: #1d4ed8; }
        .card.emergency { border-left: 5px solid #ef4444; }
        .card.emergency h2 { color: #ef4444; }
        .card.emergency button { background: #ef4444; }
        .card.emergency button:hover { background: #dc2626; }
        footer { background: #111827; color: white; text-align: center; padding: 22px; margin-top: 40px; }
        @media (max-width: 800px) { .grid { grid-template-columns: 1fr; } .navbar { flex-direction: column; gap: 15px; } }
    </style>
</head>
<body>

<header class="navbar">
    <a href="/" class="logo">Sirius</a>
    <nav class="nav">
        <a href="/">Home</a>
        <a href="{{ route('dashboard') }}">Dashboard</a>
        <a href="{{ route('mood.index') }}">Mood</a>
        <a href="/journal">Journal</a>
        <a href="/goals">Goals</a>
        <a href="/resources" class="active">Resources</a>
        <a href="{{ route('support.index') }}">Support</a>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="logout-btn">Logout</button>
        </form>
    </nav>
</header>

<section class="page">
    <h1>Wellness Resources</h1>
    <p class="page-desc">This page provides helpful resources for students who need support.</p>

    <div class="grid">
        <div class="card">
            <div>
                <h2>Campus Counseling</h2>
                <p>Information about university counseling and student support services.</p>
            </div>
            <button>View Resource</button>
        </div>

        <div class="card">
            <div>
                <h2>Stress Management</h2>
                <p>Simple techniques for managing academic stress and deadlines.</p>
            </div>
            <button>View Resource</button>
        </div>

        <div class="card">
            <div>
                <h2>Sleep & Routine</h2>
                <p>Tips to improve sleep habits and daily routine.</p>
            </div>
            <button>View Resource</button>
        </div>

        <div class="card emergency">
            <div>
                <h2>🚨 Emergency Support</h2>
                <p>Important contacts and support options for immediate, urgent help on campus.</p>
            </div>
            <button>Get Urgent Help</button>
        </div>
    </div>
</section>

<footer>
    <p>© 2026 Sirius. Student Mental Wellness Platform.</p>
</footer>

</body>
</html>