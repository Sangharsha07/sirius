<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sirius Dashboard</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
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
    <h1>Wellness Dashboard</h1>
    <p class="page-desc">
        This page shows a summary of the student's mood, stress level, goals, and journal activity.
    </p>

    <div class="dashboard-grid">
        <div class="dashboard-card">
            <h3>Today's Mood</h3>
            <p class="big-text">😊 Calm</p>
            <p>You are feeling better than yesterday.</p>
        </div>

        <div class="dashboard-card">
            <h3>Stress Level</h3>
            <p class="big-text">45%</p>
            <div class="bar">
                <div class="fill"></div>
            </div>
        </div>

        <div class="dashboard-card">
            <h3>Active Goals</h3>
            <p class="big-text">3</p>
            <p>Sleep early, drink water, study with breaks.</p>
        </div>

        <div class="dashboard-card">
            <h3>Journal Entries</h3>
            <p class="big-text">8</p>
            <p>You wrote 8 journal entries this month.</p>
        </div>
    </div>

    <div class="section-box">
        <h2>Weekly Mood Trend</h2>
        <div class="chart-box">
            <div style="height: 60%;">Mon</div>
            <div style="height: 75%;">Tue</div>
            <div style="height: 45%;">Wed</div>
            <div style="height: 80%;">Thu</div>
            <div style="height: 65%;">Fri</div>
            <div style="height: 90%;">Sat</div>
            <div style="height: 70%;">Sun</div>
        </div>
    </div>
</section>

<footer>
    <p>© 2026 Sirius. Student Mental Wellness Platform.</p>
</footer>

</body>
</html>