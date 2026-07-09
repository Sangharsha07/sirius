<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Support Board | Sirius</title>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, Helvetica, sans-serif;
        }

        body {
            background: #f4f7fb;
            color: #1f2937;
        }

        .navbar {
            background: white;
            padding: 20px 8%;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 2px 12px rgba(0,0,0,0.06);
            position: sticky;
            top: 0;
            z-index: 1000;
        }

        .logo {
            font-size: 28px;
            font-weight: bold;
            color: #2563eb;
            text-decoration: none;
        }

        .nav {
            display: flex;
            align-items: center;
            gap: 20px;
            flex-wrap: wrap;
        }

        .nav a {
            text-decoration: none;
            color: #374151;
            font-weight: 600;
        }

        .nav a:hover,
        .nav a.active {
            color: #2563eb;
        }

        .logout-btn {
            background: transparent;
            color: #374151;
            border: none;
            cursor: pointer;
            font-weight: 600;
            font-size: 16px;
        }

        .logout-btn:hover {
            color: #ef4444;
        }

        .page {
            padding: 45px 8%;
        }

        .page-header {
            background: #ffffff;
            border-radius: 28px;
            padding: 34px;
            margin-bottom: 32px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.05);
        }

        .page-header h1 {
            font-size: 42px;
            color: #111827;
            margin-bottom: 12px;
        }

        .page-header p {
            color: #4b5563;
            font-size: 18px;
            line-height: 1.8;
            max-width: 900px;
        }

        .safe-note {
            margin-top: 18px;
            background: #eef6ff;
            border-left: 5px solid #2563eb;
            padding: 16px 18px;
            border-radius: 16px;
            color: #374151;
            font-size: 16px;
            line-height: 1.7;
        }

        .layout {
            display: grid;
            grid-template-columns: 380px 1fr;
            gap: 28px;
            align-items: start;
        }

        .card,
        .post-card {
            background: #ffffff;
            padding: 28px;
            border-radius: 24px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.055);
            margin-bottom: 26px;
        }

        .card h2 {
            font-size: 26px;
            margin-bottom: 12px;
            color: #111827;
        }

        .card p {
            color: #4b5563;
            line-height: 1.7;
            font-size: 16px;
        }

        label {
            display: block;
            font-weight: bold;
            margin-top: 18px;
            margin-bottom: 8px;
            color: #374151;
            font-size: 16px;
        }

        input,
        select,
        textarea {
            width: 100%;
            padding: 15px 16px;
            border: 1px solid #d1d5db;
            border-radius: 15px;
            font-size: 16px;
            background: #ffffff;
            color: #111827;
        }

        textarea {
            min-height: 140px;
            resize: vertical;
            line-height: 1.7;
        }

        input:focus,
        select:focus,
        textarea:focus {
            outline: none;
            border-color: #2563eb;
            box-shadow: 0 0 0 3px rgba(37,99,235,0.12);
        }

        button {
            margin-top: 18px;
            background: #2563eb;
            color: white;
            border: none;
            padding: 14px 24px;
            border-radius: 13px;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
        }

        button:hover {
            background: #1d4ed8;
        }

        .delete-btn {
            background: #ef4444;
            margin-top: 0;
        }

        .delete-btn:hover {
            background: #dc2626;
        }

        .success-box {
            background: #dcfce7;
            color: #166534;
            padding: 17px 20px;
            border-radius: 16px;
            margin-bottom: 22px;
            font-size: 16px;
            line-height: 1.6;
        }

        .warning-box {
            background: #fef3c7;
            color: #92400e;
            padding: 17px 20px;
            border-radius: 16px;
            margin-bottom: 22px;
            font-size: 16px;
            line-height: 1.6;
        }

        .error-box {
            background: #fee2e2;
            color: #991b1b;
            padding: 17px 20px;
            border-radius: 16px;
            margin-bottom: 22px;
            font-size: 16px;
            line-height: 1.6;
        }

        .post-top {
            display: flex;
            justify-content: space-between;
            gap: 20px;
            align-items: flex-start;
            margin-bottom: 16px;
        }

        .badge-row {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
            margin-bottom: 14px;
        }

        .category-pill,
        .flag-pill {
            display: inline-block;
            padding: 8px 14px;
            border-radius: 999px;
            font-weight: bold;
            font-size: 14px;
        }

        .category-pill {
            background: #eff6ff;
            color: #2563eb;
        }

        .flag-general {
            background: #e5e7eb;
            color: #374151;
        }

        .flag-serious {
            background: #fef3c7;
            color: #92400e;
        }

        .flag-urgent {
            background: #fee2e2;
            color: #991b1b;
        }

        .flag-advice_needed {
            background: #dbeafe;
            color: #1d4ed8;
        }

        .flag-academic {
            background: #dcfce7;
            color: #166534;
        }

        .post-title {
            font-size: 34px;
            color: #111827;
            margin-bottom: 10px;
            line-height: 1.25;
        }

        .meta {
            color: #6b7280;
            font-size: 15px;
            margin-bottom: 16px;
        }

        .post-body {
            font-size: 18px;
            color: #374151;
            line-height: 1.85;
            margin-top: 10px;
            margin-bottom: 24px;
        }

        .vote-box {
            display: flex;
            align-items: center;
            gap: 11px;
            margin-top: 12px;
            margin-bottom: 12px;
        }

        .vote-btn {
            background: #eef2ff;
            color: #374151;
            border: none;
            width: 40px;
            height: 40px;
            border-radius: 12px;
            cursor: pointer;
            margin-top: 0;
            font-size: 18px;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
        }

        .vote-btn:hover {
            background: #dbeafe;
            color: #2563eb;
        }

        .score {
            color: #111827;
            font-weight: bold;
            min-width: 28px;
            text-align: center;
            font-size: 18px;
        }

        .reply-form {
            margin-top: 24px;
            padding-top: 24px;
            border-top: 1px solid #e5e7eb;
        }

        .reply-form h3 {
            font-size: 24px;
            color: #111827;
            margin-bottom: 8px;
        }

        .reply-section-title {
            font-size: 26px;
            margin-top: 28px;
            margin-bottom: 16px;
            color: #111827;
        }

        .reply-box {
            background: #f8fafc;
            border: 1px solid #e5e7eb;
            padding: 22px;
            border-radius: 20px;
            margin-top: 18px;
        }

        .reply-box.sirius-reply {
            background: #eff6ff;
            border: 1px solid #bfdbfe;
        }

        .reply-header {
            display: flex;
            justify-content: space-between;
            gap: 16px;
            align-items: flex-start;
        }

        .reply-author {
            color: #2563eb;
            font-size: 22px;
            font-weight: bold;
            margin-bottom: 12px;
        }

        .reply-text {
            font-size: 17px;
            line-height: 1.9;
            color: #374151;
            margin-bottom: 14px;
            max-width: 900px;
        }

        .sirius-label {
            display: inline-block;
            background: #2563eb;
            color: white;
            font-size: 12px;
            padding: 5px 9px;
            border-radius: 999px;
            margin-left: 8px;
            vertical-align: middle;
        }

        .empty-text {
            color: #6b7280;
            font-size: 16px;
            line-height: 1.7;
            margin-top: 12px;
        }

        .moderation-info {
            background: #eef6ff;
            border-left: 5px solid #2563eb;
            padding: 18px;
            border-radius: 16px;
            line-height: 1.75;
            font-size: 16px;
        }

        .moderation-info strong {
            color: #111827;
        }

        footer {
            background: #111827;
            color: white;
            text-align: center;
            padding: 24px;
            margin-top: 42px;
        }

        @media (max-width: 1050px) {
            .layout {
                grid-template-columns: 1fr;
            }

            .post-title {
                font-size: 30px;
            }
        }

        @media (max-width: 700px) {
            .navbar {
                flex-direction: column;
                gap: 14px;
            }

            .nav {
                justify-content: center;
                gap: 14px;
            }

            .page {
                padding: 28px 5%;
            }

            .page-header h1 {
                font-size: 32px;
            }

            .page-header p {
                font-size: 16px;
            }

            .post-top,
            .reply-header {
                flex-direction: column;
            }

            .post-title {
                font-size: 27px;
            }

            .post-body,
            .reply-text {
                font-size: 16px;
            }
        }
    </style>
    <link rel="icon" type="image/png" href="{{ asset('images/favicon.png') }}">
    <link rel="apple-touch-icon" href="{{ asset('images/favicon.png') }}">
