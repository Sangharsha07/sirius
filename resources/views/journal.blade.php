<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Private & Shared Journal | Sirius</title>
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
        textarea.field { min-height: 150px; resize: vertical; }
        .form-actions { margin-top: 18px; }
        .save-btn { padding: 13px 18px; color: white; font-weight: 800; border: none; border-radius: 12px; cursor: pointer; background: linear-gradient(135deg, #2563eb, #3b82f6); }
        .entry-list { display: grid; gap: 12px; }
        .entry-item { padding: 16px; background: #f8faff; border: 1px solid #e5eaf3; border-radius: 16px; }
        .entry-item h3 { font-size: 16px; margin-bottom: 4px; color: #111827; }
        .entry-meta { margin-top: 8px; color: #64748b; font-size: 12px; font-weight: 700; }
        .entry-content { margin-top: 8px; color: #475569; line-height: 1.65; font-size: 14px; }
        .empty-state { padding: 24px; text-align: center; color: #64748b; background: #f8faff; border: 1px dashed #cbd5e1; border-radius: 16px; }
        footer { padding: 28px; color: white; text-align: center; background: #08142f; }

        /* Dark Mode Styling Rules */
        body.dark-mode {
            background: radial-gradient(circle at 10% 8%, rgba(55, 48, 163, 0.4), transparent 25%),
                        radial-gradient(circle at 91% 17%, rgba(30, 58, 138, 0.5), transparent 28%),
                        linear-gradient(180deg, #0f1a3a 0%, #1a1a40 48%, #1f1a35 100%);
            color: #e5e7eb;
        }
        body.dark-mode .navbar { background: rgba(15, 23, 42, 0.85); border-bottom: 1px solid rgba(51, 65, 85, 0.5); }
        body.dark-mode .brand { color: #e0e7ff; }
        body.dark-mode .nav a { color: #94a3b8; }
        body.dark-mode .nav a:hover, body.dark-mode .nav a.active { color: white; }
        body.dark-mode .card { background: rgba(30, 41, 59, 0.85); border-color: rgba(71, 85, 105, 0.5); box-shadow: 0 20px 52px rgba(0,0,0,0.3); }
        body.dark-mode .card h2, body.dark-mode .entry-item h3 { color: #f1f5f9; }
        body.dark-mode .card-description, body.dark-mode .entry-meta, body.dark-mode .form-group label { color: #94a3b8; }
        body.dark-mode .field { background: #1e293b; border-color: #334155; color: #f1f5f9; }
        body.dark-mode .entry-item { background: #1e293b; border-color: #334155; }
        body.dark-mode .entry-content { color: #cbd5e1; }
        body.dark-mode .entry-item select { background: #0f172a; border-color: #334155; color: #f1f5f9; }
        body.dark-mode .empty-state { background: #1e293b; border-color: #475569; color: #94a3b8; }
        
        .dark-mode-toggle {
            background: rgba(30, 41, 59, 0.05);
            border: 1px solid rgba(148, 163, 184, 0.25);
            cursor: pointer;
            padding: 9px 14px;
            border-radius: 999px;
            font-size: 15px;
            transition: 0.2s ease;
        }
        .dark-mode-toggle:hover { background: rgba(30, 41, 59, 0.15); }
        body.dark-mode .dark-mode-toggle { background: rgba(255, 255, 255, 0.1); border-color: rgba(255, 255, 255, 0.2); }
        body.dark-mode .dark-mode-toggle:hover { background: rgba(255, 255, 255, 0.2); }

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
        <a href="{{ route('journal.index') }}" class="active">Journal</a>
        <a href="{{ route('goals.index') }}">Goals</a>
        <a href="{{ route('resources') }}">Resources</a>
        <a href="{{ route('support.index') }}">Support</a>
        <button id="darkModeToggle" class="dark-mode-toggle">🌙</button>
    </nav>
</header>

<section class="hero">
    <h1>Write with honesty and care.</h1>
    <p>Capture your reflections, choose whether to keep them private, and keep your journaling practice visible alongside the rest of your Sirius wellness routine.</p>
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
            <h2>New reflection</h2>
            <p class="card-description">Write a private note, or share it publicly with the campus community.</p>

            <form method="POST" action="{{ route('journal.store') }}">
                @csrf
                <div class="form-group">
                    <label for="title">Title</label>
                    <input id="title" name="title" type="text" class="field" placeholder="Example: Stressful exam week" required>
                </div>

                <div class="form-group">
                    <label for="is_public">Privacy setting</label>
                    <select id="is_public" name="is_public" class="field">
                        <option value="0">🔒 Private</option>
                        <option value="1">👥 Share publicly</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="content">Journal entry</label>
                    <textarea id="content" name="content" class="field" placeholder="Write your thoughts here..." required></textarea>
                </div>

                <div class="form-actions">
                    <button type="submit" class="save-btn">Save journal entry</button>
                </div>
            </form>
        </section>

        <aside class="card">
            <h2>Your previous entries</h2>
            <p class="card-description">Recent reflections are shown here so your journal feels as connected as the rest of your Sirius experience.</p>

            <div class="entry-list">
                @forelse($previousEntries as $entry)
                    <article class="entry-item">
                        <h3>{{ $entry->title }}</h3>
                        <p class="entry-content">{{ $entry->content }}</p>
                        <p class="entry-meta">
                            {{ $entry->is_public ? 'Shared publicly' : 'Private' }} • {{ $entry->created_at->format('M j, Y') }}
                        </p>
                    </article>
                @empty
                    <div class="empty-state">No journal entries yet. Start with a small reflection.</div>
                @endforelse
            </div>
        </aside>
    </div>
</main>

<footer>© 2026 Sirius. Student mental wellness platform.</footer>

@include('partials.theme-script')
</body>
</html>