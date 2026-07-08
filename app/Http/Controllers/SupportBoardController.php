<?php

namespace App\Http\Controllers;

use App\Models\SupportPost;
use App\Models\SupportReply;
use Illuminate\Http\Request;

class SupportBoardController extends Controller
{
    public function index()
    {
        $posts = SupportPost::with(['replies' => function ($query) {
            $query->where('status', 'approved')->latest();
        }])->latest()->get();

        return view('support', compact('posts'));
    }

    public function storePost(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:150',
            'body' => 'required|string|max:2000',
            'category' => 'nullable|string|max:100',
            'anonymous_name' => 'nullable|string|max:100',
        ]);

        SupportPost::create([
            'title' => $validated['title'],
            'body' => $validated['body'],
            'category' => $validated['category'] ?? 'General',
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
            'reply' => $validated['reply'],
            'anonymous_name' => $validated['anonymous_name'] ?? 'Anonymous Student',
            'status' => $moderation['status'],
            'filter_reason' => $moderation['reason'],
        ]);

        if ($moderation['status'] === 'blocked') {
            return redirect('/support')->with('warning', 'Your reply was blocked because it may contain unsafe or harmful advice.');
        }

        if ($moderation['status'] === 'review') {
            return redirect('/support')->with('warning', 'Your reply was saved for review because it may need moderation.');
        }

        return redirect('/support')->with('success', 'Your advice was posted successfully.');
    }

    private function moderateReply(string $reply): array
    {
        $text = strtolower($reply);

        /*
            Prototype filter:
            Later, this function can be replaced with real AI API moderation.
        */

        $blockedWords = [
            'bully',
            'stupid',
            'idiot',
            'shut up',
            'worthless',
        ];

        $wrongAdvicePatterns = [
            'stop eating',
            'skip all classes',
            'ignore your health',
            'do not sleep',
            'never ask for help',
            'do not tell anyone',
            'take random pills',
            'drink alcohol to relax',
            'use drugs',
        ];

        $needsReviewPatterns = [
            'medicine',
            'diagnose',
            'doctor is useless',
            'counselor is useless',
            'panic attack',
            'depression',
            'trauma',
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
                    'reason' => 'Sensitive mental health topic may need review.',
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
        $supportPost->delete();

        return redirect('/support')->with('success', 'Post deleted.');
    }
}