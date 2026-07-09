<?php

namespace App\Http\Controllers;

use App\Models\Journal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class JournalController extends Controller
{
    public function index()
    {
        $previousEntries = Journal::where('user_id', Auth::id())
            ->latest()
            ->get();

        return view('journal', compact('previousEntries'));
    }

    // 2. Handle Entry Form Submissions
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
            'is_public' => 'required|boolean',
        ]);

        Journal::create([
            'user_id' => Auth::id(),
            'title' => $request->title,
            'content' => $request->content,
            'is_public' => $request->is_public,
        ]);

        return redirect()->route('journal.index')->with('success', 'Journal entry saved!');
    }

    public function publicFeed()
    {
        $publicJournals = Journal::with('user')
            ->where('is_public', true)
            ->latest()
            ->get();

        return view('forum', compact('publicJournals'));
    }
}