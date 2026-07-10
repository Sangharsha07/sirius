<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sleep & Routine | Sirius</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: Arial, Helvetica, sans-serif; }
        body {
            min-height: 100vh;
            color: #1f2937;
            background: radial-gradient(circle at 10% 8%, rgba(196, 181, 253, 0.32), transparent 25%),
                        radial-gradient(circle at 91% 17%, rgba(186, 230, 253, 0.48), transparent 28%),
                        linear-gradient(180deg, #eef4ff 0%, #f8fbff 48%, #f7f4ff 100%);
        }
        .navbar { display: flex; align-items: center; justify-content: space-between; min-height: 80px; padding: 14px 7%; background: rgba(255,255,255,0.86); backdrop-filter: blur(18px); box-shadow: 0 8px 28px rgba(30, 64, 175, 0.07); }
        .brand { color: #312e81; font-size: 28px; font-weight: 900; text-decoration: none; }
        .hero { padding: 70px 7% 110px; color: white; background: radial-gradient(circle at 76% 32%, rgba(255,245,185,0.7), transparent 18%), linear-gradient(135deg, #172554 0%, #3730a3 46%, #7c3aed 100%); }
        .hero h1 { font-size: clamp(34px, 4.3vw, 54px); margin-bottom: 14px; line-height: 1.08; }
        .page { max-width: 1400px; margin: -70px auto 75px; padding: 0 7%; }
        
        .card { padding: 40px; background: rgba(255,255,255,0.96); border: 1px solid rgba(226,232,240,0.9); border-radius: 24px; box-shadow: 0 20px 52px rgba(30,41,59,0.1); margin-bottom: 30px; }
        .card h2 { color: #111827; margin-bottom: 15px; font-size: 24px; }
        .card p { color: #64748b; line-height: 1.8; font-size: 16px; margin-bottom: 24px; }
        
        .grid-layout { display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 20px; margin-top: 25px; }
        .resource-box { padding: 24px; background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 16px; }
        .resource-box h3 { font-size: 18px; color: #1e3a8a; margin-bottom: 8px; }
        .resource-box p { font-size: 14px; color: #475569; margin-bottom: 15px; }
        
        .action-btn { display: inline-flex; align-items: center; justify-content: center; padding: 10px 18px; color: white; font-weight: 700; font-size: 14px; border-radius: 10px; text-decoration: none; transition: opacity 0.2s; }
        .btn-blue { background: linear-gradient(135deg, #2563eb, #3b82f6); }
        .btn-green { background: linear-gradient(135deg, #059669, #10b981); }
        .action-btn:hover { opacity: 0.9; }
        
        /* Interactive Routine Builder Styles */
        .routine-container { padding: 25px; background: #f0fdf4; border-radius: 16px; border: 1px solid #bbf7d0; margin-top: 25px; }
        .routine-item { display: flex; align-items: center; gap: 12px; margin-bottom: 12px; font-size: 15px; color: #1e293b; cursor: pointer; }
        .routine-item input { width: 18px; height: 18px; accent-color: #16a34a; cursor: pointer; }
        .routine-progress { font-weight: bold; color: #16a34a; margin-top: 15px; display: block; }

        .back-btn { display: inline-block; padding: 11px 20px; color: #4f46e5; font-weight: 800; border-radius: 12px; text-decoration: none; border: 2px solid #4f46e5; margin-top: 20px; transition: background 0.2s, color 0.2s; }
        .back-btn:hover { background: #4f46e5; color: white; }
    </style>
</head>
<body>

<header class="navbar">
    <a href="/" class="brand">Sirius</a>
</header>

<section class="hero">
    <h1>Sleep & Routine Support</h1>
</section>

<main class="page">
    <div class="card">
        <h2>Optimizing Sleep Hygiene and Daily Balance</h2>
        <p>
            Irregular schedules, late-night study streaks, and high screen exposure make quality sleep a major challenge for college students. Building a predictable nighttime window drastically aids focus, memory, and emotional regulation.
        </p>

        <div class="grid-layout">
            <div class="resource-box">
                <h3>Temple Wellness Resource Center</h3>
                <p>Access peer-led sleep hygiene guides, time management tools, and regular routine planning consultation programs.</p>
                <a href="mailto:tuwellness@temple.edu" class="action-btn btn-green">✉️ Email for Resource Materials</a>
            </div>

            <div class="resource-box">
                <h3>Temple Student Health Services</h3>
                <p>Schedule medical consultations if sleep troubles become persistent or require diagnostic attention.</p>
                <a href="tel:2152047500" class="action-btn btn-blue">📞 Call 215-204-7500</a>
            </div>
        </div>

        <div class="routine-container">
            <h3 style="color: #14532d; font-size: 18px; margin-bottom: 10px;">🌙 Optimize Your Evening Reset</h3>
            <p style="color: #166534; font-size: 14px; margin-bottom: 15px;">Tick off these basic benchmarks to protect your deep sleep cycles tonight:</p>
            
            <label class="routine-item">
                <input type="checkbox" class="routine-check"> Screens powered down or set to warm shift 30 mins before bed
            </label>
            <label class="routine-item">
                <input type="checkbox" class="routine-check"> Caffeine cut off completely 6 hours before planned rest
            </label>
            <label class="routine-item">
                <input type="checkbox" class="routine-check"> Room ambient temperature set cool and lights adjusted low
            </label>
            <label class="routine-item">
                <input type="checkbox" class="routine-check"> Workspace or desk area organized to offset morning start stress
            </label>

            <span id="progressMessage" class="routine-progress">Routine Track: 0 / 4 benchmarks cleared</span>
        </div>

        <div style="margin-top: 40px; border-top: 1px solid #e2e8f0; padding-top: 20px;">
            <a href="{{ route('resources') }}" class="back-btn">← Back to Resources</a>
        </div>
    </div>
</main>

<script>
    const checkboxes = document.querySelectorAll('.routine-check');
    const message = document.getElementById('progressMessage');

    checkboxes.forEach(box => {
        box.addEventListener('change', () => {
            const count = document.querySelectorAll('.routine-check:checked').length;
            message.innerText = `Routine Track: ${count} / 4 benchmarks cleared`;
            
            if (count === 4) {
                message.innerText = "🎉 All systems clear! Your sleep environment is fully optimized.";
            }
        });
    });
</script>

@include('partials.theme-script')
</body>
</html>