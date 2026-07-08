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
        note.includes("quiz") ||
        note.includes("assignment") ||
        note.includes("deadline") ||
        note.includes("project")
    ) {
        suggestedMood = "Stressed";
        suggestedStress = 75;
        suggestedEnergy = 40;
        suggestedTrigger = note.includes("exam") || note.includes("test") || note.includes("quiz")
            ? "Exam"
            : "Assignment";
    }

    if (
        note.includes("tired") ||
        note.includes("sleep") ||
        note.includes("exhausted") ||
        note.includes("low energy")
    ) {
        suggestedMood = "Sad";
        suggestedStress = 65;
        suggestedEnergy = 25;
        suggestedTrigger = "Sleep Problem";
    }

    if (
        note.includes("happy") ||
        note.includes("good") ||
        note.includes("great") ||
        note.includes("finished") ||
        note.includes("completed") ||
        note.includes("relaxed")
    ) {
        suggestedMood = "Happy";
        suggestedStress = 30;
        suggestedEnergy = 80;
        suggestedTrigger = "Other";
    }

    if (
        note.includes("calm") ||
        note.includes("peaceful") ||
        note.includes("okay") ||
        note.includes("fine")
    ) {
        suggestedMood = "Calm";
        suggestedStress = 40;
        suggestedEnergy = 65;
        suggestedTrigger = "Other";
    }

    applySuggestedMood(suggestedMood, suggestedStress, suggestedEnergy, suggestedTrigger);

    alert(
        "AI suggestion:\n" +
        "Mood: " + suggestedMood + "\n" +
        "Stress: " + suggestedStress + "%\n" +
        "Energy: " + suggestedEnergy + "%\n" +
        "Trigger: " + suggestedTrigger + "\n\n" +
        "You can edit it before saving."
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
