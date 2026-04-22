<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login – RYB Vehicle Trading</title>
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=DM+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        :root {
            --black:   #0a0a0a;
            --charcoal: #2e2828;
            --red:     #c0392b;
            --red-bright: #e74c3c;
            --offwhite: #f5ede8;
            --yellow:  #f5c518;
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
            position: relative;
        }

        /* Atmospheric background */
        body::before {
            content: '';
            position: fixed; inset: 0;
            background:
                radial-gradient(ellipse 80% 60% at 15% 20%, rgba(192,57,43,0.18) 0%, transparent 60%),
                radial-gradient(ellipse 60% 80% at 85% 75%, rgba(245,197,24,0.08) 0%, transparent 55%),
                radial-gradient(ellipse 100% 100% at 50% 50%, #0a0a0a 0%, #1a1414 100%);
            z-index: 0;
        }

        /* Diagonal stripe overlay */
        body::after {
            content: '';
            position: fixed; inset: 0;
            background-image: repeating-linear-gradient(
                -45deg,
                transparent,
                transparent 60px,
                rgba(255,255,255,0.012) 60px,
                rgba(255,255,255,0.012) 61px
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

        /* Left branding panel */
        .brand-panel {
            flex: 1;
            display: flex;
            flex-direction: column;
            justify-content: center;
            padding: 60px 70px;
            border-right: 1px solid rgba(245,197,24,0.1);
            animation: slideInLeft 0.8s cubic-bezier(0.22,1,0.36,1) both;
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
            opacity: 0.9;
        }

        .brand-logo {
            font-family: 'Bebas Neue', sans-serif;
            font-size: clamp(64px, 8vw, 110px);
            line-height: 0.9;
            color: var(--offwhite);
            margin-bottom: 32px;
        }

        .brand-logo span {
            color: var(--red);
            display: block;
        }

        .brand-desc {
            font-size: 14px;
            line-height: 1.8;
            color: var(--text-muted);
            max-width: 340px;
            border-left: 2px solid var(--red);
            padding-left: 16px;
        }

        .brand-stats {
            display: flex;
            gap: 40px;
            margin-top: 60px;
        }

        .stat-item { }

        .stat-num {
            font-family: 'Bebas Neue', sans-serif;
            font-size: 36px;
            color: var(--yellow);
            line-height: 1;
        }

        .stat-label {
            font-size: 11px;
            letter-spacing: 2px;
            color: var(--text-muted);
            text-transform: uppercase;
            margin-top: 4px;
        }

        /* Right form panel */
        .form-panel {
            width: 480px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            padding: 60px 56px;
            background: var(--glass-bg);
            backdrop-filter: blur(24px);
            -webkit-backdrop-filter: blur(24px);
            border-left: 1px solid var(--glass-border);
            animation: slideInRight 0.8s 0.1s cubic-bezier(0.22,1,0.36,1) both;
        }

        @keyframes slideInRight {
            from { opacity: 0; transform: translateX(40px); }
            to   { opacity: 1; transform: translateX(0); }
        }

        .form-header {
            margin-bottom: 40px;
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

        /* Form fields */
        .field-group {
            margin-bottom: 20px;
        }

        label {
            display: block;
            font-size: 11px;
            letter-spacing: 2px;
            text-transform: uppercase;
            color: var(--text-muted);
            margin-bottom: 8px;
        }

        .input-wrap {
            position: relative;
        }

        .input-wrap svg {
            position: absolute;
            left: 14px;
            top: 50%;
            transform: translateY(-50%);
            width: 16px; height: 16px;
            stroke: var(--text-muted);
            fill: none;
            pointer-events: none;
            transition: stroke 0.2s;
        }

        input[type="email"],
        input[type="password"],
        input[type="text"] {
            width: 100%;
            background: rgba(10,10,10,0.6);
            border: 1px solid rgba(245,237,232,0.12);
            border-radius: 6px;
            padding: 13px 14px 13px 42px;
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

        input:focus + svg,
        .input-wrap:focus-within svg {
            stroke: var(--yellow);
        }

        .input-wrap svg { order: 2; } /* hack — svg is after input in DOM */
        /* Re-order: input first, svg after */
        .input-wrap { display: flex; flex-direction: row-reverse; align-items: center; }
        .input-wrap input { flex: 1; }
        .input-wrap svg { position: absolute; left: 14px; }

        .form-options {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 28px;
            margin-top: -4px;
        }

        .remember-label {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 12px;
            color: var(--text-muted);
            cursor: pointer;
        }

        .remember-label input[type="checkbox"] {
            width: 14px; height: 14px;
            accent-color: var(--yellow);
            padding: 0;
        }

        .forgot-link {
            font-size: 12px;
            color: var(--yellow);
            text-decoration: none;
            opacity: 0.85;
            transition: opacity 0.2s;
        }

        .forgot-link:hover { opacity: 1; text-decoration: underline; }

        /* Submit button */
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
            display: flex;
            align-items: center;
            gap: 12px;
            margin: 24px 0;
        }

        .divider::before, .divider::after {
            content: '';
            flex: 1;
            height: 1px;
            background: rgba(245,237,232,0.1);
        }

        .divider span {
            font-size: 11px;
            color: var(--text-muted);
            letter-spacing: 1px;
        }

        .register-link-wrap {
            text-align: center;
            font-size: 13px;
            color: var(--text-muted);
        }

        .register-link-wrap a {
            color: var(--yellow);
            text-decoration: none;
            font-weight: 600;
            transition: color 0.2s;
        }

        .register-link-wrap a:hover { color: var(--offwhite); }

        /* Error/success alerts */
        .alert {
            padding: 12px 16px;
            border-radius: 6px;
            font-size: 13px;
            margin-bottom: 20px;
            border-left: 3px solid;
        }

        .alert-error {
            background: rgba(192,57,43,0.15);
            border-color: var(--red);
            color: #ff8a80;
        }

        /* if ($errors->any()) display block else none */
        .alert { display: none; }

        @media (max-width: 900px) {
            .brand-panel { display: none; }
            .form-panel { width: 100%; padding: 48px 32px; }
        }
    </style>
</head>
<body>

<div class="page-wrapper">

    <!-- Left Branding -->
    <div class="brand-panel">
        <p class="brand-tag">Philippines' Premier Car Dealer</p>
        <h1 class="brand-logo">
            RYB
            <span>Vehicle</span>
            Trading
        </h1>
        <p class="brand-desc">
            Browse our premium inventory of quality vehicles. Find your perfect car — from daily drivers to luxury rides.
        </p>
        <div class="brand-stats">
            <div class="stat-item">
                <div class="stat-num">156</div>
                <div class="stat-label">Cars Listed</div>
            </div>
            <div class="stat-item">
                <div class="stat-num">487</div>
                <div class="stat-label">Customers</div>
            </div>
            <div class="stat-item">
                <div class="stat-num">$1.2M</div>
                <div class="stat-label">Total Sales</div>
            </div>
        </div>
    </div>

    <!-- Right Form -->
    <div class="form-panel">
        <div class="form-header">
            <p class="form-eyebrow">Welcome Back</p>
            <h2 class="form-title">Sign In</h2>
            <p class="form-subtitle">Access your account and saved vehicles</p>
        </div>

        {{-- Laravel error display --}}
        @if ($errors->any())
        <div class="alert alert-error" style="display:block;">
            {{ $errors->first() }}
        </div>
        @endif

        @if (session('status'))
        <div class="alert" style="display:block; background:rgba(39,174,96,0.15); border-color:#2ecc71; color:#a8f0c6;">
            {{ session('status') }}
        </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="field-group">
                <label for="email">Email Address</label>
                <div class="input-wrap">
                    <input
                        type="email"
                        id="email"
                        name="email"
                        value="{{ old('email') }}"
                        required
                        autocomplete="email"
                        placeholder="you@example.com"
                    >
                    <svg viewBox="0 0 24 24" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/>
                        <polyline points="22,6 12,13 2,6"/>
                    </svg>
                </div>
            </div>

            <div class="field-group">
                <label for="password">Password</label>
                <div class="input-wrap">
                    <input
                        type="password"
                        id="password"
                        name="password"
                        required
                        autocomplete="current-password"
                        placeholder="••••••••"
                    >
                    <svg viewBox="0 0 24 24" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                        <rect x="3" y="11" width="18" height="11" rx="2" ry="2"/>
                        <path d="M7 11V7a5 5 0 0110 0v4"/>
                    </svg>
                </div>
            </div>

            <div class="form-options">
                <label class="remember-label">
                    <input type="checkbox" name="remember" id="remember"> Remember me
                </label>
                @if (Route::has('password.request'))
                <a href="{{ route('password.request') }}" class="forgot-link">Forgot password?</a>
                @endif
            </div>

            <button type="submit" class="btn-primary">Sign In to Account</button>
        </form>

        <div class="divider"><span>or</span></div>

        <div class="register-link-wrap">
            Don't have an account? <a href="{{ route('register') }}">Create one now</a>
        </div>
    </div>

</div>

</body>
</html> 