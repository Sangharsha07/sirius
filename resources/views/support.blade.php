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
            background: #f5f7fb;
            color: #1f2937;
        }

        .navbar {
            background: white;
            padding: 20px 8%;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 2px 12px rgba(0,0,0,0.08);
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
        }

        .nav a:hover,
        .nav a.active {
            color: #2563eb;
        }

        .logout-btn {
            background: #ef4444;
            color: white;
            border: none;
            padding: 9px 14px;
            border-radius: 10px;
            cursor: pointer;
            font-weight: bold;
            margin-top: 0;
        }

        .logout-btn:hover {
            background: #dc2626;
        }

        .page {
            padding: 50px 8%;
        }

        .page h1 {
            font-size: 42px;
            margin-bottom: 10px;
            color: #111827;
        }

        .page-desc {
            color: #4b5563;
            font-size: 18px;
            line-height: 1.6;
            max-width: 850px;
            margin-bottom: 30px;
        }

        .layout {
            display: grid;
            grid-template-columns: 1fr 2fr;
            gap: 28px;
            align-items: start;
        }

        .card,
        .post-card {
            background: white;
            padding: 28px;
            border-radius: 20px;
            box-shadow: 0 8px 25px rgba(0,0,0,0.07);
            margin-bottom: 25px;
        }

        .card h2 {
            margin-bottom: 15px;
            color: #111827;
        }

        .card p {
            color: #4b5563;
            line-height: 1.6;
        }

        label {
            display: block;
            font-weight: bold;
            margin-top: 16px;
            margin-bottom: 8px;
            color: #374151;
        }

        input,
        select,
        textarea {
            width: 100%;
            padding: 13px;
            border: 1px solid #d1d5db;
            border-radius: 12px;
            font-size: 16px;
        }

        textarea {
            min-height: 130px;
            resize: vertical;
        }

        button {
            margin-top: 18px;
            background: #2563eb;
            color: white;
            border: none;
            padding: 13px 22px;
            border-radius: 10px;
            font-size: 15px;
            font-weight: bold;
            cursor: pointer;
        }

        button:hover {
            background: #1d4ed8;
        }

        .delete-btn {
            background: #ef4444;
        }

        .delete-btn:hover {
            background: #dc2626;
        }

        .success-box {
            background: #dcfce7;
            color: #166534;
            padding: 15px;
            border-radius: 12px;
            margin-bottom: 20px;
        }

        .warning-box {
            background: #fef3c7;
            color: #92400e;
            padding: 15px;
            border-radius: 12px;
            margin-bottom: 20px;
        }

        .error-box {
            background: #fee2e2;
            color: #991b1b;
            padding: 15px;
            border-radius: 12px;
            margin-bottom: 20px;
        }

        .post-top {
            display: flex;
            justify-content: space-between;
            gap: 20px;
            align-items: flex-start;
            margin-bottom: 10px;
        }

        .post-title {
            font-size: 24px;
            color: #111827;
            margin-bottom: 8px;
        }

        .meta {
            color: #6b7280;
            font-size: 14px;
            margin-bottom: 14px;
        }

        .category-pill {
            display: inline-block;
            background: #eff6ff;
            color: #2563eb;
            padding: 7px 12px;
            border-radius: 999px;
            font-weight: bold;
            font-size: 13px;
            margin-right: 8px;
            margin-bottom: 10px;
        }

        .flag-pill {
            display: inline-block;
            padding: 7px 13px;
            border-radius: 999px;
            font-weight: bold;
            font-size: 13px;
            margin-bottom: 10px;
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

        .vote-box {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-top: 12px;
            margin-bottom: 12px;
        }

        .vote-btn {
            background: #f3f4f6;
            color: #374151;
            border: none;
            padding: 7px 10px;
            border-radius: 8px;
            cursor: pointer;
            margin-top: 0;
            font-size: 14px;
            text-decoration: none;
            display: inline-block;
            font-weight: bold;
        }

        .vote-btn:hover {
            background: #dbeafe;
            color: #2563eb;
        }

        .score {
            color: #111827;
            font-weight: bold;
            min-width: 20px;
            text-align: center;
        }

        .reply-box {
            background: #f9fafb;
            padding: 18px;
            border-radius: 15px;
            margin-top: 15px;
        }

        .reply-box strong {
            color: #2563eb;
        }

        .reply-box p {
            margin-top: 7px;
            color: #374151;
        }

        .reply-form {
            margin-top: 18px;
            padding-top: 18px;
            border-top: 1px solid #e5e7eb;
        }

        .moderation-info {
            background: #eff6ff;
            border-left: 5px solid #2563eb;
            padding: 16px;
            border-radius: 12px;
            line-height: 1.6;
        }

        footer {
            background: #111827;
            color: white;
            text-align: center;
            padding: 22px;
            margin-top: 40px;
        }

        @media (max-width: 950px) {
            .layout {
                grid-template-columns: 1fr;
            }

            .navbar {
                flex-direction: column;
                gap: 14px;
            }

            .nav {
                justify-content: center;
            }

            .post-top {
                flex-direction: column;
            }
        }
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
    <h1>Anonymous Support Board</h1>

    <p class="page-desc">
        Students can post questions or struggles anonymously, and other students can reply with supportive advice.
        Posts and replies can be upvoted or downvoted so helpful advice becomes easier to find.
    </p>

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
            <ul>
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
                <p>Post anonymously and ask for general support or advice.</p>

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
                        Uses keyword-based filtering to block bullying, spam, unsafe advice, or wrong suggestions.
                    </p>
                    <br>
                    <strong>Future upgrade:</strong>
                    <p>
                        Replace this with AI API moderation to classify replies as approved, blocked, or review.
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
                            <div>
                                <span class="category-pill">
                                    {{ $post->category ?? 'General' }}
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
                                    ⬆
                                </a>

                                <span class="score" id="post-score-{{ $post->id }}">
                                    {{ $post->vote_score ?? 0 }}
                                </span>

                                <a href="{{ route('support.posts.downvote', $post) }}"
                                   class="vote-btn ajax-vote"
                                   data-score-id="post-score-{{ $post->id }}">
                                    ⬇
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

                    <p>{{ $post->body }}</p>

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

                    <div style="margin-top: 25px;">
                        <h3>Approved Advice</h3>

                        @forelse($post->replies as $reply)
                            <div class="reply-box">
                                <div style="display: flex; justify-content: space-between; gap: 15px; align-items: flex-start;">
                                    <div>
                                        <strong>{{ $reply->anonymous_name }}</strong>

                                        <p>{{ $reply->reply }}</p>

                                        <div class="meta">
                                            {{ $reply->created_at->diffForHumans() }}
                                        </div>

                                        <div class="vote-box">
                                            <a href="{{ route('support.replies.upvote', $reply) }}"
                                               class="vote-btn ajax-vote"
                                               data-score-id="reply-score-{{ $reply->id }}">
                                                ⬆
                                            </a>

                                            <span class="score" id="reply-score-{{ $reply->id }}">
                                                {{ $reply->vote_score ?? 0 }}
                                            </span>

                                            <a href="{{ route('support.replies.downvote', $reply) }}"
                                               class="vote-btn ajax-vote"
                                               data-score-id="reply-score-{{ $reply->id }}">
                                                ⬇
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
                            <p style="margin-top: 10px;">
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