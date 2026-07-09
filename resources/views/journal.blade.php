<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Private Journal | Sirius</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <style>
        /* Shared foundation overrides to perfectly pull styles from your master layouts */
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
        input, select, textarea { width: 100%; padding: 13px; border: 1px solid #d1d5db; border-radius: 12px; font-size: 16px; outline: none; }
        textarea { min-height: 130px; resize: vertical; }
        button { margin-top: 18px; background: #2563eb; color: white; border: none; padding: 13px 22px; border-radius: 10px; font-size: 15px; font-weight: bold; cursor: pointer; }
        button:hover { background: #1d4ed8; }
        .list-item { padding: 1.25rem; background: #f9fafb; border-radius: 12px; border-left: 4px solid #2563eb; margin-bottom: 15px; }
        .list-item-top { display: flex; justify-content: space-between; align-items: center; margin-bottom: 5px; }
        .privacy-pill { font-size: 12px; font-weight: bold; padding: 4px 10px; border-radius: 999px; }
        .pill-private { background: #fee2e2; color: #ef4444; }
        .pill-public { background: #dcfce7; color: #166534; }
    </style>
</head>
<body>

<header class="navbar">
    <a href="/" class="logo">Sirius</a>
    <nav class="nav">
        <a href="/">Home</a>
        <a href="{{ route('dashboard') }}">Dashboard</a>
        <a href="{{ route('mood.index') }}">Mood</a>
        <a href="/journal" class="active">Journal</a>
        <a href="/goals">Goals</a>
        <a href="/resources">Resources</a>
        <a href="{{ route('support.index') }}">Support</a>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="logout-btn">Logout</button>
        </form>
    </nav>
</header>

<section class="page">
    <h1>Private Journal</h1>
    <p class="page-desc">Students can write reflections about their day, stress, goals, and emotions.</p>

    @if(session('success'))
        <div style="background: #dcfce7; color: #166534; padding: 15px; border-radius: 12px; margin-bottom: 20px;">
            {{ session('success') }}
        </div>
    @endif

    <div class="form-box">
        <h2>New Journal Entry</h2>
        <form method="POST" action="{{ route('journal.store') }}">
            @csrf
            <div style="display: grid; grid-template-columns: 2fr 1fr; gap: 20px;">
                <div>
                    <label>Title</label>
                    <input type="text" name="title" required placeholder="Example: Stressful exam week">
                </div>
                <div>
                    <label>Privacy Setting</label>
                    <select name="is_public" style="background: white;">
                        <option value="0">🔒 Private (Only Me)</option>
                        <option value="1">👥 Public (Post to Forum)</option>
                    </select>
                </div>
            </div>

            <label>Journal Entry</label>
            <textarea name="content" required placeholder="Write your thoughts here..."></textarea>

            <button type="submit">Save Journal</button>
        </form>
    </div>

    <div class="section-box">
        <h2>Previous Entries</h2>
        <div style="display: flex; flex-direction: column;">
            @forelse($previousEntries ?? [] as $entry)
                <div class="list-item" style="border-left-color: {{ $entry->is_public ? '#7c3aed' : '#2563eb' }};">
                    <div class="list-item-top">
                        <strong style="font-size: 18px;">{{ $entry->title }}</strong>
                        <span class="privacy-pill {{ $entry->is_public ? 'pill-public' : 'pill-private' }}">
                            {{ $entry->is_public ? '👥 Public Forum' : '🔒 Private' }}
                        </span>
                    </div>
                    <p style="color: #4b5563; margin-top: 5px;">{{ $entry->content }}</p>
                    <span style="display: block; font-size: 12px; color: #9ca3af; margin-top: 8px;">{{ $entry->created_at->format('M d, Y • h:i A') }}</span>
                </div>
            @empty
                <div class="list-item">
                    <div class="list-item-top">
                        <strong style="font-size: 18px;">Exam Week Reflection</strong>
                        <span class="privacy-pill pill-private">🔒 Private</span>
                    </div>
                    <p style="color: #4b5563; margin-top: 5px;">I felt stressed today, but taking short breaks helped me focus better.</p>
                </div>
                <div class="list-item">
                    <div class="list-item-top">
                        <strong style="font-size: 18px;">Good Day</strong>
                        <span class="privacy-pill pill-private">🔒 Private</span>
                    </div>
                    <p style="color: #4b5563; margin-top: 5px;">I finished my assignment early and felt more relaxed.</p>
                </div>
            @endforelse
        </div>
    </div>
</section>

<footer>
    <p>© 2026 Sirius. Student Mental Wellness Platform.</p>
</footer>

</body>
</html>