<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resources | Sirius</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

    <link rel="icon" type="image/png" href="{{ asset('images/favicon.png') }}">
    <link rel="apple-touch-icon" href="{{ asset('images/favicon.png') }}">
</head>
<body>

<header class="navbar">
    <div class="logo">Sirius</div>

    <nav class="nav">
        <a href="/">Home</a>
        <a href="/dashboard">Dashboard</a>
        <a href="/mood">Mood</a>
        <a href="/journal">Journal</a>
        <a href="/goals">Goals</a>
        <a href="/resources">Resources</a>
        <a href="/support">Support</a>
    </nav>
</header>

<section class="page">
    <h1>Wellness Resources</h1>
    <p class="page-desc">
        This page provides helpful resources for students who need support.
    </p>

    <div class="resource-grid">
        <div class="resource-card">
            <h3>Campus Counseling</h3>
            <p>Information about university counseling and student support services.</p>
            <button>View Resource</button>
        </div>

        <div class="resource-card">
            <h3>Stress Management</h3>
            <p>Simple techniques for managing academic stress and deadlines.</p>
            <button>View Resource</button>
        </div>

        <div class="resource-card">
            <h3>Sleep & Routine</h3>
            <p>Tips to improve sleep habits and daily routine.</p>
            <button>View Resource</button>
        </div>

        <div class="resource-card">
            <h3>Emergency Support</h3>
            <p>Important contacts and support options for urgent help.</p>
            <button>View Resource</button>
        </div>
    </div>
</section>

<footer>
    <p>© 2026 Sirius. Student Mental Wellness Platform.</p>
</footer>
@include('partials.helpline-widget')

</body>
</html>