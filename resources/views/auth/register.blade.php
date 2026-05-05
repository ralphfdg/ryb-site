<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register – RYB Vehicle Trading</title>
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=DM+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        :root {
            --black:   #0a0a0a;
            --charcoal: #2e2828;
            --red:     #c0392b;
            --red-bright: #e74c3c;
            --offwhite: #f5ede8;
            --yellow:  #EEDF7A; /* Applied correct branding hex */
            --glass-bg: rgba(46,40,40,0.55);
            --glass-border: rgba(238, 223, 122, 0.18);
            --text-muted: rgba(245,237,232,0.5);
        }

        body {
            min-height: 100vh;
            background: var(--black);
            font-family: 'DM Sans', sans-serif;
            color: var(--offwhite);
            display: flex;
            align-items: stretch;
            overflow-x: hidden;
        }

        body::before {
            content: '';
            position: fixed; inset: 0;
            background:
                radial-gradient(ellipse 70% 50% at 80% 10%, rgba(192,57,43,0.15) 0%, transparent 55%),
                radial-gradient(ellipse 50% 70% at 10% 85%, rgba(238, 223, 122, 0.06) 0%, transparent 50%),
                #0a0a0a;
            z-index: 0;
        }

        body::after {
            content: '';
            position: fixed; inset: 0;
            background-image: repeating-linear-gradient(
                -45deg, transparent, transparent 60px,
                rgba(255,255,255,0.012) 60px, rgba(255,255,255,0.012) 61px
            );
            z-index: 0;
        }

        .page-wrapper {
            position: relative; z-index: 1;
            width: 100%;
            display: flex;
            align-items: stretch;
            min-height: 100vh;
        }

        /* Right branding panel */
        .brand-panel {
            flex: 1;
            display: flex;
            flex-direction: column;
            justify-content: center;
            padding: 60px 70px;
            border-left: 1px solid rgba(238, 223, 122, 0.1);
            order: 2;
            animation: slideInRight 0.8s cubic-bezier(0.22,1,0.36,1) both;
        }

        @keyframes slideInRight {
            from { opacity: 0; transform: translateX(40px); }
            to   { opacity: 1; transform: translateX(0); }
        }
        @keyframes slideInLeft {
            from { opacity: 0; transform: translateX(-40px); }
            to   { opacity: 1; transform: translateX(0); }
        }

        .brand-tag {
            font-family: 'Bebas Neue', sans-serif;
            font-size: 11px;
            letter-spacing: 4px;
            color: var(--yellow);
            margin-bottom: 24px;
        }

        .brand-logo {
            font-family: 'Bebas Neue', sans-serif;
            font-size: clamp(56px, 7vw, 100px);
            line-height: 0.9;
            color: var(--offwhite);
            margin-bottom: 32px;
        }

        .brand-logo span { color: var(--red); display: block; }

        .perks-list { list-style: none; margin-top: 32px; }

        .perks-list li {
            display: flex;
            align-items: flex-start;
            gap: 14px;
            margin-bottom: 20px;
            font-size: 14px;
            color: var(--text-muted);
            line-height: 1.5;
        }

        .perk-icon {
            width: 28px; height: 28px;
            background: rgba(238, 223, 122, 0.1);
            border: 1px solid rgba(238, 223, 122, 0.25);
            border-radius: 6px;
            display: flex; align-items: center; justify-content: center;
            flex-shrink: 0;
        }

        .perk-icon svg {
            width: 14px; height: 14px;
            stroke: var(--yellow); fill: none;
            stroke-width: 2; stroke-linecap: round; stroke-linejoin: round;
        }

        /* Form panel */
        .form-panel {
            width: 520px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            padding: 50px 56px;
            background: var(--glass-bg);
            backdrop-filter: blur(24px);
            -webkit-backdrop-filter: blur(24px);
            border-right: 1px solid var(--glass-border);
            order: 1;
            animation: slideInLeft 0.8s 0.1s cubic-bezier(0.22,1,0.36,1) both;
            overflow-y: auto;
        }

        .form-header { margin-bottom: 32px; }

        .back-btn {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            color: var(--text-muted);
            text-decoration: none;
            font-size: 13px;
            font-weight: 500;
            margin-bottom: 24px;
            transition: color 0.2s;
        }

        .back-btn:hover { color: var(--yellow); }

        .back-btn svg {
            width: 16px; height: 16px;
            stroke: currentColor; stroke-width: 2; fill: none;
            stroke-linecap: round; stroke-linejoin: round;
        }

        .form-eyebrow {
            font-size: 10px;
            letter-spacing: 3px;
            text-transform: uppercase;
            color: var(--yellow);
            margin-bottom: 10px;
        }

        .form-title {
            font-family: 'Bebas Neue', sans-serif;
            font-size: 42px;
            letter-spacing: 1px;
            color: var(--offwhite);
            line-height: 1;
        }

        .form-subtitle {
            font-size: 13px;
            color: var(--text-muted);
            margin-top: 8px;
        }

        /* Two-column grid */
        .fields-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 16px 20px;
        }

        .field-full { grid-column: 1 / -1; }

        .field-group { margin-bottom: 0; }

        label {
            display: block;
            font-size: 10px;
            letter-spacing: 2px;
            text-transform: uppercase;
            color: var(--text-muted);
            margin-bottom: 7px;
        }

        .input-wrap {
            position: relative;
            display: flex;
            align-items: center;
        }

        .input-wrap .icon {
            position: absolute;
            left: 13px;
            width: 15px; height: 15px;
            stroke: var(--text-muted);
            fill: none;
            stroke-width: 1.5;
            stroke-linecap: round; stroke-linejoin: round;
            pointer-events: none;
            transition: stroke 0.2s;
            z-index: 1;
        }

        input[type="email"],
        input[type="password"],
        input[type="text"],
        input[type="tel"],
        select {
            width: 100%;
            background: rgba(10,10,10,0.6);
            border: 1px solid rgba(245,237,232,0.12);
            border-radius: 6px;
            padding: 12px 12px 12px 38px;
            color: var(--offwhite);
            font-family: 'DM Sans', sans-serif;
            font-size: 14px;
            transition: border-color 0.2s, box-shadow 0.2s;
            outline: none;
        }

        select {
            appearance: none;
            cursor: pointer;
        }

        input:focus, select:focus {
            border-color: var(--yellow);
            box-shadow: 0 0 0 3px rgba(238, 223, 122, 0.1);
        }

        .input-wrap:focus-within .icon { stroke: var(--yellow); }

        /* Password strength */
        .strength-bar {
            display: flex;
            gap: 4px;
            margin-top: 6px;
        }

        .strength-seg {
            height: 3px;
            flex: 1;
            background: rgba(245,237,232,0.1);
            border-radius: 2px;
            transition: background 0.3s;
        }

        .strength-seg.weak   { background: var(--red); }
        .strength-seg.medium { background: var(--yellow); }
        .strength-seg.strong { background: #2ecc71; }

        .strength-label {
            font-size: 10px;
            color: var(--text-muted);
            margin-top: 4px;
            text-align: right;
            transition: color 0.3s;
        }

        /* Terms */
        .terms-wrap {
            display: flex;
            align-items: flex-start;
            gap: 10px;
            margin: 20px 0;
        }

        .terms-wrap input[type="checkbox"] {
            width: 15px; height: 15px;
            margin-top: 2px;
            accent-color: var(--yellow);
            padding: 0; flex-shrink: 0;
        }

        .terms-wrap span {
            font-size: 12px;
            color: var(--text-muted);
            line-height: 1.6;
        }

        .terms-wrap a { color: var(--yellow); text-decoration: none; }
        .terms-wrap a:hover { text-decoration: underline; }

        /* Button */
        .btn-primary {
            width: 100%;
            background: var(--red);
            border: none;
            border-radius: 6px;
            padding: 14px;
            color: var(--offwhite);
            font-family: 'Bebas Neue', sans-serif;
            font-size: 18px;
            letter-spacing: 2px;
            cursor: pointer;
            position: relative;
            overflow: hidden;
            transition: background 0.2s, transform 0.15s;
        }

        .btn-primary::before {
            content: '';
            position: absolute; inset: 0;
            background: linear-gradient(90deg, transparent 0%, rgba(255,255,255,0.08) 50%, transparent 100%);
            transform: translateX(-100%);
            transition: transform 0.5s;
        }

        .btn-primary:hover { background: var(--red-bright); transform: translateY(-1px); }
        .btn-primary:hover::before { transform: translateX(100%); }
        .btn-primary:active { transform: translateY(0); }

        .login-link-wrap {
            text-align: center;
            font-size: 13px;
            color: var(--text-muted);
            margin-top: 20px;
        }

        .login-link-wrap a {
            color: var(--yellow);
            text-decoration: none;
            font-weight: 600;
        }

        .login-link-wrap a:hover { color: var(--offwhite); }

        .alert {
            padding: 11px 14px;
            border-radius: 6px;
            font-size: 12px;
            margin-bottom: 18px;
            border-left: 3px solid;
        }

        .alert-error { background: rgba(192,57,43,0.15); border-color: var(--red); color: #ff8a80; }

        @media (max-width: 960px) {
            .brand-panel { display: none; }
            .form-panel { width: 100%; border-right: none; order: 1; }
        }

        @media (max-width: 520px) {
            .form-panel { padding: 40px 24px; }
            .fields-grid { grid-template-columns: 1fr; }
        }
    </style>
</head>
<body>

<div class="page-wrapper">

    <!-- Left Form Panel -->
    <div class="form-panel">
        <div class="form-header">
            <!-- Back to Home Button -->
            <a href="{{ route('home') }}" class="back-btn">
                <svg viewBox="0 0 24 24"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>
                Back to Home
            </a>
            <p class="form-eyebrow">New Account</p>
            <h2 class="form-title">Create Account</h2>
            <p class="form-subtitle">Join RYB and start browsing our fleet</p>
        </div>

        @if ($errors->any())
        <div class="alert alert-error">
            <ul style="list-style:none;">
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <div class="fields-grid">

                <div class="field-group field-full">
                    <label for="name">Full Name</label>
                    <div class="input-wrap">
                        <svg class="icon" viewBox="0 0 24 24"><circle cx="12" cy="8" r="4"/><path d="M4 20c0-4 3.6-7 8-7s8 3 8 7"/></svg>
                        <input type="text" id="name" name="name" value="{{ old('name') }}" required placeholder="Juan dela Cruz" autocomplete="name">
                    </div>
                </div>

                <div class="field-group field-full">
                    <label for="email">Email Address</label>
                    <div class="input-wrap">
                        <svg class="icon" viewBox="0 0 24 24"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>
                        <input type="email" id="email" name="email" value="{{ old('email') }}" required placeholder="you@email.com" autocomplete="email">
                    </div>
                </div>

                <div class="field-group field-full">
                    <label for="phone_number">Phone Number</label>
                    <div class="input-wrap">
                        <svg class="icon" viewBox="0 0 24 24"><path d="M22 16.92v3a2 2 0 01-2.18 2 19.79 19.79 0 01-8.63-3.07A19.5 19.5 0 013.07 9.82 19.79 19.79 0 01.06 1.18C.07.6.51.08 1.12.07L4.09 0a2 2 0 012 1.72 12.84 12.84 0 00.7 2.81 2 2 0 01-.45 2.11L5.09 7.91a16 16 0 006.29 6.29l1.27-1.27a2 2 0 012.11-.45 12.84 12.84 0 002.81.7A2 2 0 0122 16.92z"/></svg>
                        <input type="tel" id="phone_number" name="phone_number" value="{{ old('phone_number') }}" placeholder="09XX XXX XXXX">
                    </div>
                </div>

                <div class="field-group">
                    <label for="password">Password</label>
                    <div class="input-wrap">
                        <svg class="icon" viewBox="0 0 24 24"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"/><path d="M7 11V7a5 5 0 0110 0v4"/></svg>
                        <input type="password" id="password" name="password" required placeholder="••••••••" autocomplete="new-password" oninput="checkStrength(this.value)">
                    </div>
                    <div class="strength-bar">
                        <div class="strength-seg" id="s1"></div>
                        <div class="strength-seg" id="s2"></div>
                        <div class="strength-seg" id="s3"></div>
                        <div class="strength-seg" id="s4"></div>
                    </div>
                    <div class="strength-label" id="strength-label"></div>
                </div>

                <div class="field-group">
                    <label for="password_confirmation">Confirm Password</label>
                    <div class="input-wrap">
                        <svg class="icon" viewBox="0 0 24 24"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
                        <input type="password" id="password_confirmation" name="password_confirmation" required placeholder="••••••••" autocomplete="new-password">
                    </div>
                </div>

            </div>

            <div class="terms-wrap">
                <input type="checkbox" id="terms" name="terms" required>
                <span>I agree to the <a href="#">Terms of Service</a> and <a href="#">Privacy Policy</a> of RYB Vehicle Trading</span>
            </div>

            <button type="submit" class="btn-primary">Create My Account</button>
        </form>

        <div class="login-link-wrap">
            Already have an account? <a href="{{ route('login') }}">Sign in here</a>
        </div>
    </div>

    <!-- Right Branding Panel -->
    <div class="brand-panel">
        <p class="brand-tag">Start Your Journey</p>
        <h1 class="brand-logo">
            RYB
            <span>Vehicle</span>
            Trading
        </h1>

        <ul class="perks-list">
            <li>
                <div class="perk-icon">
                    <svg viewBox="0 0 24 24"><path d="M21 16V8a2 2 0 00-1-1.73l-7-4a2 2 0 00-2 0l-7 4A2 2 0 003 8v8a2 2 0 001 1.73l7 4a2 2 0 002 0l7-4A2 2 0 0021 16z"/></svg>
                </div>
                <span>Browse our full catalog of available vehicles with real-time availability status</span>
            </li>
            <li>
                <div class="perk-icon">
                    <svg viewBox="0 0 24 24"><path d="M20.84 4.61a5.5 5.5 0 00-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 00-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 000-7.78z"/></svg>
                </div>
                <span>Save your favorite cars and track inquiries directly from your profile</span>
            </li>
            <li>
                <div class="perk-icon">
                    <svg viewBox="0 0 24 24"><path d="M22 16.92v3a2 2 0 01-2.18 2 19.79 19.79 0 01-8.63-3.07A19.5 19.5 0 013.07 9.82"/></svg>
                </div>
                <span>Send inquiries directly to our team and get fast responses on any vehicle</span>
            </li>
            <li>
                <div class="perk-icon">
                    <svg viewBox="0 0 24 24"><polyline points="20 6 9 17 4 12"/></svg>
                </div>
                <span>Secure, verified transactions with full purchase history tracking</span>
            </li>
        </ul>
    </div>

</div>

<script>
function checkStrength(val) {
    const segs = [document.getElementById('s1'), document.getElementById('s2'), document.getElementById('s3'), document.getElementById('s4')];
    const label = document.getElementById('strength-label');
    segs.forEach(s => { s.className = 'strength-seg'; });

    if (!val) { label.textContent = ''; return; }

    let score = 0;
    if (val.length >= 8) score++;
    if (/[A-Z]/.test(val)) score++;
    if (/[0-9]/.test(val)) score++;
    if (/[^A-Za-z0-9]/.test(val)) score++;

    const cls = score <= 1 ? 'weak' : score <= 2 ? 'medium' : 'strong';
    const labels = ['', 'Weak', 'Weak', 'Medium', 'Strong'];
    // Updated medium color map to match UI scheme
    const colors = { weak: '#e74c3c', medium: '#EEDF7A', strong: '#2ecc71' };

    for (let i = 0; i < score; i++) segs[i].classList.add(cls);
    label.textContent = labels[score];
    label.style.color = colors[cls];
}
</script>

</body>
</html>