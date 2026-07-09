<?php

namespace App\Http\Controllers;

use App\Models\Goal; 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GoalController extends Controller
{
    // Fetch and display all goals for the logged-in user
    public function index()
    {
        $goals = Goal::where('user_id', Auth::id())->latest()->get();
        return view('goals', compact('goals'));
    }

    // Save a new goal into the database
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'required|string',
            'target_date' => 'required|date',
        ]);

        Goal::create([
            'user_id' => Auth::id(),
            'title' => $request->title,
            'category' => $request->category,
            'target_date' => $request->target_date,
            'status' => 'In Progress', // Default status when a goal is created
        ]);

        return redirect()->route('goals.index')->with('success', 'Goal added successfully!');
    }

    // Update the status of an existing goal (In Progress <-> Completed)
    public function toggleStatus(Request $request, Goal $goal)
    {
        // Security gate check to ensure users can only change their own goals
        if ($goal->user_id !== Auth::id()) {
            abort(403);
        }

        $request->validate([
            'status' => 'required|string'
        ]);

        $goal->update([
            'status' => $request->status
        ]);

        return redirect()->route('goals.index')->with('success', 'Goal status updated!');
    }
}