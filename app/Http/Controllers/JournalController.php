<?php

namespace App\Http\Controllers;

use App\Models\Journal;
use App\Models\SupportPost;
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

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
            'is_public' => 'required|boolean',
        ]);

        $journalEntry = Journal::create([
            'user_id' => Auth::id(),
            'title' => $request->title,
            'content' => $request->content,
            'is_public' => $request->is_public,
        ]);

        if ($journalEntry->is_public) {
            SupportPost::create([
                'user_id' => Auth::id(),
                'title' => $journalEntry->title,
                'body' => $journalEntry->content,
                'category' => 'Journal',
                'flag' => 'general',
                'anonymous_name' => $journalEntry->user->name ?? 'Anonymous Student',
                'status' => 'approved',
                'filter_reason' => null,
            ]);
        }

        return redirect()->route('journal.index')->with('success', 'Journal entry saved!');
    }
}