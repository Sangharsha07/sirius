<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mood Tracker | Sirius</title>

    {{-- FAVICON --}}
    <link rel="icon" type="image/png" href="{{ asset('images/favicon.png') }}?v=202">
    <link rel="shortcut icon" type="image/png" href="{{ asset('images/favicon.png') }}?v=202">
    <link rel="apple-touch-icon" href="{{ asset('images/favicon.png') }}?v=202">

    <style>
        /* Reset & Base */
        * { margin: 0; padding: 0; box-sizing: border-box; }
        html { scroll-behavior: smooth; }
        body { 
            min-height: 100vh; 
            color: #1f2937; 
            font-family: Arial, Helvetica, sans-serif; 
            background: radial-gradient(circle at 10% 8%, rgba(196, 181, 253, 0.32), transparent 25%), 
                        radial-gradient(circle at 91% 17%, rgba(186, 230, 253, 0.48), transparent 28%), 
                        linear-gradient(180deg, #eef4ff 0%, #f8fbff 48%, #f7f4ff 100%); 
        }
        button, input, textarea, select { font: inherit; }
        a { text-decoration: none; }
        .hidden { display: none !important; }

        /* Navbar */
        .navbar { position: sticky; top: 0; z-index: 1000; display: flex; align-items: center; justify-content: space-between; min-height: 80px; padding: 14px 7%; background: rgba(255, 255, 255, 0.86); border-bottom: 1px solid rgba(203, 213, 225, 0.75); backdrop-filter: blur(18px); box-shadow: 0 8px 28px rgba(30, 64, 175, 0.07); }
        .brand { display: flex; align-items: center; gap: 12px; color: #312e81; font-size: 28px; font-weight: 900; }
        .brand img { width: 50px; height: 50px; object-fit: contain; border-radius: 50%; box-shadow: 0 9px 24px rgba(79, 70, 229, 0.2); }
        .nav { display: flex; align-items: center; justify-content: flex-end; gap: 12px; flex-wrap: wrap; }
        .nav a { display: inline-flex; align-items: center; justify-content: center; padding: 9px 13px; color: #475569; font-size: 14px; font-weight: 800; border-radius: 999px; text-decoration: none; transition: 0.2s ease; border: 1px solid transparent; }
        .nav a:hover,
        .nav a.active,
        .nav .active { color: white; background: linear-gradient(135deg, #6366f1, #4f46e5); box-shadow: 0 8px 20px rgba(79, 70, 229, 0.2); }

        /* Hero */
        .hero { position: relative; overflow: hidden; padding: 70px 7% 120px; color: white; background: radial-gradient(circle at 76% 32%, rgba(255, 245, 185, 0.7), transparent 18%), linear-gradient(135deg, #172554 0%, #3730a3 46%, #7c3aed 100%); }
        .hero::before { content: ""; position: absolute; inset: 0; opacity: 0.55; background-image: radial-gradient(circle, rgba(255, 255, 255, 0.9) 1px, transparent 1px), radial-gradient(circle, rgba(255, 255, 255, 0.45) 1px, transparent 1px); background-size: 88px 88px, 135px 135px; background-position: 15px 22px, 65px 76px; }
        .hero-inner { position: relative; z-index: 2; display: grid; grid-template-columns: 1.2fr 0.8fr; align-items: center; gap: 45px; max-width: 1400px; margin: 0 auto; }
        .hero-badge { display: inline-flex; align-items: center; gap: 8px; margin-bottom: 20px; padding: 10px 16px; color: #fff7c2; font-size: 14px; font-weight: 900; background: rgba(255, 255, 255, 0.13); border: 1px solid rgba(255, 255, 255, 0.23); border-radius: 999px; backdrop-filter: blur(10px); }
        .hero h1 { max-width: 760px; margin-bottom: 19px; font-size: clamp(42px, 5vw, 66px); line-height: 1.06; letter-spacing: -2px; }
        .hero h1 span { color: #fef3c7; }
        .hero-description { max-width: 720px; color: #e0e7ff; font-size: 18px; line-height: 1.75; }
        .hero-tags { display: flex; gap: 10px; flex-wrap: wrap; margin-top: 27px; }
        .hero-tag { padding: 10px 14px; font-size: 13px; font-weight: 800; background: rgba(255, 255, 255, 0.12); border: 1px solid rgba(255, 255, 255, 0.17); border-radius: 999px; backdrop-filter: blur(8px); }
        .hero-star-area { position: relative; display: flex; align-items: center; justify-content: center; min-height: 280px; }
        .hero-orbit { position: absolute; width: 270px; height: 270px; border: 1px dashed rgba(255, 255, 255, 0.38); border-radius: 50%; animation: orbit 28s linear infinite; }
        .hero-orbit::before { content: "✦"; position: absolute; top: 24px; left: 42px; color: #bfdbfe; font-size: 25px; }
        .hero-orbit::after { content: "✦"; position: absolute; right: 35px; bottom: 38px; color: #fef3c7; font-size: 19px; }
        .hero-star { color: #fff8c5; font-size: 150px; text-shadow: 0 0 23px rgba(254, 243, 199, 0.85), 0 0 65px rgba(254, 243, 199, 0.45); animation: starPulse 3s ease-in-out infinite; }

        /* Shared Layouts & Cards */
        .page { position: relative; z-index: 5; max-width: 1450px; margin: -70px auto 75px; padding: 0 7%; }
        .layout { display: grid; grid-template-columns: minmax(0, 1.55fr) minmax(310px, 0.7fr); gap: 27px; align-items: start; }
        .card { margin-bottom: 27px; padding: 31px; background: rgba(255, 255, 255, 0.95); border: 1px solid rgba(226, 232, 240, 0.92); border-radius: 27px; box-shadow: 0 20px 52px rgba(30, 41, 59, 0.1); }
        .card h2 { margin-bottom: 9px; color: #111827; font-size: 27px; }
        .card-description { color: #64748b; font-size: 15px; line-height: 1.65; }

        /* Shared Feedback Boxes */
        .success-box, .error-box, .ai-error-state { padding: 16px; margin-bottom: 20px; border-radius: 15px; line-height: 1.6; }
        .success-box { display: flex; gap: 10px; color: #166534; background: #ecfdf3; border: 1px solid #bbf7d0; }
        .error-box, .ai-error-state { color: #991b1b; background: #fff1f2; border: 1px solid #fecdd3; }
        .ai-error-state { font-size: 13px; border-radius: 13px; padding: 14px; margin-bottom: 0; }
        .error-box ul { margin-top: 7px; padding-left: 21px; }

        /* Mood Form */
        .section-heading { display: flex; align-items: center; gap: 14px; margin-bottom: 8px; }
        .section-icon { display: flex; align-items: center; justify-content: center; width: 52px; height: 52px; font-size: 26px; background: linear-gradient(135deg, #e0e7ff, #f3e8ff); border-radius: 17px; }
        .mood-grid { display: grid; grid-template-columns: repeat(5, 1fr); gap: 13px; margin: 26px 0; }
        .mood-option { padding: 18px 9px; color: #64748b; text-align: center; cursor: pointer; background: #f8faff; border: 2px solid transparent; border-radius: 18px; transition: 0.2s ease; }
        .mood-option:hover { transform: translateY(-4px); background: #f3f4ff; }
        .mood-option span { display: block; margin-bottom: 8px; font-size: 35px; }
        .mood-option p { font-size: 13px; font-weight: 900; }
        .mood-option.selected { color: #4338ca; background: #eef2ff; border-color: #818cf8; box-shadow: 0 10px 24px rgba(99, 102, 241, 0.16); }
        .form-group { margin-top: 20px; }
        .form-label { display: block; margin-bottom: 8px; color: #334155; font-size: 14px; font-weight: 900; }
        
        /* Shared Inputs */
        .field { width: 100%; padding: 14px; color: #1f2937; font-size: 15px; outline: none; background: #f8faff; border: 1px solid #dbe4f3; border-radius: 13px; transition: 0.2s; }
        .field:focus { background: white; border-color: #818cf8; box-shadow: 0 0 0 4px rgba(129, 140, 248, 0.12); }
        textarea.field { min-height: 145px; line-height: 1.7; resize: vertical; }
        .two-column { display: grid; grid-template-columns: 1fr 1fr; gap: 18px; }
        .range-row { display: flex; align-items: center; gap: 12px; }
        input[type="range"] { width: 100%; accent-color: #6366f1; }
        .range-value { min-width: 63px; padding: 8px 9px; color: #4f46e5; font-size: 13px; font-weight: 900; text-align: center; background: #eef2ff; border-radius: 10px; }
        
        /* Buttons */
        .form-actions { display: flex; gap: 12px; flex-wrap: wrap; margin-top: 25px; }
        .ai-btn, .save-btn { padding: 14px 22px; color: white; font-size: 14px; font-weight: 900; cursor: pointer; border: none; border-radius: 13px; transition: 0.2s; }
        .ai-btn { flex: 1; background: linear-gradient(135deg, #7c3aed, #6366f1); box-shadow: 0 12px 27px rgba(99, 102, 241, 0.23); }
        .save-btn { min-width: 145px; background: linear-gradient(135deg, #2563eb, #3b82f6); box-shadow: 0 12px 27px rgba(37, 99, 235, 0.2); }
        .ai-btn:hover, .save-btn:hover { transform: translateY(-2px); }
        .ai-btn:disabled { cursor: wait; opacity: 0.72; transform: none; }
        .privacy-note { display: flex; align-items: flex-start; gap: 8px; margin-top: 13px; color: #64748b; font-size: 12px; line-height: 1.55; }

        /* Current Selection Panel */
        .summary-card { overflow: hidden; background: radial-gradient(circle at top right, rgba(255, 247, 186, 0.5), transparent 31%), linear-gradient(135deg, #3730a3, #6366f1, #7c3aed); }
        .summary-card h2 { color: white; }
        .summary-card p { color: white; line-height: 1.7; }
        .summary-emoji { margin: 19px 0; font-size: 62px; }
        .summary-bars { display: grid; gap: 12px; margin-top: 20px; }
        .summary-bar-label { display: flex; justify-content: space-between; margin-bottom: 6px; color: #e0e7ff; font-size: 12px; font-weight: 800; }
        .summary-bar { overflow: hidden; height: 9px; background: rgba(255, 255, 255, 0.2); border-radius: 999px; }
        .summary-bar-fill { height: 100%; background: #fff7c2; border-radius: 999px; transition: width 0.3s; }

        /* AI Insight Card */
        .ai-insight-card { position: sticky; top: 102px; overflow: hidden; border: 1px solid #ddd6fe; background: radial-gradient(circle at top right, rgba(196, 181, 253, 0.3), transparent 37%), white; }
        .ai-insight-heading { display: flex; align-items: flex-start; gap: 13px; margin-bottom: 22px; }
        .ai-star { display: flex; align-items: center; justify-content: center; min-width: 49px; height: 49px; color: #fff7c2; font-size: 28px; background: linear-gradient(135deg, #6366f1, #8b5cf6); border-radius: 16px; box-shadow: 0 10px 24px rgba(99, 102, 241, 0.25); }
        .ai-insight-heading h2 { margin-bottom: 5px; font-size: 23px; }
        .ai-insight-heading p { color: #64748b; font-size: 13px; line-height: 1.55; }
        
        #aiWaitingState, #aiLoadingState { text-align: center; background: #f8f7ff; border-radius: 17px; }
        #aiWaitingState { padding: 24px; }
        #aiLoadingState { padding: 30px; }
        .ai-waiting-icon { margin-bottom: 12px; font-size: 47px; }
        #aiWaitingState p { color: #4b5563; line-height: 1.6; }
        #aiWaitingState small { display: block; margin-top: 10px; color: #8b8fa3; line-height: 1.5; }
        .ai-loader { width: 44px; height: 44px; margin: 0 auto 16px; border: 5px solid #e0e7ff; border-top-color: #6366f1; border-radius: 50%; animation: siriusSpin 0.85s linear infinite; }
        
        .ai-result-top { display: flex; align-items: center; gap: 14px; margin-bottom: 18px; }
        .ai-result-emoji { display: flex; align-items: center; justify-content: center; width: 66px; height: 66px; font-size: 36px; background: linear-gradient(135deg, #eef2ff, #f5f3ff); border-radius: 20px; }
        .ai-small-label { margin-bottom: 4px; color: #8b8fa3; font-size: 10px; font-weight: 900; text-transform: uppercase; letter-spacing: 0.7px; }
        #aiResultMood { color: #312e81; font-size: 24px; }
        .ai-estimate-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 8px; margin-bottom: 17px; }
        .ai-estimate-box { padding: 12px 6px; text-align: center; background: #f8f7ff; border: 1px solid #ede9fe; border-radius: 13px; }
        .ai-estimate-box span { display: block; margin-bottom: 5px; color: #7c7f91; font-size: 10px; }
        .ai-estimate-box strong { color: #4f46e5; font-size: 14px; }
        .ai-insight-message { margin-bottom: 14px; padding: 15px; background: #eef2ff; border-radius: 14px; }
        .ai-insight-message strong { color: #4338ca; font-size: 13px; }
        .ai-insight-message p { margin-top: 7px; color: #475569; font-size: 13px; line-height: 1.65; }
        .ai-advice { padding: 15px; background: #f0fdf4; border-radius: 14px; }
        .ai-advice strong { color: #166534; font-size: 13px; }
        .ai-advice ul { margin-top: 10px; padding-left: 20px; color: #475569; }
        .ai-advice li { margin-bottom: 8px; font-size: 13px; line-height: 1.55; }
        .high-stress-box { margin-top: 15px; padding: 16px; background: #fffbeb; border: 1px solid #fde68a; border-radius: 14px; }
        .high-stress-box strong { color: #92400e; }
        .high-stress-box p { margin: 8px 0 12px; color: #78350f; font-size: 13px; line-height: 1.6; }
        .high-stress-box a { display: inline-block; padding: 9px 12px; color: white; font-size: 12px; font-weight: 900; background: #d97706; border-radius: 10px; }
        .apply-ai-btn { width: 100%; margin-top: 16px; padding: 13px; color: white; font-weight: 900; cursor: pointer; background: linear-gradient(135deg, #6366f1, #7c3aed); border: none; border-radius: 12px; }
        .apply-ai-btn:hover { filter: brightness(1.06); }

        /* Saved Entries */
        .history-heading { display: flex; align-items: center; justify-content: space-between; gap: 15px; margin-bottom: 22px; }
        .entry-count { padding: 8px 12px; color: #4f46e5; font-size: 12px; font-weight: 900; background: #eef2ff; border-radius: 999px; }
        .history-list { display: grid; gap: 15px; }
        .history-item { display: flex; align-items: flex-start; justify-content: space-between; gap: 20px; padding: 18px; background: #f8faff; border: 1px solid #e5eaf3; border-radius: 18px; }
        .history-left { display: flex; gap: 14px; }
        .history-emoji { display: flex; align-items: center; justify-content: center; min-width: 52px; height: 52px; font-size: 29px; background: #eef2ff; border-radius: 15px; }
        .history-title { color: #1e293b; font-size: 18px; }
        .history-meta, .history-note { color: #64748b; font-size: 13px; line-height: 1.65; margin-top: 5px; }
        .history-note { color: #475569; margin-top: 9px; }
        .ai-used-badge { display: inline-block; margin-top: 9px; padding: 5px 8px; color: #6d28d9; font-size: 10px; font-weight: 900; background: #f3e8ff; border-radius: 999px; }
        .history-actions { display: flex; flex-direction: column; align-items: flex-end; gap: 10px; }
        .stress-pill { padding: 8px 11px; color: #2563eb; font-size: 12px; font-weight: 900; white-space: nowrap; background: #dbeafe; border-radius: 999px; }
        .delete-btn { padding: 8px 11px; color: #dc2626; font-size: 11px; font-weight: 900; cursor: pointer; background: #fff1f2; border: none; border-radius: 9px; }
        .delete-btn:hover { background: #ffe4e6; }
        .empty-history { padding: 45px; color: #64748b; text-align: center; background: #f8faff; border: 1px dashed #cbd5e1; border-radius: 18px; }
        .empty-history div { margin-bottom: 11px; font-size: 52px; }

        /* Footer */
        footer { padding: 28px; color: white; text-align: center; background: #08142f; }

        /* Dark Mode Utility Overrides */
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
        body.dark-mode .card h2, body.dark-mode .history-title, body.dark-mode .form-label { color: #f1f5f9; }
        body.dark-mode .card-description, body.dark-mode .history-meta, body.dark-mode .privacy-note { color: #94a3b8; }
        body.dark-mode .field { background: #1e293b; border-color: #334155; color: #f1f5f9; }
        body.dark-mode .field:focus { background: #1e293b; border-color: #818cf8; }
        body.dark-mode .mood-option { background: #1e293b; color: #94a3b8; }
        body.dark-mode .mood-option:hover { background: #243249; }
        body.dark-mode .mood-option.selected { color: #818cf8; background: rgba(99, 102, 241, 0.15); border-color: #818cf8; }
        body.dark-mode .range-value { color: #a5b4fc; background: rgba(99, 102, 241, 0.15); }
        body.dark-mode .history-item { background: #1e293b; border-color: #334155; }
        body.dark-mode .history-note { color: #cbd5e1; }
        body.dark-mode .history-emoji, body.dark-mode .ai-result-emoji { background: #1e293b; }
        body.dark-mode .empty-history { background: #1e293b; border-color: #475569; color: #94a3b8; }
        body.dark-mode .summary-card { background: radial-gradient(circle at top right, rgba(88, 28, 135, 0.4), transparent 31%), linear-gradient(135deg, #1a1a40, #2d1b50, #3d1d5c); }
        body.dark-mode .ai-insight-card { border-color: #4c1d95; background: radial-gradient(circle at top right, rgba(88, 28, 135, 0.2), transparent 37%), #1e293b; }
        body.dark-mode .ai-insight-heading h2 { color: #f1f5f9; }
        body.dark-mode #aiWaitingState, body.dark-mode #aiLoadingState, body.dark-mode .ai-estimate-box { background: #111827; border-color: #334155; }
        body.dark-mode #aiWaitingState p, body.dark-mode .ai-estimate-box strong { color: #e5e7eb; }
        body.dark-mode .ai-insight-message { background: rgba(99, 102, 241, 0.1); }
        body.dark-mode .ai-insight-message p { color: #cbd5e1; }
        body.dark-mode .ai-advice { background: rgba(16, 185, 129, 0.1); }
        body.dark-mode .ai-advice li { color: #cbd5e1; }

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

        /* Animations */
        @keyframes starPulse { 0%, 100% { opacity: 0.92; transform: scale(1); } 50% { opacity: 1; transform: scale(1.08); } }
        @keyframes orbit { from { transform: rotate(0deg); } to { transform: rotate(360deg); } }
        @keyframes siriusSpin { to { transform: rotate(360deg); } }

        /* Responsive */
        @media (max-width: 1050px) {
            .navbar { position: relative; flex-direction: column; gap: 14px; }
            .nav { justify-content: center; }
            .hero-inner { grid-template-columns: 1fr; }
            .hero-star-area { display: none; }
            .layout { grid-template-columns: 1fr; }
            .ai-insight-card { position: relative; top: auto; }
        }
        @media (max-width: 760px) {
            .hero { padding: 55px 6% 100px; }
            .page { padding: 0 4%; }
            .card { padding: 22px; }
            .mood-grid { grid-template-columns: repeat(2, 1fr); }
            .two-column, .ai-estimate-grid { grid-template-columns: 1fr; }
            .form-actions { flex-direction: column; }
            .save-btn { width: 100%; }
            .history-item { flex-direction: column; }
            .history-actions { width: 100%; align-items: flex-start; }
        }
    </style>
</head>
<body>

{{-- NAVBAR --}}
<header class="navbar">
    <a href="/" class="brand">
        <img src="{{ asset('images/siriuslogo.png') }}" alt="Sirius Logo">
        <span>Sirius</span>
    </a>
    <nav class="nav">
        <a href="/">Home</a>
        <a href="{{ route('dashboard') }}">Dashboard</a>
        <a href="{{ route('mood.index') }}" class="active">Mood</a>
        <a href="{{ route('journal.index') }}">Journal</a>
        <a href="{{ route('goals') }}">Goals</a>
        <a href="{{ route('resources') }}">Resources</a>
        <a href="{{ route('support.index') }}">Support</a>
        <button id="darkModeToggle" class="dark-mode-toggle">🌙</button>
    </nav>
</header>

{{-- HERO --}}
<section class="hero">
    <div class="hero-inner">
        <div>
            <div class="hero-badge">✦ Sirius Daily Wellness Check-in</div>
            <h1>Understand your day, <span>one reflection at a time.</span></h1>
            <p class="hero-description">
                Record your mood, stress, energy, and daily reflection. 
                Sirius AI can provide a gentle estimate and suggest small, 
                practical wellness steps based on what you write.
            </p>
            <div class="hero-tags">
                <div class="hero-tag">🌙 Private reflection</div>
                <div class="hero-tag">✨ AI-powered insight</div>
                <div class="hero-tag">🌱 Gentle suggestions</div>
            </div>
        </div>
        <div class="hero-star-area">
            <div class="hero-orbit"></div>
            <div class="hero-star">✦</div>
        </div>
    </div>
</section>

{{-- MAIN PAGE --}}
<main class="page">

    {{-- SUCCESS --}}
    @if(session('success'))
        <div class="success-box">
            <span>✨</span>
            <div>{{ session('success') }}</div>
        </div>
    @endif

    {{-- ERRORS --}}
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

        {{-- LEFT COLUMN --}}
        <div>
            {{-- MOOD FORM --}}
            <section class="card">
                <div class="section-heading">
                    <div class="section-icon">🌤️</div>
                    <div>
                        <h2>Today's Check-in</h2>
                        <p class="card-description">Choose your mood or write a reflection and let Sirius AI provide an estimate.</p>
                    </div>
                </div>

                <form method="POST" action="{{ route('mood.store') }}">
                    @csrf
                    <input type="hidden" name="mood" id="selectedMood" value="{{ old('mood', 'Calm') }}">

                    {{-- MOODS --}}
                    <div class="mood-grid">
                        <div class="mood-option {{ old('mood', 'Calm') === 'Happy' ? 'selected' : '' }}" onclick="selectMood(this, 'Happy')">
                            <span>😊</span><p>Happy</p>
                        </div>
                        <div class="mood-option {{ old('mood', 'Calm') === 'Calm' ? 'selected' : '' }}" onclick="selectMood(this, 'Calm')">
                            <span>😌</span><p>Calm</p>
                        </div>
                        <div class="mood-option {{ old('mood', 'Calm') === 'Neutral' ? 'selected' : '' }}" onclick="selectMood(this, 'Neutral')">
                            <span>😐</span><p>Neutral</p>
                        </div>
                        <div class="mood-option {{ old('mood', 'Calm') === 'Stressed' ? 'selected' : '' }}" onclick="selectMood(this, 'Stressed')">
                            <span>😟</span><p>Stressed</p>
                        </div>
                        <div class="mood-option {{ old('mood', 'Calm') === 'Sad' ? 'selected' : '' }}" onclick="selectMood(this, 'Sad')">
                            <span>😢</span><p>Sad</p>
                        </div>
                    </div>

                    {{-- STRESS AND ENERGY --}}
                    <div class="two-column">
                        <div class="form-group">
                            <label for="stressRange" class="form-label">Stress Level</label>
                            <div class="range-row">
                                <input type="range" name="stress_level" id="stressRange" min="0" max="100" value="{{ old('stress_level', 45) }}" oninput="updateStressValue()">
                                <div class="range-value" id="stressValue">{{ old('stress_level', 45) }}%</div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="energyRange" class="form-label">Energy Level</label>
                            <div class="range-row">
                                <input type="range" name="energy_level" id="energyRange" min="0" max="100" value="{{ old('energy_level', 65) }}" oninput="updateEnergyValue()">
                                <div class="range-value" id="energyValue">{{ old('energy_level', 65) }}%</div>
                            </div>
                        </div>
                    </div>

                    {{-- TRIGGER AND DATE --}}
                    <div class="two-column">
                        <div class="form-group">
                            <label for="trigger" class="form-label">Main Trigger</label>
                            <select name="trigger" id="trigger" class="field">
                                <option value="Exam" {{ old('trigger') === 'Exam' ? 'selected' : '' }}>📚 Exam</option>
                                <option value="Assignment" {{ old('trigger') === 'Assignment' ? 'selected' : '' }}>📝 Assignment</option>
                                <option value="Part-time Job" {{ old('trigger') === 'Part-time Job' ? 'selected' : '' }}>💼 Part-time Job</option>
                                <option value="Sleep Problem" {{ old('trigger') === 'Sleep Problem' ? 'selected' : '' }}>🌙 Sleep Problem</option>
                                <option value="Social Pressure" {{ old('trigger') === 'Social Pressure' ? 'selected' : '' }}>👥 Social Pressure</option>
                                <option value="Family" {{ old('trigger') === 'Family' ? 'selected' : '' }}>🏠 Family</option>
                                <option value="Other" {{ old('trigger', 'Other') === 'Other' ? 'selected' : '' }}>✨ Other</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="moodDate" class="form-label">Date</label>
                            <input type="date" name="entry_date" id="moodDate" class="field" value="{{ old('entry_date', now()->format('Y-m-d')) }}" required>
                        </div>
                    </div>

                    {{-- REFLECTION --}}
                    <div class="form-group">
                        <label for="note" class="form-label">Short Reflection</label>
                        <textarea name="note" id="note" class="field" maxlength="2000" placeholder="Example: I have an exam this week and feel tired because I still have a lot to study.">{{ old('note') }}</textarea>
                    </div>

                    {{-- AI SAVED VALUES --}}
                    <input type="hidden" name="used_ai_suggestion" id="usedAiSuggestion" value="0">
                    <input type="hidden" name="ai_suggested_mood" id="aiSuggestedMood">
                    <input type="hidden" name="ai_suggested_stress" id="aiSuggestedStress">
                    <input type="hidden" name="ai_suggested_energy" id="aiSuggestedEnergy">
                    <input type="hidden" name="ai_suggested_trigger" id="aiSuggestedTrigger">

                    {{-- BUTTONS --}}
                    <div class="form-actions">
                        <button type="button" class="ai-btn" id="aiAnalyzeButton" onclick="analyzeMoodWithAI()">✦ Analyze Reflection with Sirius AI</button>
                        <button type="submit" class="save-btn">Save Mood</button>
                    </div>
                    <p class="privacy-note">
                        <span>🛡️</span>
                        <span>Sirius AI provides a gentle wellness estimate, not a diagnosis. Review the estimate before saving it.</span>
                    </p>
                </form>
            </section>

            {{-- SAVED MOOD ENTRIES --}}
            <section class="card">
                <div class="history-heading">
                    <div>
                        <h2>Saved Mood Entries</h2>
                        <p class="card-description">Review your previous wellness check-ins.</p>
                    </div>
                    <div class="entry-count">{{ $moodEntries->count() }} {{ $moodEntries->count() === 1 ? 'entry' : 'entries' }}</div>
                </div>

                <div class="history-list">
                    @forelse($moodEntries as $entry)
                        <div class="history-item">
                            <div class="history-left">
                                <div class="history-emoji">
                                    @switch($entry->mood)
                                        @case('Happy') 😊 @break
                                        @case('Calm') 😌 @break
                                        @case('Neutral') 😐 @break
                                        @case('Stressed') 😟 @break
                                        @case('Sad') 😢 @break
                                        @default 🙂
                                    @endswitch
                                </div>
                                <div>
                                    <h3 class="history-title">{{ $entry->mood }}</h3>
                                    <div class="history-meta">
                                        Trigger: {{ $entry->trigger ?? 'None' }} <br>
                                        Energy: {{ $entry->energy_level }}% <br>
                                        Date: {{ $entry->entry_date }}
                                    </div>
                                    @if($entry->note)
                                        <p class="history-note">{{ $entry->note }}</p>
                                    @endif
                                    @if($entry->used_ai_suggestion)
                                        <span class="ai-used-badge">✦ Sirius AI estimate used</span>
                                    @endif
                                </div>
                            </div>
                            <div class="history-actions">
                                <div class="stress-pill">Stress {{ $entry->stress_level }}%</div>
                                <form method="POST" action="{{ route('mood.destroy', $entry) }}" onsubmit="return confirm('Delete this mood entry?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="delete-btn">Delete</button>
                                </form>
                            </div>
                        </div>
                    @empty
                        <div class="empty-history">
                            <div>🌙</div>
                            <strong>No mood entries yet</strong>
                            <p>Complete your first check-in above.</p>
                        </div>
                    @endforelse
                </div>
            </section>
        </div>

        {{-- RIGHT COLUMN --}}
        <aside>
            {{-- CURRENT SELECTION --}}
            <section class="card summary-card">
                <h2>Current Selection</h2>
                <div class="summary-emoji" id="summaryMood">😌</div>
                <p id="summaryText">Current mood: Calm. Stress level is 45% and energy level is 65%.</p>

                <div class="summary-bars">
                    <div>
                        <div class="summary-bar-label">
                            <span>Stress</span><span id="summaryStressText">45%</span>
                        </div>
                        <div class="summary-bar">
                            <div class="summary-bar-fill" id="summaryStressBar" style="width: 45%;"></div>
                        </div>
                    </div>
                    <div>
                        <div class="summary-bar-label">
                            <span>Energy</span><span id="summaryEnergyText">65%</span>
                        </div>
                        <div class="summary-bar">
                            <div class="summary-bar-fill" id="summaryEnergyBar" style="width: 65%;"></div>
                        </div>
                    </div>
                </div>
            </section>

            {{-- AI INSIGHT --}}
            <section class="card ai-insight-card" id="aiInsightCard">
                <div class="ai-insight-heading">
                    <div class="ai-star">✦</div>
                    <div>
                        <h2>Sirius AI Insight</h2>
                        <p>Write a reflection and ask Sirius for a gentle estimate.</p>
                    </div>
                </div>

                {{-- WAITING --}}
                <div id="aiWaitingState">
                    <div class="ai-waiting-icon">🌙</div>
                    <p>Your AI wellness insight will appear here.</p>
                    <small>This is a reflection tool, not a medical diagnosis.</small>
                </div>

                {{-- LOADING --}}
                <div id="aiLoadingState" class="hidden">
                    <div class="ai-loader"></div>
                    <p>Sirius is reading your reflection...</p>
                </div>

                {{-- RESULT --}}
                <div id="aiResultState" class="hidden">
                    <div class="ai-result-top">
                        <div class="ai-result-emoji" id="aiResultEmoji">😌</div>
                        <div>
                            <p class="ai-small-label">AI estimated mood</p>
                            <h3 id="aiResultMood">Calm</h3>
                        </div>
                    </div>
                    <div class="ai-estimate-grid">
                        <div class="ai-estimate-box">
                            <span>Stress</span><strong id="aiResultStress">45%</strong>
                        </div>
                        <div class="ai-estimate-box">
                            <span>Energy</span><strong id="aiResultEnergy">65%</strong>
                        </div>
                        <div class="ai-estimate-box">
                            <span>Confidence</span><strong id="aiResultConfidence">Medium</strong>
                        </div>
                    </div>
                    <div class="ai-insight-message">
                        <strong>✨ Gentle insight</strong>
                        <p id="aiResultInsight"></p>
                    </div>
                    <div class="ai-advice">
                        <strong>🌱 Small steps to consider</strong>
                        <ul id="aiAdviceList"></ul>
                    </div>
                    <div class="high-stress-box hidden" id="highStressBox">
                        <strong>💙 Extra support may help</strong>
                        <p>Your reflection suggests that you may be carrying a lot right now. Consider talking with someone you trust or using student support resources.</p>
                        <a href="{{ route('resources') }}">Open Support Resources →</a>
                    </div>
                    <button type="button" class="apply-ai-btn" onclick="applyCurrentAiSuggestion()">Use this AI estimate</button>
                </div>

                {{-- ERROR --}}
                <div id="aiErrorState" class="ai-error-state hidden"></div>
            </section>
        </aside>
    </div>
</main>

<footer>
    <p>✦ © 2026 Sirius. Student Mental Wellness Platform. ✦</p>
</footer>

@include('partials.helpline-widget')

<script>
    /* Mood Values */
    const moodEmojiMap = {
        "Happy": "😊",
        "Calm": "😌",
        "Neutral": "😐",
        "Stressed": "😟",
        "Sad": "😢"
    };
    let currentAiSuggestion = null;

    /* Mood Selection */
    function selectMood(element, mood) {
        document.querySelectorAll(".mood-option").forEach(option => option.classList.remove("selected"));
        element.classList.add("selected");
        document.getElementById("selectedMood").value = mood;
        document.getElementById("summaryMood").innerText = moodEmojiMap[mood];
        updateSummary();
    }

    /* Range Values */
    function updateStressValue() {
        const stress = document.getElementById("stressRange").value;
        document.getElementById("stressValue").innerText = stress + "%";
        updateSummary();
    }

    function updateEnergyValue() {
        const energy = document.getElementById("energyRange").value;
        document.getElementById("energyValue").innerText = energy + "%";
        updateSummary();
    }

    /* Current Summary */
    function updateSummary() {
        const mood = document.getElementById("selectedMood").value;
        const stress = document.getElementById("stressRange").value;
        const energy = document.getElementById("energyRange").value;
        document.getElementById("summaryText").innerText = "Current mood: " + mood + ". Stress level is " + stress + "% and energy level is " + energy + "%.";
        document.getElementById("summaryStressText").innerText = stress + "%";
        document.getElementById("summaryEnergyText").innerText = energy + "%";
        document.getElementById("summaryStressBar").style.width = stress + "%";
        document.getElementById("summaryEnergyBar").style.width = energy + "%";
        document.getElementById("summaryMood").innerText = moodEmojiMap[mood] ?? "🙂";
    }

    /* Analyze Reflection with AI */
    async function analyzeMoodWithAI() {
        const note = document.getElementById("note").value.trim();
        if (note.length < 5) {
            alert("Please write a little more in your reflection before using Sirius AI.");
            return;
        }

        const button = document.getElementById("aiAnalyzeButton");
        const waitingState = document.getElementById("aiWaitingState");
        const loadingState = document.getElementById("aiLoadingState");
        const resultState = document.getElementById("aiResultState");
        const errorState = document.getElementById("aiErrorState");

        button.disabled = true;
        button.innerText = "✦ Sirius is analyzing...";
        waitingState.classList.add("hidden");
        resultState.classList.add("hidden");
        errorState.classList.add("hidden");
        loadingState.classList.remove("hidden");

        try {
            const response = await fetch("{{ route('mood.analyze') }}", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "Accept": "application/json",
                    "X-CSRF-TOKEN": "{{ csrf_token() }}"
                },
                body: JSON.stringify({ note: note })
            });

            const result = await response.json();

            if (!response.ok || !result.success) {
                throw new Error(result.message ?? "Sirius could not analyze this reflection.");
            }

            currentAiSuggestion = result;
            showAiResult(result);

        } catch (error) {
            console.error("Mood analysis failed:", error);
            errorState.innerText = "Sirius AI could not analyze this reflection. " + error.message;
            errorState.classList.remove("hidden");
        } finally {
            loadingState.classList.add("hidden");
            button.disabled = false;
            button.innerText = "✦ Analyze Reflection with Sirius AI";
        }
    }

    /* Show AI Result */
    function showAiResult(result) {
        const resultState = document.getElementById("aiResultState");
        const highStressBox = document.getElementById("highStressBox");

        document.getElementById("aiResultEmoji").innerText = moodEmojiMap[result.mood] ?? "🙂";
        document.getElementById("aiResultMood").innerText = result.mood;
        document.getElementById("aiResultStress").innerText = result.stress + "%";
        document.getElementById("aiResultEnergy").innerText = result.energy + "%";
        document.getElementById("aiResultConfidence").innerText = result.confidence;
        document.getElementById("aiResultInsight").innerText = result.insight;

        const adviceList = document.getElementById("aiAdviceList");
        adviceList.innerHTML = "";
        const adviceItems = Array.isArray(result.advice) ? result.advice : [];
        adviceItems.forEach(advice => {
            const item = document.createElement("li");
            item.innerText = advice;
            adviceList.appendChild(item);
        });

        if (result.support_needed || Number(result.stress) >= 75) {
            highStressBox.classList.remove("hidden");
        } else {
            highStressBox.classList.add("hidden");
        }

        resultState.classList.remove("hidden");
        document.getElementById("aiInsightCard").scrollIntoView({ behavior: "smooth", block: "center" });
    }

    /* Apply AI Estimate */
    function applyCurrentAiSuggestion() {
        if (!currentAiSuggestion) return;
        applySuggestedMood(currentAiSuggestion.mood, currentAiSuggestion.stress, currentAiSuggestion.energy, currentAiSuggestion.trigger);
        
        document.getElementById("usedAiSuggestion").value = "1";
        document.getElementById("aiSuggestedMood").value = currentAiSuggestion.mood;
        document.getElementById("aiSuggestedStress").value = currentAiSuggestion.stress;
        document.getElementById("aiSuggestedEnergy").value = currentAiSuggestion.energy;
        document.getElementById("aiSuggestedTrigger").value = currentAiSuggestion.trigger;
        
        alert("Sirius AI estimate was added to the form. Review it, then click Save Mood.");
    }

    /* Update Form with AI Estimate */
    function applySuggestedMood(mood, stress, energy, trigger) {
        document.getElementById("selectedMood").value = mood;
        document.querySelectorAll(".mood-option").forEach(option => {
            option.classList.remove("selected");
            const moodText = option.querySelector("p").innerText;
            if (moodText === mood) {
                option.classList.add("selected");
            }
        });

        document.getElementById("stressRange").value = stress;
        document.getElementById("energyRange").value = energy;
        document.getElementById("stressValue").innerText = stress + "%";
        document.getElementById("energyValue").innerText = energy + "%";
        document.getElementById("trigger").value = trigger;
        
        updateSummary();
    }

    /* Initial Summary */
    updateSummary();
</script>

@include('partials.theme-script')
</body>
</html>