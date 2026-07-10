<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Privacy Policy | Sirius</title>
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; font-family: Arial, Helvetica, sans-serif; }
        body { min-height: 100vh; background: linear-gradient(180deg, #eef4ff 0%, #f8fbff 48%, #f7f4ff 100%); color: #1f2937; transition: background 0.3s ease, color 0.3s ease; }
        .wrap { max-width: 900px; margin: 0 auto; padding: 60px 24px 80px; }
        .card { background: rgba(255,255,255,0.96); border: 1px solid rgba(226,232,240,0.9); border-radius: 24px; box-shadow: 0 20px 52px rgba(30,41,59,0.1); padding: 36px; }
        h1 { font-size: 34px; color: #111827; margin-bottom: 14px; }
        h2 { font-size: 18px; margin-top: 18px; margin-bottom: 8px; color: #111827; }
        p, li { line-height: 1.8; color: #475569; }
        ul { padding-left: 20px; margin-top: 8px; }
        .back { display: inline-block; margin-top: 24px; padding: 11px 16px; text-decoration: none; border-radius: 999px; background: linear-gradient(135deg, #6366f1, #4f46e5); color: white; font-weight: 700; }

        /* Dark Mode Utility Overrides */
        body.dark-mode {
            background: radial-gradient(circle at 10% 8%, rgba(55, 48, 163, 0.4), transparent 25%),
                        radial-gradient(circle at 91% 17%, rgba(30, 58, 138, 0.5), transparent 28%),
                        linear-gradient(180deg, #0f1a3a 0%, #1a1a40 48%, #1f1a35 100%);
            color: #e5e7eb;
        }
        body.dark-mode .card {
            background: rgba(30, 41, 59, 0.85);
            border-color: rgba(71, 85, 105, 0.5);
            box-shadow: 0 20px 52px rgba(0,0,0,0.3);
        }
        body.dark-mode h1, body.dark-mode h2 {
            color: #f1f5f9;
        }
        body.dark-mode p, body.dark-mode li {
            color: #cbd5e1;
        }
    </style>
</head>
<body>
    <div class="wrap">
        <div class="card">
            <h1>Privacy Policy</h1>
            <p>Your privacy matters to us. Sirius is designed to support your wellbeing while respecting your personal boundaries.</p>
            <h2>What We Collect</h2>
            <p>We may collect account information, mood and journal entries, and other content you voluntarily share while using the platform.</p>
            <h2>How We Use It</h2>
            <p>We use this information to provide your experience, personalize features, and improve the platform’s wellbeing tools.</p>
            <h2>Your Control</h2>
            <p>You can choose what you share and update your account details at any time.</p>
            <a href="/" class="back">Back home</a>
        </div>
    </div>
    
@include('partials.theme-script')
</body>
</html>