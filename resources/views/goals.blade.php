<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wellness Goals | Sirius</title>
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
        .layout { display: grid; grid-template-columns: 1.1fr 0.9fr; gap: 24px; align-items: start; }
        .card { padding: 28px; background: rgba(255,255,255,0.96); border: 1px solid rgba(226,232,240,0.9); border-radius: 24px; box-shadow: 0 20px 52px rgba(30,41,59,0.1); }
        .card h2 { margin-bottom: 8px; font-size: 24px; color: #111827; }
        .card-description { margin-bottom: 20px; color: #64748b; line-height: 1.65; }
        .success-box, .error-box { padding: 14px 16px; margin-bottom: 20px; border-radius: 15px; line-height: 1.6; }
        .success-box { color: #166534; background: #ecfdf3; border: 1px solid #bbf7d0; }
        .error-box { color: #991b1b; background: #fff1f2; border: 1px solid #fecdd3; }
        .field { width: 100%; padding: 13px 14px; margin-top: 8px; color: #1f2937; font-size: 15px; border: 1px solid #dbe4f3; border-radius: 12px; background: #f8faff; }
        .field:focus { outline: none; border-color: #818cf8; box-shadow: 0 0 0 4px rgba(129,140,248,0.12); }
        .form-group { margin-bottom: 16px; }
        .form-group label { display: block; color: #334155; font-size: 14px; font-weight: 800; }
        .form-actions { margin-top: 18px; }
        .save-btn { padding: 13px 18px; color: white; font-weight: 800; border: none; border-radius: 12px; cursor: pointer; background: linear-gradient(135deg, #2563eb, #3b82f6); }
        .goal-list { display: grid; gap: 12px; }
        .goal-item { display: flex; align-items: center; justify-content: space-between; gap: 14px; padding: 16px; background: #f8faff; border: 1px solid #e5eaf3; border-radius: 16px; }
        .goal-item h3 { font-size: 16px; margin-bottom: 4px; color: #111827; }
        .goal-item p { color: #64748b; font-size: 13px; line-height: 1.55; }
        .goal-item select { padding: 8px 10px; border: 1px solid #dbe4f3; border-radius: 10px; background: white; color: #334155; }
        .empty-state { padding: 24px; text-align: center; color: #64748b; background: #f8faff; border: 1px dashed #cbd5e1; border-radius: 16px; }
        footer { padding: 28px; color: white; text-align: center; background: #08142f; }
        @media (max-width: 900px) { .layout { grid-template-columns: 1fr; } }
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
        <a href="{{ route('goals.index') }}" class="active">Goals</a>
        <a href="{{ route('resources') }}">Resources</a>
        <a href="{{ route('support.index') }}">Support</a>
    </nav>
</header>

<section class="hero">
    <h1>Build steady wellness habits.</h1>
    <p>Create small goals, track progress, and keep your wellbeing plans visible alongside the rest of your Sirius routine.</p>
</section>

<main class="page">
    @if(session('success'))
        <div class="success-box">✨ {{ session('success') }}</div>
    @endif

    @if($errors->any())
        <div class="error-box">
            <strong>Please check these fields:</strong>
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="layout">
        <section class="card">
            <h2>Create a new goal</h2>
            <p class="card-description">Set a focus goal for your week and keep it moving forward with a simple status update.</p>

            <form method="POST" action="{{ route('goals.store') }}">
                @csrf
                <div class="form-group">
                    <label for="title">Goal title</label>
                    <input id="title" name="title" type="text" class="field" placeholder="Example: Sleep before 12 AM" required>
                </div>

                <div class="form-group">
                    <label for="category">Category</label>
                    <select id="category" name="category" class="field">
                        <option value="Sleep">Sleep</option>
                        <option value="Study Balance">Study Balance</option>
                        <option value="Exercise">Exercise</option>
                        <option value="Social Life">Social Life</option>
                        <option value="Stress Management">Stress Management</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="target_date">Target date</label>
                    <input id="target_date" name="target_date" type="date" class="field" required>
                </div>

                <div class="form-actions">
                    <button type="submit" class="save-btn">Add goal</button>
                </div>
            </form>
        </section>

        <aside class="card">
            <h2>Your active goals</h2>
            <p class="card-description">Every goal you add here stays connected to your account and updates instantly.</p>

            <div class="goal-list">
                @forelse($goals as $goal)
                    <div class="goal-item">
                        <div>
                            <h3>{{ $goal->title }}</h3>
                            <p>{{ $goal->category }} • {{ $goal->target_date ? \Illuminate\Support\Carbon::parse($goal->target_date)->format('M j, Y') : 'No date set' }}</p>
                        </div>

                        <form method="POST" action="{{ route('goals.toggle', $goal) }}">
                            @csrf
                            @method('PATCH')
                            <select name="status" onchange="this.form.submit()">
                                <option value="In Progress" {{ $goal->status === 'In Progress' ? 'selected' : '' }}>In Progress</option>
                                <option value="Completed" {{ $goal->status === 'Completed' ? 'selected' : '' }}>Completed</option>
                            </select>
                        </form>
                    </div>
                @empty
                    <div class="empty-state">No goals yet. Start by adding your first wellness milestone.</div>
                @endforelse
            </div>
        </aside>
    </div>
</main>

<footer>© 2026 Sirius. Student mental wellness platform.</footer>
</body>
</html>