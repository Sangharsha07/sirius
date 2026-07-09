<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wellness Goals | Sirius</title>
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
        .form-box, .section-box { background: white; padding: 28px; border-radius: 20px; box-shadow: 0 8px 25px rgba(0,0,0,0.07); margin-bottom: 25px; }
        .form-box h2, .section-box h2 { margin-bottom: 15px; color: #111827; }
        label { display: block; font-weight: bold; margin-top: 16px; margin-bottom: 8px; color: #374151; }
        input, select { width: 100%; padding: 13px; border: 1px solid #d1d5db; border-radius: 12px; font-size: 16px; outline: none; }
        button { margin-top: 18px; background: #2563eb; color: white; border: none; padding: 13px 22px; border-radius: 10px; font-size: 15px; font-weight: bold; cursor: pointer; }
        button:hover { background: #1d4ed8; }
        .list-item { padding: 1.25rem; background: #f9fafb; border-radius: 12px; margin-bottom: 15px; display: flex; justify-content: space-between; align-items: center; }
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
        <a href="{{ route('goals.index') }}" class="active">Goals</a>
        <a href="/resources">Resources</a>
        <a href="{{ route('support.index') }}">Support</a>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="logout-btn">Logout</button>
        </form>
    </nav>
</header>

<section class="page">
    <h1>Wellness Goals</h1>
    <p class="page-desc">Students can create small wellness goals and track their progress.</p>

    @if(session('success'))
        <div style="background: #dcfce7; color: #166534; padding: 15px; border-radius: 12px; margin-bottom: 20px;">
            {{ session('success') }}
        </div>
    @endif

    <div class="form-box">
        <h2>Create New Goal</h2>
        <form method="POST" action="{{ route('goals.store') }}">
            @csrf
            <label>Goal Title</label>
            <input type="text" name="title" required placeholder="Example: Sleep before 12 AM">

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
                <div>
                    <label>Goal Category</label>
                    <select name="category" style="background: white;">
                        <option value="Sleep">🛌 Sleep</option>
                        <option value="Study Balance">📚 Study Balance</option>
                        <option value="Exercise">🏃 Exercise</option>
                        <option value="Social Life">👥 Social Life</option>
                        <option value="Stress Management">🧘 Stress Management</option>
                    </select>
                </div>
                <div>
                    <label>Target Date</label>
                    <input type="date" name="target_date" required>
                </div>
            </div>

            <button type="submit">Add Goal</button>
        </form>
    </div>

    <div class="section-box">
        <h2>Current Goals</h2>
        <div style="display: flex; flex-direction: column;">
            @forelse($goals as $goal)
                <div class="list-item" style="border-left: 5px solid {{ $goal->status === 'Completed' ? '#10b981' : '#f59e0b' }}; opacity: {{ $goal->status === 'Completed' ? 0.75 : 1 }};">
                    <div>
                        <strong style="font-size: 18px; {{ $goal->status === 'Completed' ? 'text-decoration: line-through;' : '' }}">{{ $goal->title }}</strong>
                        <p style="font-size: 13px; color: #6b7280; margin-top: 3px;">Category: {{ $goal->category }} | Due: {{ $goal->target_date }}</p>
                    </div>

                    <form method="POST" action="{{ route('goals.toggle', $goal) }}" style="margin: 0;">
                        @csrf
                        @method('PATCH')
                        <select name="status" onchange="this.form.submit()" style="padding: 6px 12px; font-size: 14px; border-radius: 8px; width: auto; background: white; cursor: pointer;">
                            <option value="In Progress" {{ $goal->status === 'In Progress' ? 'selected' : '' }}>⏳ In Progress</option>
                            <option value="Completed" {{ $goal->status === 'Completed' ? 'selected' : '' }}>✅ Completed</option>
                        </select>
                    </form>
                </div>
            @empty
                <p style="color: #6b7280; font-style: italic; padding: 10px 0;">No personal goals created yet. Set your first focus goal using the form wrapper above!</p>
            @endforelse
        </div>
    </div>
</section>

<footer>
    <p>© 2026 Sirius. Student Mental Wellness Platform.</p>
</footer>

</body>
</html>