<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password – RYB Vehicle Trading</title>
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
            overflow: hidden;
        }

        body::before {
            content: '';
            position: fixed; inset: 0;
            background:
                radial-gradient(ellipse 60% 60% at 50% 0%, rgba(192,57,43,0.2) 0%, transparent 60%),
                radial-gradient(ellipse 80% 60% at 50% 100%, rgba(245,197,24,0.05) 0%, transparent 50%),
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
            width: 100%;
            max-width: 480px;
            padding: 20px;
        }

        /* Back link */
        .back-link {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            color: var(--text-muted);
            text-decoration: none;
            font-size: 12px;
            letter-spacing: 1px;
            text-transform: uppercase;
            margin-bottom: 32px;
            transition: color 0.2s;
        }

        .back-link svg {
            width: 14px; height: 14px;
            stroke: currentColor; fill: none;
            stroke-width: 2; stroke-linecap: round; stroke-linejoin: round;
            transition: transform 0.2s;
        }

        .back-link:hover { color: var(--yellow); }
        .back-link:hover svg { transform: translateX(-3px); }

        /* Card */
        .card {
            background: var(--glass-bg);
            backdrop-filter: blur(24px);
            -webkit-backdrop-filter: blur(24px);
            border: 1px solid var(--glass-border);
            border-radius: 16px;
            padding: 48px 44px;
            animation: fadeUp 0.7s cubic-bezier(0.22,1,0.36,1) both;
        }

        @keyframes fadeUp {
            from { opacity: 0; transform: translateY(30px); }
            to   { opacity: 1; transform: translateY(0); }
        }

        /* Lock icon illustration */
        .icon-circle {
            width: 72px; height: 72px;
            background: rgba(192,57,43,0.12);
            border: 1px solid rgba(192,57,43,0.3);
            border-radius: 50%;
            display: flex; align-items: center; justify-content: center;
            margin: 0 auto 28px;
        }

        .icon-circle svg {
            width: 32px; height: 32px;
            stroke: var(--red-bright); fill: none;
            stroke-width: 1.5; stroke-linecap: round; stroke-linejoin: round;
        }

        .card-header { text-align: center; margin-bottom: 32px; }

        .form-eyebrow {
            font-size: 10px;
            letter-spacing: 3px;
            text-transform: uppercase;
            color: var(--yellow);
            margin-bottom: 10px;
        }

        .form-title {
            font-family: 'Bebas Neue', sans-serif;
            font-size: 38px;
            letter-spacing: 1px;
            color: var(--offwhite);
            line-height: 1;
        }

        .form-desc {
            font-size: 13px;
            color: var(--text-muted);
            margin-top: 10px;
            line-height: 1.7;
        }

        label {
            display: block;
            font-size: 10px;
            letter-spacing: 2px;
            text-transform: uppercase;
            color: var(--text-muted);
            margin-bottom: 8px;
        }

        .input-wrap {
            position: relative;
            display: flex;
            align-items: center;
            margin-bottom: 24px;
        }

        .input-wrap svg {
            position: absolute;
            left: 13px;
            width: 16px; height: 16px;
            stroke: var(--text-muted); fill: none;
            stroke-width: 1.5; stroke-linecap: round; stroke-linejoin: round;
            pointer-events: none;
            transition: stroke 0.2s;
        }

        input[type="email"] {
            width: 100%;
            background: rgba(10,10,10,0.6);
            border: 1px solid rgba(245,237,232,0.12);
            border-radius: 6px;
            padding: 13px 13px 13px 42px;
            color: var(--offwhite);
            font-family: 'DM Sans', sans-serif;
            font-size: 14px;
            transition: border-color 0.2s, box-shadow 0.2s;
            outline: none;
        }

        input[type="email"]:focus {
            border-color: var(--yellow);
            box-shadow: 0 0 0 3px rgba(245,197,24,0.1);
        }

        .input-wrap:focus-within svg { stroke: var(--yellow); }

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

        .divider {
            display: flex; align-items: center; gap: 12px;
            margin: 24px 0;
        }

        .divider::before, .divider::after {
            content: ''; flex: 1; height: 1px;
            background: rgba(245,237,232,0.1);
        }

        .divider span { font-size: 11px; color: var(--text-muted); }

        .help-text {
            text-align: center;
            font-size: 12px;
            color: var(--text-muted);
            line-height: 1.7;
        }

        .help-text a {
            color: var(--yellow);
            text-decoration: none;
        }

        .help-text a:hover { text-decoration: underline; }

        /* Alert for status message */
        .alert {
            padding: 12px 16px;
            border-radius: 6px;
            font-size: 13px;
            margin-bottom: 20px;
            border-left: 3px solid;
            text-align: left;
        }

        .alert-success { background: rgba(39,174,96,0.12); border-color: #2ecc71; color: #a8f0c6; }
        .alert-error   { background: rgba(192,57,43,0.15); border-color: var(--red); color: #ff8a80; }

        /* Step indicator */
        .steps {
            display: flex;
            justify-content: center;
            gap: 8px;
            margin-bottom: 28px;
        }

        .step {
            display: flex;
            align-items: center;
            gap: 6px;
            font-size: 11px;
            color: var(--text-muted);
        }

        .step-dot {
            width: 22px; height: 22px;
            border-radius: 50%;
            background: rgba(245,237,232,0.08);
            border: 1px solid rgba(245,237,232,0.15);
            display: flex; align-items: center; justify-content: center;
            font-size: 10px;
            font-weight: 600;
        }

        .step.active .step-dot {
            background: var(--red);
            border-color: var(--red);
            color: white;
        }

        .step.active { color: var(--offwhite); }

        .step-line {
            width: 28px; height: 1px;
            background: rgba(245,237,232,0.15);
        }

        /* Branding wordmark */
        .wordmark {
            text-align: center;
            font-family: 'Bebas Neue', sans-serif;
            font-size: 16px;
            letter-spacing: 3px;
            color: var(--text-muted);
            margin-bottom: 24px;
        }

        .wordmark span { color: var(--red); }
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

        <!-- Step indicator -->
        <div class="steps">
            <div class="step active">
                <div class="step-dot">1</div>
                <span>Email</span>
            </div>
            <div class="step-line"></div>
            <div class="step">
                <div class="step-dot">2</div>
                <span>Check inbox</span>
            </div>
            <div class="step-line"></div>
            <div class="step">
                <div class="step-dot">3</div>
                <span>New password</span>
            </div>
        </div>

        <div class="icon-circle">
            <svg viewBox="0 0 24 24">
                <rect x="3" y="11" width="18" height="11" rx="2" ry="2"/>
                <path d="M7 11V7a5 5 0 0110 0v4"/>
            </svg>
        </div>

        <div class="card-header">
            <p class="form-eyebrow">Account Recovery</p>
            <h1 class="form-title">Reset Password</h1>
            <p class="form-desc">
                Enter the email address linked to your account and we'll send you a reset link.
            </p>
        </div>

        @if (session('status'))
        <div class="alert alert-success">
            ✓ &nbsp;{{ session('status') }}
        </div>
        @endif

        @if ($errors->any())
        <div class="alert alert-error">
            {{ $errors->first() }}
        </div>
        @endif

        <form method="POST" action="{{ route('password.email') }}">
            @csrf

            <label for="email">Your Email Address</label>
            <div class="input-wrap">
                <svg viewBox="0 0 24 24">
                    <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/>
                    <polyline points="22,6 12,13 2,6"/>
                </svg>
                <input
                    type="email"
                    id="email"
                    name="email"
                    value="{{ old('email') }}"
                    required
                    autocomplete="email"
                    placeholder="you@email.com"
                >
            </div>

            <button type="submit" class="btn-primary">Send Reset Link</button>
        </form>

        <div class="divider"><span>need help?</span></div>

        <p class="help-text">
            Remember your password? <a href="{{ route('login') }}">Sign in</a><br>
            No account yet? <a href="{{ route('register') }}">Create one</a>
        </p>

    </div>

</div>

</body>
</html>