<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mood Tracker | Sirius</title>
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
    <h1>Mood Tracker</h1>
    <p class="page-desc">
        Students can record their daily mood, stress level, and reason for stress.
    </p>

    <div class="form-box">
        <h2>Today's Check-in</h2>

        <label>Your Mood</label>
        <select>
            <option>😊 Happy</option>
            <option>😌 Calm</option>
            <option>😐 Neutral</option>
            <option>😟 Stressed</option>
            <option>😢 Sad</option>
        </select>

        <label>Stress Level</label>
        <input type="range" min="0" max="100" value="45">

        <label>Reason / Trigger</label>
        <select>
            <option>Exam</option>
            <option>Assignment</option>
            <option>Part-time Job</option>
            <option>Relationship</option>
            <option>Sleep Problem</option>
            <option>Other</option>
        </select>

        <label>Short Note</label>
        <textarea placeholder="Write how you feel today..."></textarea>

        <button onclick="alert('Mood saved. Backend will be added later.')">
            Save Mood
        </button>
    </div>

    <div class="section-box">
        <h2>Recent Mood Entries</h2>

        <div class="list-item">
            <strong>😊 Calm</strong>
            <p>Stress: 45% | Trigger: Exam | Today</p>
        </div>

        <div class="list-item">
            <strong>😟 Stressed</strong>
            <p>Stress: 70% | Trigger: Assignment | Yesterday</p>
        </div>

        <div class="list-item">
            <strong>😌 Relaxed</strong>
            <p>Stress: 30% | Trigger: Sleep | 2 days ago</p>
        </div>
    </div>
</section>

<footer>
    <p>© 2026 Sirius. Student Mental Wellness Platform.</p>
</footer>

</body>
</html>