<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Campus Counseling | Sirius</title>
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
        .card p { color: #64748b; line-height: 1.8; font-size: 16px; margin-bottom: 24px; }
        
        .contact-section { margin-top: 30px; display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 20px; }
        .contact-box { padding: 20px; background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 16px; }
        .contact-box h3 { font-size: 18px; color: #1e3a8a; margin-bottom: 8px; }
        .contact-box p { font-size: 14px; color: #475569; margin-bottom: 15px; }
        
        .action-btn { display: inline-flex; align-items: center; justify-content: center; padding: 10px 18px; color: white; font-weight: 700; font-size: 14px; border-radius: 10px; text-decoration: none; margin-right: 10px; transition: opacity 0.2s; }
        .btn-call { background: linear-gradient(135deg, #2563eb, #3b82f6); }
        .btn-email { background: linear-gradient(135deg, #059669, #10b981); }
        .btn-crisis { background: linear-gradient(135deg, #dc2626, #ef4444); }
        .action-btn:hover { opacity: 0.9; }
        
        .back-btn { display: inline-block; padding: 11px 20px; color: #4f46e5; font-weight: 800; border-radius: 12px; text-decoration: none; border: 2px solid #4f46e5; margin-top: 20px; transition: background 0.2s, color 0.2s; }
        .back-btn:hover { background: #4f46e5; color: white; }
    </style>
</head>
<body>

<header class="navbar">
    <a href="/" class="brand">Sirius</a>
</header>

<section class="hero">
    <h1>Campus Counseling Resources</h1>
</section>

<main class="page">
    <div class="card">
        <p>
            University counseling services are here to support your personal growth and mental wellness journey. 
            Through Tuttleman Counseling Services (TCS), Temple students can access confidential short-term individual therapy, 
            group support, and crisis assistance free of charge.
        </p>

        <div class="contact-section">
            
            <div class="contact-box">
                <h3>Tuttleman Counseling Services (TCS)</h3>
                <p>Main mental health support pipeline for appointments, consultations, and intake triage requests.</p>
                <a href="tel:2152047276" class="action-btn btn-call">📞 Call 215-204-7276</a>
            </div>

            <div class="contact-box" style="border-color: #fca5a5;">
                <h3>TCS After-Hours Crisis Line</h3>
                <p>Available when the standard office is closed. Call and press "1" to reach a mental health professional.</p>
                <a href="tel:2152047276" class="action-btn btn-crisis">🚨 Call After-Hours Support</a>
            </div>

            <div class="contact-box">
                <h3>Wellness Resource Center (WRC)</h3>
                <p>Reach out for non-confidential public support inquiries, health strategies, or standard peer education questions.</p>
                <a href="tel:2152048436" class="action-btn btn-call" style="margin-bottom: 8px;">📞 Call 215-204-8436</a>
                <a href="mailto:TUWellness@temple.edu" class="action-btn btn-email">✉️ Email Wellness Team</a>
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