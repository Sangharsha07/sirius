<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Review Queue | Sirius</title>

    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
            background: #f4f7fb;
            color: #1f2937;
            padding: 40px 8%;
        }

        .top {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 28px;
        }

        h1 {
            font-size: 38px;
            color: #111827;
        }

        h2 {
            font-size: 28px;
            margin: 34px 0 16px;
            color: #111827;
        }

        a {
            color: #2563eb;
            text-decoration: none;
            font-weight: bold;
        }

        .success {
            background: #dcfce7;
            color: #166534;
            padding: 16px;
            border-radius: 14px;
            margin-bottom: 20px;
        }

        .card {
            background: white;
            padding: 26px;
            border-radius: 22px;
            box-shadow: 0 8px 25px rgba(0,0,0,0.06);
            margin-bottom: 22px;
        }

        .title {
            font-size: 22px;
            font-weight: bold;
            color: #111827;
            margin-bottom: 10px;
        }

        .meta {
            color: #6b7280;
            margin-bottom: 14px;
        }

        .content {
            font-size: 17px;
            line-height: 1.8;
            color: #374151;
            background: #f8fafc;
            padding: 18px;
            border-radius: 15px;
            margin: 16px 0;
        }

        .reason {
            background: #fef3c7;
            color: #92400e;
            padding: 15px;
            border-radius: 14px;
            margin-bottom: 16px;
            line-height: 1.6;
        }

        .actions {
            display: flex;
            gap: 12px;
            flex-wrap: wrap;
        }

        button {
            border: none;
            padding: 12px 18px;
            border-radius: 11px;
            color: white;
            font-weight: bold;
            cursor: pointer;
            font-size: 15px;
        }

        .approve {
            background: #16a34a;
        }

        .reject {
            background: #ef4444;
        }

        .empty {
            background: white;
            padding: 22px;
            border-radius: 18px;
            color: #6b7280;
            margin-bottom: 22px;
        }
    </style>
    <link rel="icon" type="image/png" href="{{ asset('images/favicon.png') }}">
    <link rel="apple-touch-icon" href="{{ asset('images/favicon.png') }}">
</head>
<body>

<div class="top">
    <h1>Sirius Review Queue</h1>
    <a href="{{ route('support.index') }}">Back to Support Board</a>
</div>

@if(session('success'))
    <div class="success">
        {{ session('success') }}
    </div>
@endif

<h2>Posts Waiting for Review</h2>

@forelse($posts as $post)
    <div class="card">
        <div class="title">
            {{ $post->title }}
        </div>

        <div class="meta">
            Posted by {{ $post->anonymous_name }} |
            Category: {{ $post->category ?? 'General Support' }} |
            {{ $post->created_at->diffForHumans() }}
        </div>

        <div class="content">
            {!! nl2br(e($post->body)) !!}
        </div>

        <div class="reason">
            <strong>Review reason:</strong><br>
            {{ $post->filter_reason ?? 'No reason saved.' }}
        </div>

        <div class="actions">
            <form method="POST" action="{{ route('support.review.posts.approve', $post) }}">
                @csrf
                @method('PATCH')

                <button type="submit" class="approve">
                    Approve Post
                </button>
            </form>

            <form method="POST" action="{{ route('support.review.posts.reject', $post) }}">
                @csrf
                @method('DELETE')

                <button type="submit" class="reject">
                    Reject / Delete Post
                </button>
            </form>
        </div>
    </div>
@empty
    <div class="empty">
        No posts waiting for review.
    </div>
@endforelse

<h2>Replies Waiting for Review</h2>

@forelse($replies as $reply)
    <div class="card">
        <div class="title">
            Reply on post: {{ $reply->post->title ?? 'Deleted post' }}
        </div>

        <div class="meta">
            Reply by {{ $reply->anonymous_name }} |
            {{ $reply->created_at->diffForHumans() }}
        </div>

        <div class="content">
            {!! nl2br(e($reply->reply)) !!}
        </div>

        <div class="reason">
            <strong>Review reason:</strong><br>
            {{ $reply->filter_reason ?? 'No reason saved.' }}
        </div>

        <div class="actions">
            <form method="POST" action="{{ route('support.review.replies.approve', $reply) }}">
                @csrf
                @method('PATCH')

                <button type="submit" class="approve">
                    Approve Reply
                </button>
            </form>

            <form method="POST" action="{{ route('support.review.replies.reject', $reply) }}">
                @csrf
                @method('DELETE')

                <button type="submit" class="reject">
                    Reject / Delete Reply
                </button>
            </form>
        </div>
    </div>
@empty
    <div class="empty">
        No replies waiting for review.
    </div>
@endforelse

</body>
</html>