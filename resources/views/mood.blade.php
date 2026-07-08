<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mood Tracker | Sirius</title>

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

        .nav a {
            margin-left: 20px;
            text-decoration: none;
            color: #374151;
        }

        .nav a:hover,
        .nav a.active {
            color: #2563eb;
        }

        .page {
            padding: 50px 8%;
        }

        .page h1 {
            font-size: 42px;
            color: #111827;
            margin-bottom: 10px;
        }

        .page-desc {
            color: #4b5563;
            font-size: 18px;
            line-height: 1.6;
            margin-bottom: 30px;
            max-width: 800px;
        }

        .layout {
            display: grid;
            grid-template-columns: 2fr 1fr;
            gap: 28px;
        }

        .card {
            background: white;
            padding: 30px;
            border-radius: 20px;
            box-shadow: 0 8px 25px rgba(0,0,0,0.07);
            margin-bottom: 28px;
        }

        .card h2 {
            margin-bottom: 12px;
            color: #111827;
        }

        .card p {
            color: #4b5563;
            line-height: 1.6;
        }

        .mood-grid {
            display: grid;
            grid-template-columns: repeat(5, 1fr);
            gap: 14px;
            margin: 25px 0;
        }

        .mood-option {
            border: 2px solid #e5e7eb;
            background: #f9fafb;
            padding: 18px 10px;
            border-radius: 16px;
            text-align: center;
            cursor: pointer;
        }

        .mood-option span {
            font-size: 32px;
            display: block;
            margin-bottom: 8px;
        }

        .mood-option.selected {
            border-color: #2563eb;
            background: #eff6ff;
        }

        label {
            display: block;
            margin-top: 18px;
            margin-bottom: 8px;
            font-weight: bold;
            color: #374151;
        }

        input,
        select,
        textarea {
            width: 100%;
            padding: 14px;
            border: 1px solid #d1d5db;
            border-radius: 12px;
            font-size: 16px;
        }

        textarea {
            min-height: 130px;
            resize: vertical;
        }

        .two-column {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 18px;
        }

        .range-row {
            display: flex;
            gap: 12px;
            align-items: center;
        }

        input[type="range"] {
            padding: 0;
        }

        .range-value {
            min-width: 60px;
            background: #eff6ff;
            color: #2563eb;
            font-weight: bold;
            padding: 8px;
            border-radius: 10px;
            text-align: center;
        }

        .save-btn {
            margin-top: 24px;
            background: #2563eb;
            color: white;
            border: none;
            padding: 14px 26px;
            border-radius: 12px;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
        }

        .save-btn:hover {
            background: #1d4ed8;
        }

        .ai-btn {
            margin-top: 20px;
            margin-right: 10px;
            background: #7c3aed;
            color: white;
            border: none;
            padding: 14px 26px;
            border-radius: 12px;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
        }

        .ai-btn:hover {
            background: #6d28d9;
        }

        .success-box {
            background: #dcfce7;
            color: #166534;
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

        .history-item {
            display: flex;
            justify-content: space-between;
            gap: 20px;
            background: #f9fafb;
            padding: 18px;
            border-radius: 16px;
            margin-bottom: 15px;
        }

        .history-left {
            display: flex;
            gap: 14px;
        }

        .history-emoji {
            width: 50px;
            height: 50px;
            background: #eff6ff;
            border-radius: 14px;
            display: flex;
            justify-content: center;
            align-items: center;
            font-size: 28px;
        }

        .stress-pill {
            background: #dbeafe;
            color: #2563eb;
            padding: 8px 12px;
            border-radius: 999px;
            font-weight: bold;
            text-align: center;
            margin-bottom: 10px;
        }

        .delete-btn {
            background: #ef4444;
            color: white;
            border: none;
            padding: 9px 13px;
            border-radius: 8px;
            cursor: pointer;
        }

        .summary-card {
            background: linear-gradient(135deg, #2563eb, #60a5fa);
            color: white;
        }

        .summary-card h2,
        .summary-card p {
            color: white;
        }

        .summary-emoji {
            font-size: 52px;
            margin: 15px 0;
        }

        footer {
            background: #111827;
            color: white;
            text-align: center;
            padding: 22px;
            margin-top: 40px;
        }

        @media (max-width: 900px) {
            .layout {
                grid-template-columns: 1fr;
            }

            .mood-grid {
                grid-template-columns: repeat(2, 1fr);
            }

            .two-column {
                grid-template-columns: 1fr;
            }

            .nav {
                margin-top: 15px;
            }

            .navbar {
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
        <a href="/dashboard">Dashboard</a>
        <a href="/mood" class="active">Mood</a>
        <a href="/journal">Journal</a>
        <a href="/goals">Goals</a>
        <a href="/resources">Resources</a>
        <a href="/support">Support</a>
    </nav>
</header>

<section class="page">
    <h1>Mood Tracker</h1>

    <p class="page-desc">
        Students can record daily mood, stress level, energy level, trigger, and reflection.
        This page is connected to Laravel backend and database.
    </p>

    @if(session('success'))
        <div class="success-box">
            {{ session('success') }}
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

        <div>
            <div class="card">
                <h2>Today's Check-in</h2>
                <p>Choose your mood and save your daily wellness entry.</p>

                <form method="POST" action="{{ route('mood.store') }}">
                    @csrf

                    <input type="hidden" name="mood" id="selectedMood" value="Calm">

                    <div class="mood-grid">
                        <div class="mood-option" onclick="selectMood(this, 'Happy')">
                            <span>😊</span>
                            <p>Happy</p>
                        </div>

                        <div class="mood-option selected" onclick="selectMood(this, 'Calm')">
                            <span>😌</span>
                            <p>Calm</p>
                        </div>

                        <div class="mood-option" onclick="selectMood(this, 'Neutral')">
                            <span>😐</span>
                            <p>Neutral</p>
                        </div>

                        <div class="mood-option" onclick="selectMood(this, 'Stressed')">
                            <span>😟</span>
                            <p>Stressed</p>
                        </div>

                        <div class="mood-option" onclick="selectMood(this, 'Sad')">
                            <span>😢</span>
                            <p>Sad</p>
                        </div>
                    </div>

                    <div class="two-column">
                        <div>
                            <label>Stress Level</label>
                            <div class="range-row">
                                <input type="range" name="stress_level" id="stressRange" min="0" max="100" value="45" oninput="updateStressValue()">
                                <div class="range-value" id="stressValue">45%</div>
                            </div>
                        </div>

                        <div>
                            <label>Energy Level</label>
                            <div class="range-row">
                                <input type="range" name="energy_level" id="energyRange" min="0" max="100" value="65" oninput="updateEnergyValue()">
                                <div class="range-value" id="energyValue">65%</div>
                            </div>
                        </div>
                    </div>

                    <div class="two-column">
                        <div>
                            <label>Main Trigger</label>
                            <select name="trigger" id="trigger">
                                <option>Exam</option>
                                <option>Assignment</option>
                                <option>Part-time Job</option>
                                <option>Sleep Problem</option>
                                <option>Social Pressure</option>
                                <option>Family</option>
                                <option>Other</option>
                            </select>
                        </div>

                        <div>
                            <label>Date</label>
                            <input type="date" name="entry_date" id="moodDate" required>
                        </div>
                    </div>

                    <label>Short Reflection</label>
                    <textarea name="note" id="note" placeholder="Example: I feel stressed because I have an exam tomorrow."></textarea>

                    <input type="hidden" name="used_ai_suggestion" id="usedAiSuggestion" value="0">
                    <input type="hidden" name="ai_suggested_mood" id="aiSuggestedMood">
                    <input type="hidden" name="ai_suggested_stress" id="aiSuggestedStress">
                    <input type="hidden" name="ai_suggested_energy" id="aiSuggestedEnergy">
                    <input type="hidden" name="ai_suggested_trigger" id="aiSuggestedTrigger">

                    <button type="button" class="ai-btn" onclick="suggestMoodFromText()">
                        Suggest Mood with AI
                    </button>

                    <button type="submit" class="save-btn">
                        Save Mood
                    </button>
                </form>
            </div>

            <div class="card">
                <h2>Saved Mood Entries</h2>
                <p>These entries are coming from your database.</p>

                <br>

                @forelse($moodEntries as $entry)
                    <div class="history-item">
                        <div class="history-left">
                            <div class="history-emoji">
                                @if($entry->mood == 'Happy')
                                    😊
                                @elseif($entry->mood == 'Calm')
                                    😌
                                @elseif($entry->mood == 'Neutral')
                                    😐
                                @elseif($entry->mood == 'Stressed')
                                    😟
                                @elseif($entry->mood == 'Sad')
                                    😢
                                @else
                                    🙂
                                @endif
                            </div>

                            <div>
                                <h3>{{ $entry->mood }}</h3>
                                <p>Trigger: {{ $entry->trigger ?? 'None' }}</p>
                                <p>Date: {{ $entry->entry_date }}</p>

                                @if($entry->note)
                                    <p>{{ $entry->note }}</p>
                                @endif

                                @if($entry->used_ai_suggestion)
                                    <p><strong>AI suggestion was used</strong></p>
                                @endif
                            </div>
                        </div>

                        <div>
                            <div class="stress-pill">
                                Stress {{ $entry->stress_level }}%
                            </div>

                            <form method="POST" action="{{ route('mood.destroy', $entry) }}">
                                @csrf
                                @method('DELETE')

                                <button type="submit" class="delete-btn">
                                    Delete
                                </button>
                            </form>
                        </div>
                    </div>
                @empty
                    <p>No mood entries saved yet.</p>
                @endforelse
            </div>
        </div>

        <aside>
            <div class="card summary-card">
                <h2>Current Selection</h2>
                <div class="summary-emoji" id="summaryMood">😌</div>
                <p id="summaryText">
                    Current mood: Calm. Stress level is 45% and energy level is 65%.
                </p>
            </div>

            <div class="card">
                <h2>Backend Status</h2>
                <p>
                    This page now sends data to Laravel controller and saves it in the database.
                </p>
                <br>
                <p>
                    The AI suggestion is currently simple keyword logic. Later, it can be replaced with a real AI API.
                </p>
            </div>
        </aside>

    </div>
</section>

<footer>
    <p>© 2026 Sirius. Student Mental Wellness Platform.</p>
</footer>

<script>
    let moodEmojiMap = {
        "Happy": "😊",
        "Calm": "😌",
        "Neutral": "😐",
        "Stressed": "😟",
        "Sad": "😢"
    };

    function selectMood(element, mood) {
        let options = document.querySelectorAll(".mood-option");

        options.forEach(function(option) {
            option.classList.remove("selected");
        });

        element.classList.add("selected");

        document.getElementById("selectedMood").value = mood;
        document.getElementById("summaryMood").innerText = moodEmojiMap[mood];

        updateSummary();
    }

    function updateStressValue() {
        let stress = document.getElementById("stressRange").value;
        document.getElementById("stressValue").innerText = stress + "%";
        updateSummary();
    }

    function updateEnergyValue() {
        let energy = document.getElementById("energyRange").value;
        document.getElementById("energyValue").innerText = energy + "%";
        updateSummary();
    }

    function updateSummary() {
        let mood = document.getElementById("selectedMood").value;
        let stress = document.getElementById("stressRange").value;
        let energy = document.getElementById("energyRange").value;

        document.getElementById("summaryText").innerText =
            "Current mood: " + mood + ". Stress level is " + stress + "% and energy level is " + energy + "%.";
    }

    function suggestMoodFromText() {
        let note = document.getElementById("note").value.toLowerCase();

        if (note.trim() === "") {
            alert("Please write a short reflection first.");
            return;
        }

        let suggestedMood = "Neutral";
        let suggestedStress = 50;
        let suggestedEnergy = 50;
        let suggestedTrigger = "Other";

        if (
            note.includes("exam") ||
            note.includes("test") ||
            note.includes("quiz")
        ) {
            suggestedMood = "Stressed";
            suggestedStress = 78;
            suggestedEnergy = 40;
            suggestedTrigger = "Exam";
        } else if (
            note.includes("assignment") ||
            note.includes("deadline") ||
            note.includes("project")
        ) {
            suggestedMood = "Stressed";
            suggestedStress = 72;
            suggestedEnergy = 45;
            suggestedTrigger = "Assignment";
        } else if (
            note.includes("tired") ||
            note.includes("sleep") ||
            note.includes("exhausted")
        ) {
            suggestedMood = "Sad";
            suggestedStress = 65;
            suggestedEnergy = 25;
            suggestedTrigger = "Sleep Problem";
        } else if (
            note.includes("happy") ||
            note.includes("good") ||
            note.includes("great") ||
            note.includes("finished") ||
            note.includes("completed")
        ) {
            suggestedMood = "Happy";
            suggestedStress = 30;
            suggestedEnergy = 80;
            suggestedTrigger = "Other";
        } else if (
            note.includes("calm") ||
            note.includes("okay") ||
            note.includes("fine") ||
            note.includes("relaxed")
        ) {
            suggestedMood = "Calm";
            suggestedStress = 40;
            suggestedEnergy = 65;
            suggestedTrigger = "Other";
        }

        applySuggestedMood(suggestedMood, suggestedStress, suggestedEnergy, suggestedTrigger);

        document.getElementById("usedAiSuggestion").value = "1";
        document.getElementById("aiSuggestedMood").value = suggestedMood;
        document.getElementById("aiSuggestedStress").value = suggestedStress;
        document.getElementById("aiSuggestedEnergy").value = suggestedEnergy;
        document.getElementById("aiSuggestedTrigger").value = suggestedTrigger;

        alert(
            "AI suggestion applied:\n" +
            "Mood: " + suggestedMood + "\n" +
            "Stress: " + suggestedStress + "%\n" +
            "Energy: " + suggestedEnergy + "%\n" +
            "Trigger: " + suggestedTrigger
        );
    }

    function applySuggestedMood(mood, stress, energy, trigger) {
        document.getElementById("selectedMood").value = mood;

        let options = document.querySelectorAll(".mood-option");

        options.forEach(function(option) {
            option.classList.remove("selected");

            let moodText = option.querySelector("p").innerText;

            if (moodText === mood) {
                option.classList.add("selected");
            }
        });

        document.getElementById("stressRange").value = stress;
        document.getElementById("energyRange").value = energy;
        document.getElementById("stressValue").innerText = stress + "%";
        document.getElementById("energyValue").innerText = energy + "%";
        document.getElementById("trigger").value = trigger;
        document.getElementById("summaryMood").innerText = moodEmojiMap[mood];

        updateSummary();
    }
</script>

</body>
</html>