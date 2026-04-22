<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Password – RYB Vehicle Trading</title>
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=DM+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        :root {
            --black:    #0a0a0a;
            --charcoal: #2e2828;
            --red:      #c0392b;
            --red-bright: #e74c3c;
            --offwhite: #f5ede8;
            --yellow:   #f5c518;
            --glass-bg: rgba(46,40,40,0.55);
            --glass-border: rgba(245,197,24,0.18);
            --text-muted: rgba(245,237,232,0.5);
        }

        body {
            min-height: 100vh;
            background: var(--black);
            font-family: 'DM Sans', sans-serif;
            color: var(--offwhite);
            display: flex;
            align-items: center;
            justify-content: center;
        }

        body::before {
            content: '';
            position: fixed; inset: 0;
            background:
                radial-gradient(ellipse 60% 50% at 50% 0%, rgba(192,57,43,0.18) 0%, transparent 60%),
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

        .container {
            position: relative; z-index: 1;
            width: 100%; max-width: 460px; padding: 20px;
        }

        .back-link {
            display: inline-flex; align-items: center; gap: 8px;
            color: var(--text-muted); text-decoration: none;
            font-size: 12px; letter-spacing: 1px; text-transform: uppercase;
            margin-bottom: 28px; transition: color 0.2s;
        }

        .back-link svg { width: 14px; height: 14px; stroke: currentColor; fill: none; stroke-width: 2; stroke-linecap: round; stroke-linejoin: round; transition: transform 0.2s; }
        .back-link:hover { color: var(--yellow); }
        .back-link:hover svg { transform: translateX(-3px); }

        .card {
            background: var(--glass-bg);
            backdrop-filter: blur(24px);
            -webkit-backdrop-filter: blur(24px);
            border: 1px solid var(--glass-border);
            border-radius: 16px;
            padding: 44px 40px;
            animation: fadeUp 0.7s cubic-bezier(0.22,1,0.36,1) both;
        }

        @keyframes fadeUp {
            from { opacity: 0; transform: translateY(30px); }
            to   { opacity: 1; transform: translateY(0); }
        }

        .wordmark {
            text-align: center;
            font-family: 'Bebas Neue', sans-serif;
            font-size: 14px;
            letter-spacing: 3px;
            color: var(--text-muted);
            margin-bottom: 24px;
        }

        .wordmark span { color: var(--red); }

        .steps {
            display: flex;
            justify-content: center;
            gap: 8px;
            margin-bottom: 28px;
        }

        .step {
            display: flex; align-items: center; gap: 6px;
            font-size: 11px; color: var(--text-muted);
        }

        .step-dot {
            width: 22px; height: 22px; border-radius: 50%;
            background: rgba(245,237,232,0.08);
            border: 1px solid rgba(245,237,232,0.15);
            display: flex; align-items: center; justify-content: center;
            font-size: 10px; font-weight: 600;
        }

        .step.done .step-dot {
            background: rgba(39,174,96,0.2);
            border-color: #2ecc71;
            color: #2ecc71;
        }

        .step.active .step-dot { background: var(--red); border-color: var(--red); color: white; }
        .step.active { color: var(--offwhite); }

        .step-line { width: 28px; height: 1px; background: rgba(245,237,232,0.15); }

        .icon-circle {
            width: 72px; height: 72px;
            background: rgba(245,197,24,0.08);
            border: 1px solid rgba(245,197,24,0.25);
            border-radius: 50%;
            display: flex; align-items: center; justify-content: center;
            margin: 0 auto 28px;
        }

        .icon-circle svg {
            width: 30px; height: 30px;
            stroke: var(--yellow); fill: none;
            stroke-width: 1.5; stroke-linecap: round; stroke-linejoin: round;
        }

        .card-header { text-align: center; margin-bottom: 32px; }

        .form-eyebrow {
            font-size: 10px; letter-spacing: 3px;
            text-transform: uppercase; color: var(--yellow); margin-bottom: 10px;
        }

        .form-title {
            font-family: 'Bebas Neue', sans-serif;
            font-size: 38px; letter-spacing: 1px;
            color: var(--offwhite); line-height: 1;
        }

        .form-desc { font-size: 13px; color: var(--text-muted); margin-top: 10px; line-height: 1.7; }

        label {
            display: block;
            font-size: 10px; letter-spacing: 2px;
            text-transform: uppercase; color: var(--text-muted); margin-bottom: 7px;
        }

        .field-group { margin-bottom: 20px; }

        .input-wrap {
            position: relative; display: flex; align-items: center;
        }

        .input-wrap .icon {
            position: absolute; left: 13px;
            width: 15px; height: 15px;
            stroke: var(--text-muted); fill: none;
            stroke-width: 1.5; stroke-linecap: round; stroke-linejoin: round;
            pointer-events: none; transition: stroke 0.2s; z-index: 1;
        }

        .input-wrap:focus-within .icon { stroke: var(--yellow); }

        .toggle-pw {
            position: absolute; right: 13px;
            background: none; border: none; cursor: pointer;
            display: flex; align-items: center;
            padding: 4px;
        }

        .toggle-pw svg {
            width: 15px; height: 15px;
            stroke: var(--text-muted); fill: none;
            stroke-width: 1.5; stroke-linecap: round; stroke-linejoin: round;
        }

        input[type="password"], input[type="text"] {
            width: 100%;
            background: rgba(10,10,10,0.6);
            border: 1px solid rgba(245,237,232,0.12);
            border-radius: 6px;
            padding: 12px 40px 12px 38px;
            color: var(--offwhite);
            font-family: 'DM Sans', sans-serif;
            font-size: 14px;
            transition: border-color 0.2s, box-shadow 0.2s;
            outline: none;
        }

        input:focus {
            border-color: var(--yellow);
            box-shadow: 0 0 0 3px rgba(245,197,24,0.1);
        }

        /* Match indicator */
        .match-indicator {
            display: flex; align-items: center; gap: 6px;
            margin-top: 6px;
            font-size: 11px;
            opacity: 0;
            transition: opacity 0.3s;
        }

        .match-indicator.visible { opacity: 1; }
        .match-indicator.match   { color: #2ecc71; }
        .match-indicator.no-match { color: var(--red-bright); }

        .match-dot { width: 6px; height: 6px; border-radius: 50%; background: currentColor; }

        .strength-bar { display: flex; gap: 4px; margin-top: 6px; }
        .strength-seg { height: 3px; flex: 1; background: rgba(245,237,232,0.1); border-radius: 2px; transition: background 0.3s; }
        .strength-seg.weak   { background: var(--red); }
        .strength-seg.medium { background: var(--yellow); }
        .strength-seg.strong { background: #2ecc71; }

        .btn-primary {
            width: 100%;
            background: var(--red); border: none; border-radius: 6px;
            padding: 14px; color: var(--offwhite);
            font-family: 'Bebas Neue', sans-serif;
            font-size: 18px; letter-spacing: 2px;
            cursor: pointer; position: relative; overflow: hidden;
            transition: background 0.2s, transform 0.15s;
            margin-top: 8px;
        }

        .btn-primary::before {
            content: ''; position: absolute; inset: 0;
            background: linear-gradient(90deg, transparent 0%, rgba(255,255,255,0.08) 50%, transparent 100%);
            transform: translateX(-100%); transition: transform 0.5s;
        }

        .btn-primary:hover { background: var(--red-bright); transform: translateY(-1px); }
        .btn-primary:hover::before { transform: translateX(100%); }

        .alert {
            padding: 11px 14px; border-radius: 6px;
            font-size: 12px; margin-bottom: 18px; border-left: 3px solid;
        }

        .alert-error { background: rgba(192,57,43,0.15); border-color: var(--red); color: #ff8a80; }
    </style>
</head>
<body>

<div class="container">

    <a href="{{ route('login') }}" class="back-link">
        <svg viewBox="0 0 24 24"><polyline points="15 18 9 12 15 6"/></svg>
        Back to Login
    </a>

    <div class="card">

        <p class="wordmark">RYB <span>•</span> VEHICLE TRADING</p>

        <div class="steps">
            <div class="step done">
                <div class="step-dot">✓</div>
                <span>Email</span>
            </div>
            <div class="step-line"></div>
            <div class="step done">
                <div class="step-dot">✓</div>
                <span>Verified</span>
            </div>
            <div class="step-line"></div>
            <div class="step active">
                <div class="step-dot">3</div>
                <span>New password</span>
            </div>
        </div>

        <div class="icon-circle">
            <svg viewBox="0 0 24 24">
                <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/>
            </svg>
        </div>

        <div class="card-header">
            <p class="form-eyebrow">Almost Done</p>
            <h1 class="form-title">New Password</h1>
            <p class="form-desc">Choose a strong password to secure your account.</p>
        </div>

        @if ($errors->any())
        <div class="alert alert-error">{{ $errors->first() }}</div>
        @endif

        <form method="POST" action="{{ route('password.update') }}">
            @csrf
            <input type="hidden" name="token" value="{{ $token }}">

            <div class="field-group">
                <label for="email">Email Address</label>
                <div class="input-wrap">
                    <svg class="icon" viewBox="0 0 24 24"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>
                    <input type="text" id="email" name="email" value="{{ old('email', $email ?? '') }}" required readonly placeholder="your@email.com" style="cursor:default; opacity:0.6;">
                </div>
            </div>

            <div class="field-group">
                <label for="password">New Password</label>
                <div class="input-wrap">
                    <svg class="icon" viewBox="0 0 24 24"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"/><path d="M7 11V7a5 5 0 0110 0v4"/></svg>
                    <input type="password" id="password" name="password" required placeholder="••••••••" autocomplete="new-password" oninput="checkStrength(this.value); checkMatch()">
                    <button type="button" class="toggle-pw" onclick="toggleVis('password', this)">
                        <svg viewBox="0 0 24 24" id="eye-pw"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>
                    </button>
                </div>
                <div class="strength-bar">
                    <div class="strength-seg" id="s1"></div>
                    <div class="strength-seg" id="s2"></div>
                    <div class="strength-seg" id="s3"></div>
                    <div class="strength-seg" id="s4"></div>
                </div>
            </div>

            <div class="field-group">
                <label for="password_confirmation">Confirm New Password</label>
                <div class="input-wrap">
                    <svg class="icon" viewBox="0 0 24 24"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
                    <input type="password" id="password_confirmation" name="password_confirmation" required placeholder="••••••••" autocomplete="new-password" oninput="checkMatch()">
                    <button type="button" class="toggle-pw" onclick="toggleVis('password_confirmation', this)">
                        <svg viewBox="0 0 24 24"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>
                    </button>
                </div>
                <div class="match-indicator" id="match-msg">
                    <div class="match-dot"></div>
                    <span id="match-text"></span>
                </div>
            </div>

            <button type="submit" class="btn-primary">Set New Password</button>
        </form>

    </div>

</div>

<script>
function checkStrength(val) {
    const segs = ['s1','s2','s3','s4'].map(id => document.getElementById(id));
    segs.forEach(s => s.className = 'strength-seg');
    if (!val) return;
    let score = 0;
    if (val.length >= 8) score++;
    if (/[A-Z]/.test(val)) score++;
    if (/[0-9]/.test(val)) score++;
    if (/[^A-Za-z0-9]/.test(val)) score++;
    const cls = score <= 1 ? 'weak' : score <= 2 ? 'medium' : 'strong';
    for (let i = 0; i < score; i++) segs[i].classList.add(cls);
}

function checkMatch() {
    const pw = document.getElementById('password').value;
    const conf = document.getElementById('password_confirmation').value;
    const msg = document.getElementById('match-msg');
    const txt = document.getElementById('match-text');
    if (!conf) { msg.className = 'match-indicator'; return; }
    if (pw === conf) {
        msg.className = 'match-indicator visible match';
        txt.textContent = 'Passwords match';
    } else {
        msg.className = 'match-indicator visible no-match';
        txt.textContent = 'Passwords do not match';
    }
}

function toggleVis(id, btn) {
    const input = document.getElementById(id);
    input.type = input.type === 'password' ? 'text' : 'password';
    btn.querySelector('svg').style.opacity = input.type === 'text' ? '0.4' : '1';
}
</script>

</body>
</html>