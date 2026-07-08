<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Support Board | Sirius</title>
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
    <h1>Anonymous Support Board</h1>
    <p class="page-desc">
        Students can share encouragement anonymously. Comments will be checked using AI filtering before being shown publicly.
    </p>

    <div class="form-box">
        <h2>Post Anonymous Support</h2>

        <label>Your Message</label>
        <textarea placeholder="Write supportive advice or encouragement..."></textarea>

        <button onclick="alert('AI will check this comment before posting.')">
            Submit for AI Review
        </button>

        <p class="small-note">
            AI filtering helps detect spam, bullying, harmful advice, or unsafe suggestions.
        </p>
    </div>

    <div class="section-box">
        <h2>Community Support</h2>

        <div class="list-item">
            <strong>Anonymous Student</strong>
            <p>You are not alone. Try taking small breaks and talk to someone you trust.</p>
        </div>

        <div class="list-item">
            <strong>Anonymous Student</strong>
            <p>Exam week is hard, but planning one task at a time can make it feel easier.</p>
        </div>

        <div class="list-item">
            <strong>Anonymous Student</strong>
            <p>Remember to rest. Productivity is better when your mind is not overloaded.</p>
        </div>
    </div>
</section>

<footer>
    <p>© 2026 Sirius. Student Mental Wellness Platform.</p>
</footer>

</body>
</html>