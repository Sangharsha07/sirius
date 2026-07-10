<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wellness Resources | Sirius</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: Arial, Helvetica, sans-serif; }
        body {
            min-height: 100vh;
            color: #1f2937;
            background: radial-gradient(circle at 10% 8%, rgba(196, 181, 253, 0.32), transparent 25%),
                        radial-gradient(circle at 91% 17%, rgba(186, 230, 253, 0.48), transparent 28%),
                        linear-gradient(180deg, #eef4ff 0%, #f8fbff 48%, #f7f4ff 100%);
        }
        .navbar { position: sticky; top: 0; z-index: 1000; display: flex; align-items: center; justify-content: space-between; min-height: 80px; padding: 14px 7%; background: rgba(255,255,255,0.86); backdrop-filter: blur(18px); box-shadow: 0 8px 28px rgba(30, 64, 175, 0.07); }
        .brand { color: #312e81; font-size: 28px; font-weight: 900; text-decoration: none; }
        .nav { display: flex; align-items: center; gap: 12px; flex-wrap: wrap; }
        .nav a { display: inline-flex; align-items: center; justify-content: center; padding: 9px 13px; color: #475569; font-size: 14px; font-weight: 800; border-radius: 999px; text-decoration: none; transition: 0.2s ease; border: 1px solid transparent; }
        .nav a:hover, .nav a.active, .nav .active { color: white; background: linear-gradient(135deg, #6366f1, #4f46e5); box-shadow: 0 8px 20px rgba(79, 70, 229, 0.16); }
        .hero { padding: 70px 7% 110px; color: white; background: radial-gradient(circle at 76% 32%, rgba(255,245,185,0.7), transparent 18%), linear-gradient(135deg, #172554 0%, #3730a3 46%, #7c3aed 100%); }
        .hero h1 { font-size: clamp(34px, 4.3vw, 54px); margin-bottom: 14px; line-height: 1.08; }
        .hero p { max-width: 700px; font-size: 17px; line-height: 1.7; color: #e0e7ff; }
        .page { max-width: 1400px; margin: -70px auto 75px; padding: 0 7%; }
        .grid { display: grid; grid-template-columns: repeat(2, minmax(0, 1fr)); gap: 24px; }
        .card { padding: 28px; background: rgba(255,255,255,0.96); border: 1px solid rgba(226,232,240,0.9); border-radius: 24px; box-shadow: 0 20px 52px rgba(30,41,59,0.1); }
        .card h2 { margin-bottom: 10px; font-size: 22px; color: #111827; }
        .card p { color: #64748b; line-height: 1.7; margin-bottom: 16px; }
        .card a { display: inline-block; padding: 11px 16px; color: white; font-weight: 800; border-radius: 12px; text-decoration: none; background: linear-gradient(135deg, #2563eb, #3b82f6); }
        .card .urgent { background: linear-gradient(135deg, #ef4444, #dc2626); }
        footer { padding: 28px; color: white; text-align: center; background: #08142f; }
        @media (max-width: 900px) { .grid { grid-template-columns: 1fr; } }
    </style>
</head>
<body>
<header class="navbar">
    <a href="/" class="brand">Sirius</a>
    <nav class="nav">
        <a href="/">Home</a>
        <a href="{{ route('dashboard') }}">Dashboard</a>
        <a href="{{ route('mood.index') }}">Mood</a>
        <a href="{{ route('journal.index') }}">Journal</a>
        <a href="{{ route('goals.index') }}">Goals</a>
        <a href="{{ route('resources') }}" class="active">Resources</a>
        <a href="{{ route('support.index') }}">Support</a>
    </nav>
</header>

<section class="hero">
    <h1>Find the support you need.</h1>
    <p>Access practical wellness resources, counseling guidance, and urgent help options in one calm, easy-to-navigate space.</p>
</section>

<main class="page">
    <div class="grid">
        <div class="card">
            <h2>Campus Counseling</h2>
            <p>Information about university counseling and student support services.</p>
            <a href="#">View resource</a>
        </div>

        <div class="card">
            <h2>Stress Management</h2>
            <p>Simple techniques for managing academic stress and deadlines.</p>
            <a href="#">View resource</a>
        </div>

        <div class="card">
            <h2>Sleep & Routine</h2>
            <p>Tips to improve sleep habits and daily routine structure plans.</p>
            <a href="#">View resource</a>
        </div>

        <div class="card">
            <h2>Emergency Support</h2>
            <p>Important contacts and support options for urgent help pipelines.</p>
            <a href="#" class="urgent">Get urgent help</a>
        </div>
    </div>
</main>

<footer>© 2026 Sirius. Student mental wellness platform.</footer>
</body>
</html>