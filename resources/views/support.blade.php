<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sirius Support Community</title>

    <link rel="icon" type="image/png" href="{{ asset('images/favicon.png') }}?v=101">
    <link rel="shortcut icon" type="image/png" href="{{ asset('images/favicon.png') }}?v=101">

    <style>
        /* ---------------------------------
           RESET & BASE
        ---------------------------------- */
        * { box-sizing: border-box; margin: 0; padding: 0; }
        html { scroll-behavior: smooth; }
        body {
            min-height: 100vh;
            font-family: Arial, Helvetica, sans-serif;
            color: #1f2937;
            background: radial-gradient(circle at 12% 8%, rgba(196, 181, 253, 0.42), transparent 24%),
                        radial-gradient(circle at 90% 22%, rgba(186, 230, 253, 0.55), transparent 25%),
                        linear-gradient(180deg, #eef4ff 0%, #f9fbff 42%, #f7f4ff 100%);
        }
        a { text-decoration: none; }
        button, input, textarea, select { font: inherit; }

        /* ---------------------------------
           NAVBAR
        ---------------------------------- */
        .navbar {
            position: sticky; top: 0; z-index: 1000; display: flex; align-items: center; justify-content: space-between;
            min-height: 78px; padding: 13px 7%; background: rgba(255, 255, 255, 0.82); border-bottom: 1px solid rgba(203, 213, 225, 0.7);
            backdrop-filter: blur(18px); box-shadow: 0 7px 28px rgba(30, 64, 175, 0.07);
        }
        .brand { display: flex; align-items: center; gap: 12px; color: #312e81; font-size: 27px; font-weight: 800; }
        .brand img { width: 49px; height: 49px; border-radius: 50%; object-fit: contain; box-shadow: 0 8px 22px rgba(79, 70, 229, 0.18); }
        .nav-links { display: flex; align-items: center; justify-content: flex-end; gap: 17px; flex-wrap: wrap; }
        .nav-links a { color: #475569; font-size: 14px; font-weight: 700; padding: 9px 11px; border-radius: 11px; transition: 0.2s; }
        .nav-links a:hover { color: #4f46e5; background: #eef2ff; }
        .nav-links .active { color: white; background: linear-gradient(135deg, #6366f1, #4f46e5); box-shadow: 0 8px 20px rgba(79, 70, 229, 0.2); }
        .logout-button { padding: 9px 13px; color: #475569; font-size: 14px; font-weight: 700; cursor: pointer; background: transparent; border: none; border-radius: 11px; }
        .logout-button:hover { color: #dc2626; background: #fef2f2; }

        /* ---------------------------------
           HERO
        ---------------------------------- */
        .support-hero {
            position: relative; overflow: hidden; padding: 75px 7% 135px; color: white;
            background: radial-gradient(circle at 75% 35%, rgba(255, 246, 190, 0.7), transparent 16%),
                        linear-gradient(135deg, #172554 0%, #3730a3 45%, #7c3aed 100%);
        }
        .support-hero::before {
            content: ""; position: absolute; inset: 0; opacity: 0.65;
            background-image: radial-gradient(circle, rgba(255, 255, 255, 0.9) 1px, transparent 1px),
                              radial-gradient(circle, rgba(255, 255, 255, 0.45) 1px, transparent 1px);
            background-size: 88px 88px, 135px 135px; background-position: 15px 25px, 65px 75px;
        }
        .hero-inner { position: relative; z-index: 2; display: grid; grid-template-columns: 1.2fr 0.8fr; align-items: center; gap: 45px; max-width: 1400px; margin: 0 auto; }
        .hero-badge { display: inline-flex; align-items: center; gap: 8px; margin-bottom: 21px; padding: 10px 16px; color: #fff7c2; font-size: 14px; font-weight: 800; background: rgba(255, 255, 255, 0.13); border: 1px solid rgba(255, 255, 255, 0.22); border-radius: 999px; backdrop-filter: blur(10px); }
        .hero-copy h1 { max-width: 770px; margin-bottom: 20px; font-size: clamp(40px, 5vw, 66px); line-height: 1.05; letter-spacing: -2px; }
        .hero-copy h1 span { color: #fef3c7; }
        .hero-copy p { max-width: 690px; color: #e0e7ff; font-size: 18px; line-height: 1.75; }
        .hero-reminders { display: flex; gap: 10px; flex-wrap: wrap; margin-top: 28px; }
        .hero-reminder { padding: 10px 14px; color: white; font-size: 13px; font-weight: 700; background: rgba(255, 255, 255, 0.12); border: 1px solid rgba(255, 255, 255, 0.18); border-radius: 999px; backdrop-filter: blur(8px); }
        .hero-star-area { position: relative; display: flex; align-items: center; justify-content: center; min-height: 285px; }
        .hero-star { position: relative; color: #fff8c5; font-size: 150px; text-shadow: 0 0 22px rgba(254, 243, 199, 0.8), 0 0 65px rgba(254, 243, 199, 0.45); animation: starPulse 3s ease-in-out infinite; }
        .hero-orbit { position: absolute; width: 270px; height: 270px; border: 1px dashed rgba(255, 255, 255, 0.38); border-radius: 50%; animation: orbit 28s linear infinite; }
        .hero-orbit::before { content: "✦"; position: absolute; top: 26px; left: 38px; color: #bfdbfe; font-size: 26px; }
        .hero-orbit::after { content: "✦"; position: absolute; right: 32px; bottom: 35px; color: #fef3c7; font-size: 19px; }

        /* ---------------------------------
           PAGE WRAPPER & ALERTS
        ---------------------------------- */
        .page { position: relative; z-index: 4; max-width: 1400px; margin: -75px auto 80px; padding: 0 7%; }
        .flash { display: flex; align-items: flex-start; gap: 12px; margin-bottom: 20px; padding: 17px 19px; line-height: 1.6; border-radius: 17px; box-shadow: 0 10px 28px rgba(15, 23, 42, 0.08); }
        .flash-success { color: #166534; background: #ecfdf3; border: 1px solid #bbf7d0; }
        .flash-warning { color: #92400e; background: #fffbeb; border: 1px solid #fde68a; }
        .flash-error { color: #991b1b; background: #fff1f2; border: 1px solid #fecdd3; }
        .flash-error ul { margin-top: 7px; padding-left: 21px; }

        /* ---------------------------------
           TOP GRID & COMPOSER
        ---------------------------------- */
        .top-grid { display: grid; grid-template-columns: minmax(0, 1.35fr) minmax(280px, 0.65fr); gap: 24px; margin-bottom: 32px; }
        .composer { padding: 33px; background: rgba(255, 255, 255, 0.94); border: 1px solid rgba(224, 231, 255, 0.95); border-radius: 29px; box-shadow: 0 24px 60px rgba(49, 46, 129, 0.13); }
        .composer-heading { display: flex; align-items: center; gap: 16px; margin-bottom: 8px; }
        .composer-icon { display: flex; align-items: center; justify-content: center; width: 55px; height: 55px; font-size: 27px; background: linear-gradient(135deg, #e0e7ff, #f3e8ff); border-radius: 18px; }
        .composer-heading h2 { color: #111827; font-size: 28px; }
        .composer-subtitle { margin: 0 0 25px 71px; color: #64748b; font-size: 15px; line-height: 1.6; }
        .form-group { margin-bottom: 20px; }
        .form-label { display: block; margin-bottom: 9px; color: #334155; font-size: 14px; font-weight: 800; }
        .field { width: 100%; padding: 15px 16px; color: #1f2937; font-size: 15px; outline: none; background: #f8faff; border: 1px solid #dbe4f3; border-radius: 15px; transition: 0.2s; }
        .field:focus { background: white; border-color: #818cf8; box-shadow: 0 0 0 4px rgba(129, 140, 248, 0.13); }
        textarea.field { min-height: 150px; line-height: 1.7; resize: vertical; }
        .field-footer { display: flex; align-items: center; justify-content: space-between; gap: 12px; margin-top: 7px; color: #94a3b8; font-size: 12px; }
        .two-columns { display: grid; grid-template-columns: 1fr 1fr; gap: 16px; }

        /* ---------------------------------
           FLAG / LEVEL OPTIONS
        ---------------------------------- */
        .level-title { margin-bottom: 11px; color: #334155; font-size: 14px; font-weight: 800; }
        .level-grid { display: grid; grid-template-columns: repeat(5, 1fr); gap: 9px; margin-bottom: 22px; }
        .level-option input { display: none; }
        .level-card { display: flex; flex-direction: column; align-items: center; justify-content: center; min-height: 87px; padding: 11px 7px; color: #64748b; font-size: 12px; font-weight: 800; text-align: center; cursor: pointer; background: #f8faff; border: 2px solid transparent; border-radius: 15px; transition: 0.2s; }
        .level-card span { margin-bottom: 6px; font-size: 23px; }
        .level-card:hover { transform: translateY(-3px); background: #f3f4ff; }
        .level-option input:checked + .level-card { color: #4338ca; background: #eef2ff; border-color: #818cf8; box-shadow: 0 8px 20px rgba(99, 102, 241, 0.15); }
        .submit-post { display: flex; align-items: center; justify-content: center; width: 100%; padding: 15px 20px; color: white; font-size: 16px; font-weight: 800; cursor: pointer; background: linear-gradient(135deg, #6366f1, #7c3aed); border: none; border-radius: 15px; box-shadow: 0 13px 28px rgba(99, 102, 241, 0.23); transition: 0.2s; }
        .submit-post:hover { transform: translateY(-2px); box-shadow: 0 17px 31px rgba(99, 102, 241, 0.3); }
        .moderation-note { display: flex; align-items: flex-start; gap: 9px; margin-top: 13px; color: #64748b; font-size: 12px; line-height: 1.55; }

        /* ---------------------------------
           SIDE INFO
        ---------------------------------- */
        .side-column { display: flex; flex-direction: column; gap: 18px; }
        .side-card { padding: 25px; background: rgba(255, 255, 255, 0.89); border: 1px solid rgba(224, 231, 255, 0.95); border-radius: 25px; box-shadow: 0 18px 42px rgba(49, 46, 129, 0.08); }
        .side-card h3 { margin-bottom: 14px; color: #312e81; font-size: 20px; }
        .side-card p { color: #64748b; font-size: 14px; line-height: 1.7; }
        .community-rule { display: flex; align-items: flex-start; gap: 11px; margin-top: 14px; color: #475569; font-size: 13px; line-height: 1.55; }
        .community-rule span { display: flex; align-items: center; justify-content: center; min-width: 32px; height: 32px; background: #eef2ff; border-radius: 10px; }
        .quick-action { display: block; margin-top: 16px; padding: 12px 14px; color: #4f46e5; font-size: 13px; font-weight: 800; text-align: center; background: #eef2ff; border-radius: 13px; }
        .quick-action:hover { background: #e0e7ff; }
        .admin-link { color: #92400e; background: #fffbeb; }
        .admin-link:hover { background: #fef3c7; }

        /* ---------------------------------
           COMMUNITY FEED & POSTS
        ---------------------------------- */
        .feed-heading { display: flex; align-items: flex-end; justify-content: space-between; gap: 20px; margin: 40px 2px 22px; }
        .feed-heading h2 { color: #111827; font-size: 31px; }
        .feed-heading p { margin-top: 6px; color: #64748b; font-size: 14px; }
        .post-count { padding: 9px 14px; color: #4f46e5; font-size: 13px; font-weight: 800; background: #eef2ff; border-radius: 999px; }
        .posts { display: grid; gap: 24px; }
        .post-card { overflow: hidden; background: rgba(255, 255, 255, 0.95); border: 1px solid rgba(226, 232, 240, 0.9); border-radius: 28px; box-shadow: 0 18px 50px rgba(30, 41, 59, 0.09); transition: 0.22s; }
        .post-card:hover { transform: translateY(-3px); box-shadow: 0 23px 58px rgba(30, 41, 59, 0.13); }
        .post-accent { height: 6px; background: linear-gradient(90deg, #6366f1, #8b5cf6, #38bdf8); }
        .post-accent.serious { background: linear-gradient(90deg, #f59e0b, #fb7185); }
        .post-accent.urgent { background: linear-gradient(90deg, #ef4444, #f97316); }
        .post-accent.advice_needed { background: linear-gradient(90deg, #06b6d4, #6366f1); }
        .post-accent.academic { background: linear-gradient(90deg, #10b981, #3b82f6); }
        .post-main { padding: 29px; }
        .post-top { display: flex; align-items: flex-start; justify-content: space-between; gap: 20px; }
        .author { display: flex; align-items: center; gap: 12px; }
        .author-avatar { display: flex; align-items: center; justify-content: center; width: 47px; height: 47px; color: white; font-size: 20px; font-weight: 900; background: linear-gradient(135deg, #6366f1, #8b5cf6); border-radius: 16px; box-shadow: 0 9px 20px rgba(99, 102, 241, 0.2); }
        .author-name { color: #1e293b; font-size: 15px; font-weight: 800; }
        .post-time { margin-top: 4px; color: #94a3b8; font-size: 12px; }
        .post-badges { display: flex; justify-content: flex-end; gap: 8px; flex-wrap: wrap; }
        .badge { padding: 7px 10px; font-size: 11px; font-weight: 800; border-radius: 999px; }
        .category-badge { color: #4338ca; background: #eef2ff; }
        .flag-general { color: #0369a1; background: #e0f2fe; }
        .flag-serious { color: #92400e; background: #fef3c7; }
        .flag-urgent { color: #b91c1c; background: #fee2e2; }
        .flag-advice_needed { color: #6d28d9; background: #f3e8ff; }
        .flag-academic { color: #047857; background: #d1fae5; }
        .post-title { margin: 23px 0 12px; color: #111827; font-size: 26px; line-height: 1.3; }
        .post-body { color: #475569; font-size: 16px; line-height: 1.8; overflow-wrap: anywhere; }

        /* ---------------------------------
           VOTING & ACTIONS
        ---------------------------------- */
        .post-actions { display: flex; align-items: center; justify-content: space-between; gap: 16px; flex-wrap: wrap; margin-top: 24px; padding-top: 19px; border-top: 1px solid #edf0f6; }
        .vote-group { display: inline-flex; align-items: center; gap: 7px; padding: 5px; background: #f4f6fb; border-radius: 14px; }
        .vote-button { display: flex; align-items: center; justify-content: center; width: 37px; height: 37px; color: #64748b; font-size: 16px; cursor: pointer; background: white; border: 1px solid #e2e8f0; border-radius: 11px; transition: 0.18s; }
        .vote-button:hover { color: #4f46e5; transform: translateY(-2px); border-color: #a5b4fc; background: #eef2ff; }
        .vote-score { min-width: 32px; color: #312e81; font-size: 14px; font-weight: 900; text-align: center; }
        .conversation-count { color: #64748b; font-size: 13px; font-weight: 700; }
        .delete-button { padding: 8px 11px; color: #dc2626; font-size: 12px; font-weight: 800; cursor: pointer; background: #fff1f2; border: none; border-radius: 10px; }
        .delete-button:hover { background: #ffe4e6; }

        /* ---------------------------------
           REPLIES
        ---------------------------------- */
        .conversation-area { padding: 25px 29px 30px; background: linear-gradient(180deg, #f8faff 0%, #fbfcff 100%); border-top: 1px solid #e9edf5; }
        .conversation-heading { display: flex; align-items: center; gap: 9px; margin-bottom: 17px; color: #334155; font-size: 15px; font-weight: 900; }
        .replies-list { display: grid; gap: 13px; margin-bottom: 20px; }
        .reply { display: grid; grid-template-columns: 40px minmax(0, 1fr); gap: 11px; }
        .reply-avatar { display: flex; align-items: center; justify-content: center; width: 40px; height: 40px; color: #4f46e5; font-size: 16px; font-weight: 900; background: #e0e7ff; border-radius: 13px; }
        .reply-content { position: relative; padding: 15px 16px; background: white; border: 1px solid #e5eaf3; border-radius: 5px 17px 17px 17px; }
        .reply-content::before { content: ""; position: absolute; top: 0; left: -7px; width: 14px; height: 14px; background: white; border-left: 1px solid #e5eaf3; border-top: 1px solid #e5eaf3; transform: skewX(45deg); }
        .sirius-reply .reply-avatar { color: #92400e; background: #fef3c7; }
        .sirius-reply .reply-content { background: linear-gradient(135deg, #fffbeb, #fffdf5); border-color: #fde68a; }
        .sirius-reply .reply-content::before { background: #fffbeb; border-color: #fde68a; }
        .reply-top { display: flex; align-items: center; justify-content: space-between; gap: 15px; margin-bottom: 8px; }
        .reply-author { color: #334155; font-size: 13px; font-weight: 900; }
        .sirius-label { display: inline-block; margin-left: 7px; padding: 4px 7px; color: #92400e; font-size: 9px; font-weight: 900; background: #fef3c7; border-radius: 999px; }
        .reply-time { color: #94a3b8; font-size: 11px; }
        .reply-text { color: #475569; font-size: 14px; line-height: 1.7; overflow-wrap: anywhere; }
        .reply-actions { display: flex; align-items: center; gap: 8px; flex-wrap: wrap; margin-top: 12px; }
        .reply-vote { display: inline-flex; align-items: center; gap: 5px; padding: 4px; background: #f8fafc; border-radius: 10px; }
        .reply-vote .vote-button { width: 29px; height: 29px; font-size: 12px; border-radius: 8px; }
        .reply-vote .vote-score { min-width: 24px; font-size: 12px; }

        /* ---------------------------------
           REPLY COMPOSER
        ---------------------------------- */
        .reply-composer { padding: 18px; background: white; border: 1px solid #dfe6f2; border-radius: 19px; box-shadow: 0 8px 23px rgba(30, 41, 59, 0.05); }
        .reply-composer-title { display: flex; align-items: center; gap: 8px; margin-bottom: 12px; color: #312e81; font-size: 14px; font-weight: 900; }
        .reply-row { display: grid; grid-template-columns: minmax(0, 1fr) 135px; gap: 10px; }
        .reply-textarea { width: 100%; min-height: 83px; padding: 13px 14px; color: #334155; line-height: 1.55; outline: none; resize: vertical; background: #f8faff; border: 1px solid #dce4f1; border-radius: 13px; }
        .reply-textarea:focus { background: white; border-color: #818cf8; box-shadow: 0 0 0 4px rgba(129, 140, 248, 0.11); }
        .reply-side { display: flex; flex-direction: column; gap: 9px; }
        .reply-name { width: 100%; padding: 11px; outline: none; background: #f8faff; border: 1px solid #dce4f1; border-radius: 11px; }
        .reply-submit { flex: 1; min-height: 44px; padding: 10px 12px; color: white; font-size: 13px; font-weight: 900; cursor: pointer; background: linear-gradient(135deg, #6366f1, #7c3aed); border: none; border-radius: 11px; }
        .reply-submit:hover { filter: brightness(1.06); }

        /* ---------------------------------
           EMPTY STATE
        ---------------------------------- */
        .empty-state { padding: 65px 30px; text-align: center; background: rgba(255, 255, 255, 0.92); border: 1px solid #e2e8f0; border-radius: 28px; box-shadow: 0 18px 45px rgba(30, 41, 59, 0.08); }
        .empty-star { margin-bottom: 17px; color: #fbbf24; font-size: 70px; text-shadow: 0 0 24px rgba(251, 191, 36, 0.35); }
        .empty-state h3 { margin-bottom: 9px; color: #312e81; font-size: 25px; }
        .empty-state p { color: #64748b; line-height: 1.7; }

        /* ---------------------------------
           FLOATING BUTTON & UTILS
        ---------------------------------- */
        #floating-create-post {
            position: fixed !important; left: 24px !important; bottom: 24px !important; z-index: 99999 !important;
            display: flex !important; align-items: center; gap: 9px; padding: 12px 20px; color: white !important; font-size: 14px; font-weight: 800; text-decoration: none !important;
            background: linear-gradient(135deg, #6366f1, #7c3aed) !important; border: 1px solid rgba(255, 255, 255, 0.35); border-radius: 999px;
            box-shadow: 0 12px 30px rgba(79, 70, 229, 0.4); transition: transform 0.2s ease, box-shadow 0.2s ease;
        }
        #floating-create-post:hover { color: white !important; transform: translateY(-4px); box-shadow: 0 17px 38px rgba(79, 70, 229, 0.52); }
        .floating-create-icon { display: flex; align-items: center; justify-content: center; width: 29px; height: 29px; background: rgba(255, 255, 255, 0.18); border-radius: 50%; }
        #create-post { scroll-margin-top: 105px; }

        /* ---------------------------------
           ANIMATIONS & RESPONSIVE
        ---------------------------------- */
        @keyframes starPulse { 0%, 100% { opacity: 0.92; transform: scale(1); } 50% { opacity: 1; transform: scale(1.08); } }
        @keyframes orbit { from { transform: rotate(0deg); } to { transform: rotate(360deg); } }

        @media (max-width: 1100px) {
            .navbar { position: relative; flex-direction: column; gap: 13px; }
            .nav-links { justify-content: center; }
            .hero-inner { grid-template-columns: 1fr; }
            .hero-star-area { display: none; }
            .top-grid { grid-template-columns: 1fr; }
            .side-column { display: grid; grid-template-columns: 1fr 1fr; }
            .level-grid { grid-template-columns: repeat(3, 1fr); }
        }

        @media (max-width: 760px) {
            .support-hero { padding: 55px 6% 105px; }
            .page { padding: 0 4%; }
            .composer, .post-main, .conversation-area { padding: 22px; }
            .composer-subtitle { margin-left: 0; margin-top: 12px; }
            .two-columns { grid-template-columns: 1fr; }
            .level-grid { grid-template-columns: repeat(2, 1fr); }
            .side-column { grid-template-columns: 1fr; }
            .post-top { flex-direction: column; }
            .post-badges { justify-content: flex-start; }
            .reply-row { grid-template-columns: 1fr; }
            .feed-heading { align-items: flex-start; flex-direction: column; }
        }

        @media (max-width: 700px) {
            #floating-create-post { left: 14px !important; bottom: 82px !important; padding: 11px 15px; }
        }
    </style>
</head>

<body>

<header class="navbar">
    <a href="/" class="brand">
        <img src="{{ asset('images/siriuslogo.png') }}" alt="Sirius logo">
        <span>Sirius</span>
    </a>
    <nav class="nav-links">
        <a href="/">Home</a>
        <a href="{{ route('dashboard') }}">Dashboard</a>
        <a href="{{ route('mood.index') }}">Mood</a>
        <a href="{{ route('journal') }}">Journal</a>
        <a href="{{ route('goals') }}">Goals</a>
        <a href="{{ route('resources') }}">Resources</a>
        <a href="{{ route('support.index') }}" class="active">Support</a>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="logout-button">Logout</button>
        </form>
    </nav>
</header>

<section class="support-hero">
    <div class="hero-inner">
        <div class="hero-copy">
            <div class="hero-badge">✦ Sirius Student Community</div>
            <h1>Share what is on your mind. <span>You do not have to handle everything alone.</span></h1>
            <p>Create a post, receive support from other students, and share helpful encouragement in a respectful community.</p>
            <div class="hero-reminders">
                <div class="hero-reminder">💜 Be kind</div>
                <div class="hero-reminder">🛡️ AI moderated</div>
                <div class="hero-reminder">✨ Anonymous names supported</div>
            </div>
        </div>
        <div class="hero-star-area">
            <div class="hero-orbit"></div>
            <div class="hero-star">✦</div>
        </div>
    </div>
</section>

<main class="page">

    {{-- SUCCESS MESSAGE --}}
    @if(session('success'))
        <div class="flash flash-success">
            <span>✨</span>
            <div>{{ session('success') }}</div>
        </div>
    @endif

    {{-- WARNING MESSAGE --}}
    @if(session('warning'))
        <div class="flash flash-warning">
            <span>⭐</span>
            <div>{{ session('warning') }}</div>
        </div>
    @endif

    {{-- VALIDATION ERRORS --}}
    @if($errors->any())
        <div class="flash flash-error">
            <span>⚠️</span>
            <div>
                <strong>Please check these fields:</strong>
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    @endif

    <section class="top-grid">

        {{-- CREATE POST --}}
        <div class="composer" id="create-post">
            <div class="composer-heading">
                <div class="composer-icon">✍️</div>
                <div>
                    <h2>Start a conversation</h2>
                </div>
            </div>
            <p class="composer-subtitle">Tell the community what is happening. Your post can be supportive, honest, and anonymous.</p>

            <form method="POST" action="{{ route('support.posts.store') }}">
                @csrf
                <div class="form-group">
                    <label for="title" class="form-label">Give your post a short title</label>
                    <input id="title" class="field" type="text" name="title" value="{{ old('title') }}" maxlength="150" placeholder="Example: How do you stay focused during a busy week?" required>
                    <div class="field-footer">
                        <span>Make it clear and easy to understand.</span>
                        <span id="title-count">0 / 150</span>
                    </div>
                </div>

                <div class="form-group">
                    <label for="body" class="form-label">What would you like to share?</label>
                    <textarea id="body" class="field" name="body" maxlength="2000" placeholder="Write what is on your mind. You can explain what happened, how you feel, or what kind of support would help..." required>{{ old('body') }}</textarea>
                    <div class="field-footer">
                        <span>Your experience matters.</span>
                        <span id="body-count">0 / 2000</span>
                    </div>
                </div>

                <div class="two-columns">
                    <div class="form-group">
                        <label for="category" class="form-label">Choose a topic</label>
                        <select id="category" class="field" name="category">
                            <option value="General Support">💬 General Support</option>
                            <option value="Academic Stress">📚 Academic Stress</option>
                            <option value="Making Friends">🤝 Making Friends</option>
                            <option value="Work-Life Balance">⚖️ Work-Life Balance</option>
                            <option value="Motivation">✨ Motivation</option>
                            <option value="Student Life">🎓 Student Life</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="anonymous_name" class="form-label">Display name</label>
                        <input id="anonymous_name" class="field" type="text" name="anonymous_name" value="{{ old('anonymous_name') }}" maxlength="100" placeholder="Anonymous Student">
                    </div>
                </div>

                <p class="level-title">What type of support fits this post?</p>

                <div class="level-grid">
                    <label class="level-option">
                        <input type="radio" name="flag" value="general" checked>
                        <span class="level-card"><span>💬</span> General</span>
                    </label>
                    <label class="level-option">
                        <input type="radio" name="flag" value="academic">
                        <span class="level-card"><span>📚</span> Academic</span>
                    </label>
                    <label class="level-option">
                        <input type="radio" name="flag" value="advice_needed">
                        <span class="level-card"><span>💡</span> Need advice</span>
                    </label>
                    <label class="level-option">
                        <input type="radio" name="flag" value="serious">
                        <span class="level-card"><span>🧡</span> Serious</span>
                    </label>
                    <label class="level-option">
                        <input type="radio" name="flag" value="urgent">
                        <span class="level-card"><span>⭐</span> Need support soon</span>
                    </label>
                </div>

                <button type="submit" class="submit-post">✦ Share with the community</button>

                <p class="moderation-note">
                    <span>🛡️</span>
                    <span>Sirius checks posts with AI moderation to help keep the community respectful and supportive.</span>
                </p>
            </form>
        </div>

        {{-- SIDE INFORMATION --}}
        <aside class="side-column">
            <div class="side-card">
                <h3>🌟 A kinder community</h3>
                <p>Helpful replies do not need to be perfect. Listening and responding kindly can make a difference.</p>
                <div class="community-rule">
                    <span>💜</span>
                    <div>Support the person instead of judging them.</div>
                </div>
                <div class="community-rule">
                    <span>🌱</span>
                    <div>Share ideas gently without making assumptions.</div>
                </div>
                <div class="community-rule">
                    <span>🛡️</span>
                    <div>Harmful or unsafe advice may be blocked or reviewed.</div>
                </div>
            </div>

            <div class="side-card">
                <h3>💙 Looking for resources?</h3>
                <p>Sirius also provides student support contacts, useful resources, and campus support information.</p>
                <a href="{{ route('resources') }}" class="quick-action">Open Support Resources →</a>

                @php
                    $adminEmails = collect(config('services.admin.emails', []))->map(fn ($email) => strtolower(trim($email)))->toArray();
                    $currentEmail = strtolower(auth()->user()->email ?? '');
                    $isAdmin = in_array($currentEmail, $adminEmails, true);
                @endphp

                @if($isAdmin)
                    <a href="{{ route('support.review') }}" class="quick-action admin-link">Open Moderation Queue →</a>
                @endif
            </div>
        </aside>
    </section>

    {{-- COMMUNITY FEED --}}
    <section>
        <div class="feed-heading">
            <div>
                <h2>Community conversations</h2>
                <p>Read student experiences and add a supportive reply.</p>
            </div>
            <div class="post-count">{{ $posts->count() }} {{ $posts->count() === 1 ? 'conversation' : 'conversations' }}</div>
        </div>

        <div class="posts">
            @forelse($posts as $post)
                <article class="post-card">
                    <div class="post-accent {{ $post->flag }}"></div>
                    <div class="post-main">
                        <div class="post-top">
                            <div class="author">
                                <div class="author-avatar">{{ strtoupper(substr($post->anonymous_name ?? 'A', 0, 1)) }}</div>
                                <div>
                                    <div class="author-name">{{ $post->anonymous_name }}</div>
                                    <div class="post-time">{{ $post->created_at->diffForHumans() }}</div>
                                </div>
                            </div>
                            <div class="post-badges">
                                <span class="badge category-badge">{{ $post->category ?? 'General Support' }}</span>
                                <span class="badge flag-{{ $post->flag }}">
                                    @switch($post->flag)
                                        @case('serious') 🧡 Serious @break
                                        @case('urgent') ⭐ Support soon @break
                                        @case('advice_needed') 💡 Advice wanted @break
                                        @case('academic') 📚 Academic @break
                                        @default 💬 General
                                    @endswitch
                                </span>
                            </div>
                        </div>

                        <h3 class="post-title">{{ $post->title }}</h3>
                        <div class="post-body">{!! nl2br(e($post->body)) !!}</div>

                        <div class="post-actions">
                            <div class="vote-group">
                                <button type="button" class="vote-button ajax-vote" data-url="{{ route('support.posts.upvote', $post) }}" data-score-target="post-score-{{ $post->id }}" title="Upvote">▲</button>
                                <span class="vote-score" id="post-score-{{ $post->id }}">{{ $post->vote_score ?? 0 }}</span>
                                <button type="button" class="vote-button ajax-vote" data-url="{{ route('support.posts.downvote', $post) }}" data-score-target="post-score-{{ $post->id }}" title="Downvote">▼</button>
                            </div>
                            <div class="conversation-count">💬 {{ $post->replies->count() }} {{ $post->replies->count() === 1 ? 'reply' : 'replies' }}</div>
                            @if($post->user_id === auth()->id())
                                <form method="POST" action="{{ route('support.posts.destroy', $post) }}" onsubmit="return confirm('Delete this post and its replies?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="delete-button">Delete my post</button>
                                </form>
                            @endif
                        </div>
                    </div>

                    {{-- REPLIES --}}
                    <div class="conversation-area">
                        <div class="conversation-heading"><span>💬</span> Community replies</div>
                        <div class="replies-list">
                            @forelse($post->replies as $reply)
                                <div class="reply {{ $reply->anonymous_name === 'Sirius Support' ? 'sirius-reply' : '' }}">
                                    <div class="reply-avatar">
                                        @if($reply->anonymous_name === 'Sirius Support')
                                            ✦
                                        @else
                                            {{ strtoupper(substr($reply->anonymous_name ?? 'A', 0, 1)) }}
                                        @endif
                                    </div>
                                    <div class="reply-content">
                                        <div class="reply-top">
                                            <div>
                                                <span class="reply-author">{{ $reply->anonymous_name }}</span>
                                                @if($reply->anonymous_name === 'Sirius Support')
                                                    <span class="sirius-label">SIRIUS</span>
                                                @endif
                                            </div>
                                            <span class="reply-time">{{ $reply->created_at->diffForHumans() }}</span>
                                        </div>
                                        <div class="reply-text">{!! nl2br(e($reply->reply)) !!}</div>

                                        @if($reply->anonymous_name !== 'Sirius Support')
                                            <div class="reply-actions">
                                                <div class="reply-vote">
                                                    <button type="button" class="vote-button ajax-vote" data-url="{{ route('support.replies.upvote', $reply) }}" data-score-target="reply-score-{{ $reply->id }}">▲</button>
                                                    <span class="vote-score" id="reply-score-{{ $reply->id }}">{{ $reply->vote_score ?? 0 }}</span>
                                                    <button type="button" class="vote-button ajax-vote" data-url="{{ route('support.replies.downvote', $reply) }}" data-score-target="reply-score-{{ $reply->id }}">▼</button>
                                                </div>
                                                @if($reply->user_id === auth()->id())
                                                    <form method="POST" action="{{ route('support.replies.destroy', $reply) }}" onsubmit="return confirm('Delete your reply?');">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="delete-button">Delete</button>
                                                    </form>
                                                @endif
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            @empty
                                <div style="color: #94a3b8; font-size: 13px; padding: 5px 0 10px;">
                                    No student replies yet. You can be the first to leave encouragement. ✨
                                </div>
                            @endforelse
                        </div>

                        {{-- ADD REPLY --}}
                        <form class="reply-composer" method="POST" action="{{ route('support.replies.store', $post) }}">
                            @csrf
                            <div class="reply-composer-title">✨ Add a supportive reply</div>
                            <div class="reply-row">
                                <textarea class="reply-textarea reply-input" name="reply" maxlength="1500" placeholder="Write something kind, supportive, or helpful..." required></textarea>
                                <div class="reply-side">
                                    <input class="reply-name" type="text" name="anonymous_name" maxlength="100" placeholder="Display name">
                                    <button type="submit" class="reply-submit">Send reply ✦</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </article>
            @empty
                <div class="empty-state">
                    <div class="empty-star">✦</div>
                    <h3>Be the first light in the community</h3>
                    <p>No posts are visible yet. Start a conversation above and create a welcoming space for other students.</p>
                </div>
            @endforelse
        </div>
    </section>
</main>

<a href="#create-post" id="floating-create-post">
    <span class="floating-create-icon">✍️</span>
    <span>Create Post</span>
</a>

@include('partials.helpline-widget')

<script>
    /* ---------------------------------
       Character Counters
    ---------------------------------- */
    const titleInput = document.getElementById('title');
    const titleCount = document.getElementById('title-count');
    const bodyInput = document.getElementById('body');
    const bodyCount = document.getElementById('body-count');

    function updateCounter(input, output, limit) {
        if (!input || !output) return;
        output.textContent = `${input.value.length} / ${limit}`;
    }

    updateCounter(titleInput, titleCount, 150);
    updateCounter(bodyInput, bodyCount, 2000);

    titleInput?.addEventListener('input', () => updateCounter(titleInput, titleCount, 150));
    bodyInput?.addEventListener('input', () => updateCounter(bodyInput, bodyCount, 2000));

    /* ---------------------------------
       Auto-grow Reply Textareas
    ---------------------------------- */
    document.querySelectorAll('.reply-input').forEach(textarea => {
        textarea.addEventListener('input', function () {
            this.style.height = 'auto';
            this.style.height = Math.min(this.scrollHeight, 190) + 'px';
        });
    });

    /* ---------------------------------
       AJAX Voting
    ---------------------------------- */
    document.querySelectorAll('.ajax-vote').forEach(button => {
        button.addEventListener('click', async function () {
            const url = this.dataset.url;
            const scoreTarget = this.dataset.scoreTarget;
            const scoreElement = document.getElementById(scoreTarget);

            this.disabled = true;

            try {
                const response = await fetch(url, {
                    method: 'GET',
                    headers: {
                        'Accept': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                });

                const result = await response.json();

                if (result.score !== undefined && scoreElement) {
                    scoreElement.textContent = result.score;
                }

                if (!response.ok && result.message) {
                    alert(result.message);
                }

            } catch (error) {
                console.error('Vote failed:', error);
                alert('The vote could not be saved. Please try again.');
            } finally {
                this.disabled = false;
            }
        });
    });
</script>

</body>
</html>