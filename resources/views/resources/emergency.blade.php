<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Emergency Support | Sirius</title>
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
        .hero { padding: 70px 7% 110px; color: white; background: radial-gradient(circle at 76% 32%, rgba(255,245,185,0.7), transparent 18%), linear-gradient(135deg, #172554 0%, #ef4444 100%); }
        .hero h1 { font-size: clamp(34px, 4.3vw, 54px); margin-bottom: 14px; line-height: 1.08; }
        .page { max-width: 1400px; margin: -70px auto 75px; padding: 0 7%; }
        
        .card { padding: 40px; background: rgba(255,255,255,0.96); border: 1px solid rgba(255, 226, 226, 0.9); border-radius: 24px; box-shadow: 0 20px 52px rgba(220, 38, 38, 0.08); margin-bottom: 30px; }
        .card h2 { color: #991b1b; margin-bottom: 15px; font-size: 24px; display: flex; align-items: center; gap: 10px; }
        .card p { color: #64748b; line-height: 1.8; font-size: 16px; margin-bottom: 24px; }
        
        .grid-layout { display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 20px; margin-top: 25px; }
        .resource-box { padding: 24px; background: #fffafb; border: 1px solid #fecdd3; border-radius: 16px; transition: transform 0.2s; }
        .resource-box:hover { transform: translateY(-2px); }
        .resource-box h3 { font-size: 18px; color: #991b1b; margin-bottom: 8px; }
        .resource-box p { font-size: 14px; color: #475569; margin-bottom: 15px; min-height: 60px; }
        
        .action-btn { display: inline-flex; align-items: center; justify-content: center; padding: 10px 18px; color: white; font-weight: 700; font-size: 14px; border-radius: 10px; text-decoration: none; transition: opacity 0.2s; }
        .btn-red { background: linear-gradient(135deg, #dc2626, #ef4444); }
        .btn-dark { background: linear-gradient(135deg, #1e293b, #334155); }
        .btn-blue { background: linear-gradient(135deg, #2563eb, #3b82f6); }
        .action-btn:hover { opacity: 0.9; }
        
        .back-btn { display: inline-block; padding: 11px 20px; color: #dc2626; font-weight: 800; border-radius: 12px; text-decoration: none; border: 2px solid #dc2626; margin-top: 20px; transition: background 0.2s, color 0.2s; }
        .back-btn:hover { background: #dc2626; color: white; }
    </style>
</head>
<body>

<header class="navbar">
    <a href="/" class="brand">Sirius</a>
</header>

<section class="hero">
    <h1>Crisis & Immediate Support</h1>
</section>

<main class="page">
    <div class="card">
        <h2>🚨 Emergency Pipelines & Hotlines</h2>
        <p>
            If you or someone you are supporting is experiencing an immediate mental health crisis, severe distress, or a life-threatening emergency, please utilize the specialized quick-access networks below. Help is available.
        </p>

        <!-- Section 1: Japan Crisis Networks -->
        <h3 style="color: #1e293b; font-size: 20px; margin-top: 20px; border-bottom: 2px solid #f1f5f9; padding-bottom: 8px;">Japan Crisis Support</h3>
        <div class="grid-layout" style="margin-bottom: 35px;">
            
            <div class="resource-box" style="border-color: #cbd5e1;">
                <h3>Japan First Responders</h3>
                <p>National emergency frequencies for immediate dispatch inside Japan. Calls are free from any phone.</p>
                <a href="tel:119" class="action-btn btn-red" style="margin-right: 8px;">🚑 Ambulance: 119</a>
                <a href="tel:110" class="action-btn btn-dark">🚓 Police: 110</a>
            </div>

            <div class="resource-box">
                <h3>TELL Japan Lifeline</h3>
                <p>Free, anonymous, and confidential English-speaking support for individuals experiencing severe emotional distress.</p>
                <a href="tel:0357740992" class="action-btn btn-red" style="margin-bottom: 8px;">📞 Call 03-5774-0992</a>
                <a href="https://telljp.com/lifeline/tell-chat/" target="_blank" class="action-btn btn-blue">💬 Open Text Chat</a>
            </div>

            <div class="resource-box">
                <h3>Yorisoi Hotline (Japan MHLW)</h3>
                <p>Multilingual helpline supported by the Ministry of Health, Labor, and Welfare. Press 2 for foreign language support.</p>
                <a href="tel:0120279338" class="action-btn btn-blue">📞 Call 0120-279-338</a>
            </div>

        </div>

        <!-- Section 2: Temple University Networks -->
        <h3 style="color: #1e293b; font-size: 20px; border-bottom: 2px solid #f1f5f9; padding-bottom: 8px;">Temple Campus Resources</h3>
        <div class="grid-layout">

            <div class="resource-box">
                <h3>TCS After-Hours Crisis Line</h3>
                <p>Temple Tuttleman Counseling Services after-hours intervention link. Call and follow the prompts to reach emergency personnel.</p>
                <a href="tel:2152047276" class="action-btn btn-red">📞 Call 215-204-7276</a>
            </div>

            <div class="resource-box">
                <h3>Campus Safety Services</h3>
                <p>For urgent security issues or immediate on-campus first responder coordination on Temple University grounds.</p>
                <a href="tel:2152041234" class="action-btn btn-dark">📞 Call 215-204-1234</a>
            </div>

        </div>

        <div style="margin-top: 40px; border-top: 1px solid #e2e8f0; padding-top: 20px;">
            <a href="{{ route('resources') }}" class="back-btn">← Back to Resources</a>
        </div>
    </div>
</main>

@include('partials.theme-script')
</body>
</html>