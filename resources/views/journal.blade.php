<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Private Journal | Sirius</title>
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
    <h1>Private Journal</h1>
    <p class="page-desc">
        Students can write private reflections about their day, stress, goals, and emotions.
    </p>

    <div class="form-box">
        <h2>New Journal Entry</h2>

        <label>Title</label>
        <input type="text" placeholder="Example: Stressful exam week">

        <label>Journal Entry</label>
        <textarea placeholder="Write your thoughts here..."></textarea>

        <button onclick="alert('Journal saved. Backend will be added later.')">
            Save Journal
        </button>
    </div>

    <div class="section-box">
        <h2>Previous Entries</h2>

        <div class="list-item">
            <strong>Exam Week Reflection</strong>
            <p>I felt stressed today, but taking short breaks helped me focus better.</p>
        </div>

        <div class="list-item">
            <strong>Good Day</strong>
            <p>I finished my assignment early and felt more relaxed.</p>
        </div>

        <div class="list-item">
            <strong>Need Better Sleep</strong>
            <p>I noticed that sleeping late made my mood worse the next day.</p>
        </div>
    </div>
</section>

<footer>
    <p>© 2026 Sirius. Student Mental Wellness Platform.</p>
</footer>

</body>
</html>