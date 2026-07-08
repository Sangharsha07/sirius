<?php

namespace App\Http\Controllers;

use App\Models\SupportPost;
use App\Models\SupportReply;
use App\Models\SupportPostVote;
use App\Models\SupportReplyVote;
use Illuminate\Http\Request;

class SupportBoardController extends Controller
{
    public function index()
    {
        $posts = SupportPost::withSum('votes as vote_score', 'vote')
            ->with(['replies' => function ($query) {
                $query->where('status', 'approved')
                    ->withSum('votes as vote_score', 'vote')
                    ->latest();
            }])
            ->latest()
            ->get();

        return view('support', compact('posts'));
    }

    public function storePost(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:150',
            'body' => 'required|string|max:2000',
            'category' => 'nullable|string|max:100',
            'flag' => 'nullable|string|in:general,serious,urgent,advice_needed,academic',
            'anonymous_name' => 'nullable|string|max:100',
        ]);

        SupportPost::create([
            'user_id' => auth()->id(),
            'title' => $validated['title'],
            'body' => $validated['body'],
            'category' => $validated['category'] ?? 'General Support',
            'flag' => $validated['flag'] ?? 'general',
            'anonymous_name' => $validated['anonymous_name'] ?? 'Anonymous Student',
        ]);

        return redirect('/support')->with('success', 'Your support post was created.');
    }

    public function storeReply(Request $request, SupportPost $supportPost)
    {
        $validated = $request->validate([
            'reply' => 'required|string|max:1500',
            'anonymous_name' => 'nullable|string|max:100',
        ]);

        $moderation = $this->moderateReply($validated['reply']);

        SupportReply::create([
            'support_post_id' => $supportPost->id,
            'user_id' => auth()->id(),
            'reply' => $validated['reply'],
            'anonymous_name' => $validated['anonymous_name'] ?? 'Anonymous Student',
            'status' => $moderation['status'],
            'filter_reason' => $moderation['reason'],
        ]);

        if ($moderation['status'] === 'blocked') {
            return redirect('/support')->with('warning', 'Your reply was blocked because it may contain unsafe or inappropriate advice.');
        }

        if ($moderation['status'] === 'review') {
            return redirect('/support')->with('warning', 'Your reply was saved for review because it may need moderation.');
        }

        return redirect('/support')->with('success', 'Your advice was posted successfully.');
    }

    private function moderateReply(string $reply): array
    {
        $text = strtolower($reply);

        $blockedWords = [
            'bully',
            'stupid',
            'idiot',
            'shut up',
            'worthless',
            'loser',
            'hate you',
        ];

        $wrongAdvicePatterns = [
            'skip all classes',
            'ignore your health',
            'do not sleep',
            'never ask for help',
            'do not tell anyone',
            'do not talk to anyone',
            'avoid everyone',
            'quit everything',
            'doctor is useless',
            'counselor is useless',
        ];

        $needsReviewPatterns = [
            'medicine',
            'diagnose',
            'panic attack',
            'depression',
            'trauma',
            'crisis',
            'medical advice',
            'therapy',
            'medication',
        ];

        foreach ($blockedWords as $word) {
            if (str_contains($text, $word)) {
                return [
                    'status' => 'blocked',
                    'reason' => 'Bullying or disrespectful language detected.',
                ];
            }
        }

        foreach ($wrongAdvicePatterns as $pattern) {
            if (str_contains($text, $pattern)) {
                return [
                    'status' => 'blocked',
                    'reason' => 'Unsafe or wrong advice detected.',
                ];
            }
        }

        foreach ($needsReviewPatterns as $pattern) {
            if (str_contains($text, $pattern)) {
                return [
                    'status' => 'review',
                    'reason' => 'Sensitive support topic may need review.',
                ];
            }
        }

        return [
            'status' => 'approved',
            'reason' => null,
        ];
    }

    public function destroyPost(SupportPost $supportPost)
    {
        if ($supportPost->user_id != auth()->id()) {
            abort(403, 'You can only delete your own post.');
        }

        $supportPost->delete();

        return redirect('/support')->with('success', 'Post deleted.');
    }

    public function destroyReply(SupportReply $supportReply)
    {
        if ($supportReply->user_id != auth()->id()) {
            abort(403, 'You can only delete your own comment.');
        }

        $supportReply->delete();

        return redirect('/support')->with('success', 'Your comment was deleted.');
    }

    public function upvotePost(SupportPost $supportPost)
    {
        return $this->votePostValue($supportPost, 1);
    }

    public function downvotePost(SupportPost $supportPost)
    {
        return $this->votePostValue($supportPost, -1);
    }

    private function votePostValue(SupportPost $supportPost, int $vote)
    {
        if ($supportPost->user_id == auth()->id()) {
            if (request()->expectsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'You cannot vote on your own post.',
                    'score' => $supportPost->votes()->sum('vote'),
                ], 403);
            }

            return redirect('/support')->with('warning', 'You cannot vote on your own post.');
        }

        $existingVote = SupportPostVote::where('support_post_id', $supportPost->id)
            ->where('user_id', auth()->id())
            ->first();

        if ($existingVote && $existingVote->vote == $vote) {
            $existingVote->delete();
        } else {
            SupportPostVote::updateOrCreate(
                [
                    'support_post_id' => $supportPost->id,
                    'user_id' => auth()->id(),
                ],
                [
                    'vote' => $vote,
                ]
            );
        }

        $score = $supportPost->votes()->sum('vote');

        if (request()->expectsJson()) {
            return response()->json([
                'success' => true,
                'score' => $score,
            ]);
        }

        return redirect('/support')->with('success', 'Your post vote was saved.');
    }

    public function upvoteReply(SupportReply $supportReply)
    {
        return $this->voteReplyValue($supportReply, 1);
    }

    public function downvoteReply(SupportReply $supportReply)
    {
        return $this->voteReplyValue($supportReply, -1);
    }

    private function voteReplyValue(SupportReply $supportReply, int $vote)
    {
        if ($supportReply->user_id == auth()->id()) {
            if (request()->expectsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'You cannot vote on your own advice.',
                    'score' => $supportReply->votes()->sum('vote'),
                ], 403);
            }

            return redirect('/support')->with('warning', 'You cannot vote on your own advice.');
        }

        $existingVote = SupportReplyVote::where('support_reply_id', $supportReply->id)
            ->where('user_id', auth()->id())
            ->first();

        if ($existingVote && $existingVote->vote == $vote) {
            $existingVote->delete();
        } else {
            SupportReplyVote::updateOrCreate(
                [
                    'support_reply_id' => $supportReply->id,
                    'user_id' => auth()->id(),
                ],
                [
                    'vote' => $vote,
                ]
            );
        }

        $score = $supportReply->votes()->sum('vote');

        if (request()->expectsJson()) {
            return response()->json([
                'success' => true,
                'score' => $score,
            ]);
        }

        return redirect('/support')->with('success', 'Your reply vote was saved.');
    }
}