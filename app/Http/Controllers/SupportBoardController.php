<?php

namespace App\Http\Controllers;

use App\Models\SupportPost;
use App\Models\SupportReply;
use App\Models\SupportPostVote;
use App\Models\SupportReplyVote;
use App\Services\SiriusGeminiModerationService;
use Illuminate\Http\Request;

class SupportBoardController extends Controller
{
    public function index()
    {
        $posts = SupportPost::where('status', 'approved')
            ->withSum('votes as vote_score', 'vote')
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

        $moderation = $this->moderateContent(
            $validated['title'] . "\n\n" . $validated['body']
        );

        if ($moderation['status'] === 'blocked') {
            return redirect('/support')->with(
                'warning',
                'Your post was blocked. Reason: ' . ($moderation['reason'] ?? 'Unsafe content detected.')
            );
        }

        $post = SupportPost::create([
            'user_id' => auth()->id(),
            'title' => $validated['title'],
            'body' => $validated['body'],
            'category' => $validated['category'] ?? 'General Support',
            'flag' => $validated['flag'] ?? 'general',
            'anonymous_name' => $validated['anonymous_name'] ?? 'Anonymous Student',
            'status' => $moderation['status'],
            'filter_reason' => $moderation['reason'],
        ]);

        if ($moderation['status'] === 'review') {
            return redirect('/support')->with(
                'warning',
                'Your post was saved for review. It is hidden until the website admin approves it. Reason: ' . ($moderation['reason'] ?? 'Needs review.')
            );
        }

        $this->createSiriusAutoReply($post);

        return redirect('/support')->with('success', 'Your support post was created.');
    }

    public function storeReply(Request $request, SupportPost $supportPost)
    {
        $validated = $request->validate([
            'reply' => 'required|string|max:1500',
            'anonymous_name' => 'nullable|string|max:100',
        ]);

        $moderation = $this->moderateContent($validated['reply']);

        if ($moderation['status'] === 'blocked') {
            return redirect('/support')->with(
                'warning',
                'Your reply was blocked. Reason: ' . ($moderation['reason'] ?? 'Unsafe or inappropriate advice detected.')
            );
        }

        SupportReply::create([
            'support_post_id' => $supportPost->id,
            'user_id' => auth()->id(),
            'reply' => $validated['reply'],
            'anonymous_name' => $validated['anonymous_name'] ?? 'Anonymous Student',
            'status' => $moderation['status'],
            'filter_reason' => $moderation['reason'],
        ]);

        if ($moderation['status'] === 'review') {
            return redirect('/support')->with(
                'warning',
                'Your reply was saved for review. It is hidden until the website admin approves it. Reason: ' . ($moderation['reason'] ?? 'Needs review.')
            );
        }

        return redirect('/support')->with('success', 'Your advice was posted successfully.');
    }

