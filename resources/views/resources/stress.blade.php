<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stress Management | Sirius</title>
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
        
        /* Interactive Breathing Space tool styles */
        .breath-container { text-align: center; padding: 30px; background: #eef2ff; border-radius: 16px; border: 1px dashed #c7d2fe; margin-top: 20px; }
        .breath-circle { width: 100px; height: 100px; background: linear-gradient(135deg, #6366f1, #4f46e5); border-radius: 50%; margin: 20px auto; transition: transform 4s ease-in-out; display: flex; align-items: center; justify-content: center; color: white; font-weight: bold; }
        .breath-active { transform: scale(1.6); }

        .back-btn { display: inline-block; padding: 11px 20px; color: #4f46e5; font-weight: 800; border-radius: 12px; text-decoration: none; border: 2px solid #4f46e5; margin-top: 20px; transition: background 0.2s, color 0.2s; }
        .back-btn:hover { background: #4f46e5; color: white; }
    </style>
</head>
<body>

<header class="navbar">
    <a href="/" class="brand">Sirius</a>
</header>

<section class="hero">
    <h1>Stress Management Strategies</h1>
</section>

<main class="page">
    <div class="card">
        <h2>Navigating Academic and Personal Stress</h2>
        <p>
            Academic pressures, heavy assignment loads, and balancing your routine can sometimes lead to intense stress spikes. Managing stress effectively isn't about eliminating tension entirely, but building practical habits to control it.
        </p>

        <div class="grid-layout">
            
            <div class="resource-box">
                <h3>Temple Wellness Resource Center (WRC)</h3>
                <p>Register for stress reduction programs, mindfulness workshops, and peer support events at Temple.</p>
                <a href="mailto:tuwellness@temple.edu" class="action-btn btn-green">✉️ Email WRC Teams</a>
            </div>

            <div class="resource-box">
                <h3>Resiliency Resource Room</h3>
                <p>Tuttleman Counseling Services provides spaces for relaxation, light therapy, and peaceful resetting.</p>
                <a href="tel:2152047276" class="action-btn btn-blue">📞 Call to Check Hours</a>
            </div>

            <div class="resource-box">
                <h3>Sirius Mental Fitness Toolbox</h3>
                <p>Use structured time-blocking systems or try our quick guided somatic reset pacing circle below.</p>
                <button id="startBreathing" class="action-btn btn-blue" style="cursor: pointer; border: none;">Start Breathing Guide</button>
            </div>

        </div>

        <div class="breath-container">
            <h3 id="breathInstruction">Click the button above to start a quick 1-minute decompression circuit.</h3>
            <div id="visualCircle" class="breath-circle">Calm</div>
        </div>

        <div style="margin-top: 40px; border-top: 1px solid #e2e8f0; padding-top: 20px;">
            <a href="{{ route('resources') }}" class="back-btn">← Back to Resources</a>
        </div>
    </div>
</main>

<script>
    const startBtn = document.getElementById('startBreathing');
    const circle = document.getElementById('visualCircle');
    const label = document.getElementById('breathInstruction');
    let dynamicLoop = null;

    startBtn.addEventListener('click', () => {
        if (dynamicLoop) {
            clearInterval(dynamicLoop);
            dynamicLoop = null;
            startBtn.innerText = "Start Breathing Guide";
            label.innerText = "Decompression circuit stopped.";
            circle.classList.remove('breath-active');
            circle.innerText = "Calm";
            return;
        }

        startBtn.innerText = "Stop Cycle";
        runBreathingSequence();
        dynamicLoop = setInterval(runBreathingSequence, 8000);
    });

    function runBreathingSequence() {
        label.innerText = "Breathe in slowly...";
        circle.innerText = "Inhale";
        circle.classList.add('breath-active');
        
        setTimeout(() => {
            label.innerText = "Exhale slowly and completely...";
            circle.innerText = "Exhale";
            circle.classList.remove('breath-active');
        }, 4000);
    }
</script>

@include('partials.theme-script')
</body>
</html>