</head>

<body>

<header class="navbar">
    <a href="/" class="logo">Sirius</a>

    <nav class="nav">
        <a href="/">Home</a>
        <a href="{{ route('dashboard') }}">Dashboard</a>
        <a href="{{ route('mood.index') }}">Mood</a>
        <a href="/journal">Journal</a>
        <a href="/goals">Goals</a>
        <a href="/resources">Resources</a>
        <a href="{{ route('support.index') }}" class="active">Support</a>

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="logout-btn">
                Logout
            </button>
        </form>
    </nav>
</header>

<section class="page">

    <div class="page-header">
        <h1>Anonymous Support Board</h1>

        <p>
            Share what you are going through anonymously and receive supportive advice from other students.
            Sirius keeps the page simple, calm, and easy to read so students can use it even when stressed.
        </p>

        <div class="safe-note">
            Sirius is not a medical or counseling service. It helps students notice when they may need support
            and shows trusted contact options.
        </div>
    </div>

    @if(session('success'))
        <div class="success-box">
            {{ session('success') }}
        </div>
    @endif

    @if(session('warning'))
        <div class="warning-box">
            {{ session('warning') }}
        </div>
    @endif

    @if($errors->any())
        <div class="error-box">
            <strong>Please fix these errors:</strong>
            <ul style="margin-left: 22px; margin-top: 8px;">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="layout">

        <aside>
            <div class="card">
                <h2>Create Support Post</h2>
                <p>
                    Write a short post and choose a flag. You can stay anonymous.
                </p>

                <form method="POST" action="{{ route('support.posts.store') }}">
                    @csrf

                    <label>Anonymous Name</label>
                    <input type="text" name="anonymous_name" placeholder="Anonymous Student">

                    <label>Category</label>
                    <select name="category">
                        <option>Academic Stress</option>
                        <option>Exam Pressure</option>
                        <option>Sleep Routine</option>
                        <option>Social Life</option>
                        <option>General Support</option>
                    </select>

                    <label>Post Flag</label>
                    <select name="flag">
                        <option value="general">General</option>
                        <option value="serious">Serious</option>
                        <option value="urgent">Urgent</option>
                        <option value="advice_needed">Advice Needed</option>
                        <option value="academic">Academic</option>
                    </select>

                    <label>Title</label>
                    <input type="text" name="title" placeholder="Example: Feeling stressed before exams" required>

                    <label>What do you want support with?</label>
                    <textarea name="body" placeholder="Write your post here..." required></textarea>

                    <button type="submit">
                        Post Anonymously
                    </button>
                </form>
            </div>

            <div class="card">
                <h2>Moderation Plan</h2>

                <div class="moderation-info">
                    <strong>Current prototype:</strong>
                    <p>
                        Sirius uses keyword filtering to block disrespectful or unsafe advice.
                    </p>

                    <br>

                    <strong>Future upgrade:</strong>
                    <p>
                        AI moderation can help classify replies as approved, blocked, or needs review.
                    </p>
                </div>
            </div>
        </aside>

        <main>
            @forelse($posts as $post)
                @php
                    $postFlag = $post->flag ?? 'general';
                @endphp

                <div class="post-card">
                    <div class="post-top">
                        <div>
                            <div class="badge-row">
                                <span class="category-pill">
                                    {{ $post->category ?? 'General Support' }}
                                </span>

                                <span class="flag-pill flag-{{ $postFlag }}">
                                    @if($postFlag === 'urgent')
                                        Urgent
                                    @elseif($postFlag === 'serious')
                                        Serious
                                    @elseif($postFlag === 'advice_needed')
                                        Advice Needed
                                    @elseif($postFlag === 'academic')
                                        Academic
                                    @else
                                        General
                                    @endif
                                </span>
                            </div>

                            <h2 class="post-title">
                                {{ $post->title }}
                            </h2>

                            <div class="meta">
                                Posted by {{ $post->anonymous_name }} |
                                {{ $post->created_at->diffForHumans() }}
                            </div>

                            <div class="vote-box">
                                <a href="{{ route('support.posts.upvote', $post) }}"
                                   class="vote-btn ajax-vote"
                                   data-score-id="post-score-{{ $post->id }}">
                                    ↑
                                </a>

                                <span class="score" id="post-score-{{ $post->id }}">
                                    {{ $post->vote_score ?? 0 }}
                                </span>

                                <a href="{{ route('support.posts.downvote', $post) }}"
                                   class="vote-btn ajax-vote"
                                   data-score-id="post-score-{{ $post->id }}">
                                    ↓
                                </a>
                            </div>
                        </div>

                        @if($post->user_id === auth()->id())
                            <form method="POST" action="{{ route('support.posts.destroy', $post) }}">
                                @csrf
                                @method('DELETE')

                                <button type="submit" class="delete-btn">
                                    Delete
                                </button>
                            </form>
                        @endif
                    </div>

                    <div class="post-body">
                        {!! nl2br(e($post->body)) !!}
                    </div>

                    <div class="reply-form">
                        <h3>Give Supportive Advice</h3>

                        <form method="POST" action="{{ route('support.replies.store', $post) }}">
                            @csrf

                            <label>Anonymous Name</label>
                            <input type="text" name="anonymous_name" placeholder="Anonymous Student">

                            <label>Your Advice</label>
                            <textarea name="reply" placeholder="Write supportive and safe advice..." required></textarea>

                            <button type="submit">
                                Submit Advice
                            </button>
                        </form>
                    </div>

                    <div>
                        <h3 class="reply-section-title">Approved Advice</h3>

                        @forelse($post->replies as $reply)
                            <div class="reply-box {{ $reply->anonymous_name === 'Sirius Support' ? 'sirius-reply' : '' }}">
                                <div class="reply-header">
                                    <div>
                                        <div class="reply-author">
                                            {{ $reply->anonymous_name }}

                                            @if($reply->anonymous_name === 'Sirius Support')
                                                <span class="sirius-label">Auto Support</span>
                                            @endif
                                        </div>

                                        <div class="reply-text">
                                            {!! nl2br(e($reply->reply)) !!}
                                        </div>

                                        <div class="meta">
                                            {{ $reply->created_at->diffForHumans() }}
                                        </div>

                                        <div class="vote-box">
                                            <a href="{{ route('support.replies.upvote', $reply) }}"
                                               class="vote-btn ajax-vote"
                                               data-score-id="reply-score-{{ $reply->id }}">
                                                ↑
                                            </a>

                                            <span class="score" id="reply-score-{{ $reply->id }}">
                                                {{ $reply->vote_score ?? 0 }}
                                            </span>

                                            <a href="{{ route('support.replies.downvote', $reply) }}"
                                               class="vote-btn ajax-vote"
                                               data-score-id="reply-score-{{ $reply->id }}">
                                                ↓
                                            </a>
                                        </div>
                                    </div>

                                    @if($reply->user_id === auth()->id())
                                        <form method="POST" action="{{ route('support.replies.destroy', $reply) }}">
                                            @csrf
                                            @method('DELETE')

                                            <button type="submit" class="delete-btn">
                                                Delete
                                            </button>
                                        </form>
                                    @endif
                                </div>
                            </div>
                        @empty
                            <p class="empty-text">
                                No approved advice yet.
                            </p>
                        @endforelse
                    </div>
                </div>
            @empty
                <div class="card">
                    <h2>No support posts yet</h2>
                    <p>Create the first anonymous support post.</p>
                </div>
            @endforelse
        </main>

    </div>
</section>

<footer>
    <p>© 2026 Sirius. Student Mental Wellness Platform.</p>
</footer>

@include('partials.helpline-widget')

<script>
    document.addEventListener("DOMContentLoaded", function () {
        const voteButtons = document.querySelectorAll(".ajax-vote");

        voteButtons.forEach(function (button) {
            button.addEventListener("click", function (event) {
                event.preventDefault();

                const url = button.getAttribute("href");
                const scoreId = button.getAttribute("data-score-id");
                const scoreElement = document.getElementById(scoreId);

                fetch(url, {
                    method: "GET",
                    headers: {
                        "Accept": "application/json",
                        "X-Requested-With": "XMLHttpRequest"
                    }
                })
                .then(function (response) {
                    return response.json();
                })
                .then(function (data) {
                    if (data.success) {
                        scoreElement.textContent = data.score;
                    } else {
                        alert(data.message);
                    }
                })
                .catch(function () {
                    alert("Vote failed. Please try again.");
                });
            });
        });
    });
</script>

</body>
</html>