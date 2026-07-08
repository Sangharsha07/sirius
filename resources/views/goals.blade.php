<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wellness Goals | Sirius</title>
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
    <h1>Wellness Goals</h1>
    <p class="page-desc">
        Students can create small wellness goals and track their progress.
    </p>

    <div class="form-box">
        <h2>Create New Goal</h2>

        <label>Goal Title</label>
        <input type="text" placeholder="Example: Sleep before 12 AM">

        <label>Goal Category</label>
        <select>
            <option>Sleep</option>
            <option>Study Balance</option>
            <option>Exercise</option>
            <option>Social Life</option>
            <option>Stress Management</option>
        </select>

        <label>Target Date</label>
        <input type="date">

        <button onclick="alert('Goal added. Backend will be added later.')">
            Add Goal
        </button>
    </div>

    <div class="section-box">
        <h2>Current Goals</h2>

        <div class="list-item">
            <strong>Sleep before 12 AM</strong>
            <p>Status: In Progress</p>
        </div>

        <div class="list-item">
            <strong>Drink 2 liters of water</strong>
            <p>Status: Completed today</p>
        </div>

        <div class="list-item">
            <strong>Take study breaks</strong>
            <p>Status: In Progress</p>
        </div>
    </div>
</section>

<footer>
    <p>© 2026 Sirius. Student Mental Wellness Platform.</p>
</footer>

</body>
</html>