    private function moderateContent(string $content): array
    {
        $text = strtolower($content);
        $text = preg_replace('/\s+/', ' ', $text);

        $hardBlockedPatterns = [
            '/\bkys\b/i',
            '/\b' . 'k' . 'ill' . '\s+(yourself|urself|your self)\b/i',
            '/\b(end|finish)\s+(your\s+life|ur\s+life)\b/i',
            '/\bharm\s+(yourself|urself|your self)\b/i',
        ];

        foreach ($hardBlockedPatterns as $pattern) {
            if (preg_match($pattern, $content)) {
                return [
                    'status' => 'blocked',
                    'reason' => 'Self-harm encouragement or unsafe harmful language detected.',
                ];
            }
        }

        $blockedWords = [
            'bully',
            'stupid',
            'idiot',
            'shut up',
            'worthless',
            'loser',
            'hate you',
            'kys',
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
            'therapy is useless',
            'medicine is useless',
            'do not rest',
            'just suffer',
            'nobody cares',
            'you are alone',
            'give up',
            'keep it secret',
            'hide it from everyone',
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
                    'reason' => 'Bullying, harassment, or harmful language detected.',
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
                    'reason' => 'Sensitive support topic may need admin review.',
                ];
            }
        }

        $aiModeration = app(SiriusGeminiModerationService::class)->checkAdvice($content);

        if (!$aiModeration['success']) {
            return [
                'status' => 'review',
                'reason' => $aiModeration['reason'] ?? 'AI moderation failed, so this content needs review.',
            ];
        }

        if ($aiModeration['status'] === 'blocked') {
            return [
                'status' => 'blocked',
                'reason' => $aiModeration['reason'],
            ];
        }

        if ($aiModeration['status'] === 'review') {
            return [
                'status' => 'review',
                'reason' => $aiModeration['reason'],
            ];
        }

        return [
            'status' => 'approved',
            'reason' => null,
        ];
    }

    private function createSiriusAutoReply(SupportPost $post): void
    {
        $alreadyExists = SupportReply::where('support_post_id', $post->id)
            ->where('anonymous_name', 'Sirius Support')
            ->exists();

        if ($alreadyExists) {
            return;
        }

        SupportReply::create([
            'support_post_id' => $post->id,
            'user_id' => null,
            'reply' => "Hi, I’m Sirius Support.\n\nYou are not alone.\n\nIf you need support, you can contact:\n\n• TUJ Counseling\n  tujcounseling@tuj.temple.edu\n\n• TUJ TELUS JA Students\n  0800-222-1148\n\n• TELL English Lifeline\n  0800-300-8355\n\n• Yorisoi Hotline Japan\n  0120-279-338\n\nEmergency in Japan:\n• Ambulance: 119\n• Police: 110",
            'anonymous_name' => 'Sirius Support',
            'status' => 'approved',
            'filter_reason' => null,
        ]);
    }

    private function ensureAdmin(): void
    {
        $adminEmails = collect(config('services.admin.emails', []))
            ->map(fn ($email) => strtolower(trim($email)))
            ->filter()
            ->values()
            ->toArray();

        $userEmail = strtolower(trim(auth()->user()->email ?? ''));

        if (!$userEmail || !in_array($userEmail, $adminEmails, true)) {
            abort(403, 'Only website admins can access this page.');
        }
    }

    public function reviewQueue()
    {
        $this->ensureAdmin();

        $posts = SupportPost::where('status', 'review')
            ->latest()
            ->get();

        $replies = SupportReply::where('status', 'review')
            ->with('post')
            ->latest()
            ->get();

        return view('support-review', compact('posts', 'replies'));
    }

    public function approvePost(SupportPost $supportPost)
    {
        $this->ensureAdmin();

        $supportPost->update([
            'status' => 'approved',
            'filter_reason' => null,
        ]);

        $this->createSiriusAutoReply($supportPost);

        return redirect()
            ->route('support.review')
            ->with('success', 'Post approved and is now visible.');
    }

    public function rejectPost(SupportPost $supportPost)
    {
        $this->ensureAdmin();

        $supportPost->votes()->delete();

        foreach ($supportPost->replies as $reply) {
            $reply->votes()->delete();
            $reply->delete();
        }

        $supportPost->delete();

        return redirect()
            ->route('support.review')
            ->with('success', 'Post rejected and deleted.');
    }

    public function approveReply(SupportReply $supportReply)
    {
        $this->ensureAdmin();

        $supportReply->update([
            'status' => 'approved',
            'filter_reason' => null,
        ]);

        return redirect()
            ->route('support.review')
            ->with('success', 'Reply approved and is now visible.');
    }

    public function rejectReply(SupportReply $supportReply)
    {
        $this->ensureAdmin();

        $supportReply->votes()->delete();
        $supportReply->delete();

        return redirect()
            ->route('support.review')
            ->with('success', 'Reply rejected and deleted.');
    }

    public function destroyPost(SupportPost $supportPost)
    {
        if ($supportPost->user_id != auth()->id()) {
            abort(403, 'You can only delete your own post.');
        }

        $supportPost->votes()->delete();

        foreach ($supportPost->replies as $reply) {
            $reply->votes()->delete();
            $reply->delete();
        }

        $supportPost->delete();

        return redirect('/support')->with('success', 'Post deleted.');
    }

    public function destroyReply(SupportReply $supportReply)
    {
        if ($supportReply->user_id != auth()->id()) {
            abort(403, 'You can only delete your own comment.');
        }

        $supportReply->votes()->delete();
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