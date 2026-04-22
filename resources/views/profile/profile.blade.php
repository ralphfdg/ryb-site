<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Profile – RYB Vehicle Trading</title>
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=DM+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        :root {
            --black:    #0a0a0a;
            --charcoal: #2e2828;
            --charcoal-light: #3d3535;
            --red:      #c0392b;
            --red-bright: #e74c3c;
            --offwhite: #f5ede8;
            --yellow:   #f5c518;
            --glass-bg: rgba(46,40,40,0.5);
            --glass-border: rgba(245,237,232,0.08);
            --gold-border: rgba(245,197,24,0.18);
            --text-muted: rgba(245,237,232,0.5);
            --sidebar-w: 260px;
        }

        body {
            min-height: 100vh;
            background: var(--black);
            font-family: 'DM Sans', sans-serif;
            color: var(--offwhite);
        }

        body::before {
            content: '';
            position: fixed; inset: 0;
            background:
                radial-gradient(ellipse 40% 60% at 0% 30%, rgba(192,57,43,0.1) 0%, transparent 50%),
                radial-gradient(ellipse 50% 40% at 100% 80%, rgba(245,197,24,0.04) 0%, transparent 50%),
                #0a0a0a;
            z-index: 0;
        }

        /* ─── NAVBAR ─────────────────────────────────────── */
        .navbar {
            position: sticky; top: 0; z-index: 100;
            display: flex; align-items: center; justify-content: space-between;
            padding: 0 32px;
            height: 60px;
            background: rgba(10,10,10,0.85);
            backdrop-filter: blur(16px);
            border-bottom: 1px solid var(--glass-border);
        }

        .nav-logo {
            font-family: 'Bebas Neue', sans-serif;
            font-size: 22px; letter-spacing: 3px;
            color: var(--offwhite);
            text-decoration: none;
        }

        .nav-logo span { color: var(--red); }

        .nav-links {
            display: flex; align-items: center; gap: 28px; list-style: none;
        }

        .nav-links a {
            font-size: 12px; letter-spacing: 1px; text-transform: uppercase;
            color: var(--text-muted); text-decoration: none;
            transition: color 0.2s;
        }

        .nav-links a:hover, .nav-links a.active { color: var(--yellow); }

        .nav-right { display: flex; align-items: center; gap: 16px; }

        .nav-avatar {
            width: 34px; height: 34px; border-radius: 50%;
            background: var(--red);
            border: 2px solid var(--gold-border);
            display: flex; align-items: center; justify-content: center;
            font-family: 'Bebas Neue', sans-serif;
            font-size: 14px; cursor: pointer;
            transition: border-color 0.2s;
        }

        .nav-avatar:hover { border-color: var(--yellow); }

        /* ─── LAYOUT ─────────────────────────────────────── */
        .page-layout {
            position: relative; z-index: 1;
            display: flex;
            min-height: calc(100vh - 60px);
        }

        /* ─── SIDEBAR ────────────────────────────────────── */
        .sidebar {
            width: var(--sidebar-w);
            flex-shrink: 0;
            border-right: 1px solid var(--glass-border);
            padding: 32px 0;
            position: sticky; top: 60px;
            height: calc(100vh - 60px);
            overflow-y: auto;
        }

        .profile-mini {
            padding: 0 24px 28px;
            border-bottom: 1px solid var(--glass-border);
            margin-bottom: 16px;
        }

        .avatar-wrap {
            position: relative;
            width: 64px; height: 64px; margin-bottom: 14px;
        }

        .avatar-img {
            width: 64px; height: 64px; border-radius: 50%;
            background: linear-gradient(135deg, var(--charcoal), var(--red));
            border: 2px solid var(--gold-border);
            display: flex; align-items: center; justify-content: center;
            font-family: 'Bebas Neue', sans-serif;
            font-size: 24px; color: var(--offwhite);
            overflow: hidden;
        }

        .avatar-img img { width: 100%; height: 100%; object-fit: cover; }

        .avatar-badge {
            position: absolute; bottom: 0; right: 0;
            width: 16px; height: 16px; border-radius: 50%;
            background: #2ecc71;
            border: 2px solid var(--black);
        }

        .profile-name {
            font-weight: 600; font-size: 14px; margin-bottom: 2px;
        }

        .profile-role {
            font-size: 11px; letter-spacing: 1.5px; text-transform: uppercase;
            color: var(--yellow); opacity: 0.8;
        }

        .nav-section-label {
            font-size: 9px; letter-spacing: 3px; text-transform: uppercase;
            color: var(--text-muted); padding: 12px 24px 8px;
        }

        .sidebar-nav { list-style: none; }

        .sidebar-nav li a {
            display: flex; align-items: center; gap: 12px;
            padding: 10px 24px;
            font-size: 13px; color: var(--text-muted);
            text-decoration: none;
            transition: color 0.15s, background 0.15s;
            border-right: 2px solid transparent;
        }

        .sidebar-nav li a:hover {
            color: var(--offwhite);
            background: rgba(245,237,232,0.04);
        }

        .sidebar-nav li a.active {
            color: var(--yellow);
            background: rgba(245,197,24,0.06);
            border-right-color: var(--yellow);
        }

        .sidebar-nav li a svg {
            width: 15px; height: 15px;
            stroke: currentColor; fill: none;
            stroke-width: 1.5; stroke-linecap: round; stroke-linejoin: round;
            flex-shrink: 0;
        }

        .badge {
            margin-left: auto;
            background: var(--red);
            color: white; font-size: 10px; font-weight: 600;
            padding: 2px 7px; border-radius: 20px;
        }

        .sidebar-logout {
            padding: 0 24px; margin-top: 20px;
        }

        .btn-logout {
            width: 100%; background: none;
            border: 1px solid rgba(192,57,43,0.3);
            border-radius: 6px; padding: 9px 14px;
            color: var(--red-bright); font-family: 'DM Sans', sans-serif;
            font-size: 12px; letter-spacing: 1px; cursor: pointer;
            display: flex; align-items: center; justify-content: center; gap: 8px;
            transition: background 0.2s, border-color 0.2s;
        }

        .btn-logout:hover {
            background: rgba(192,57,43,0.12);
            border-color: var(--red);
        }

        .btn-logout svg {
            width: 14px; height: 14px;
            stroke: currentColor; fill: none;
            stroke-width: 1.5; stroke-linecap: round; stroke-linejoin: round;
        }

        /* ─── MAIN CONTENT ───────────────────────────────── */
        .main-content {
            flex: 1;
            padding: 40px 48px;
            overflow-y: auto;
        }

        .page-header {
            display: flex; align-items: flex-start; justify-content: space-between;
            margin-bottom: 36px;
        }

        .page-header-left {}

        .page-eyebrow {
            font-size: 10px; letter-spacing: 3px; text-transform: uppercase;
            color: var(--yellow); margin-bottom: 6px;
        }

        .page-title {
            font-family: 'Bebas Neue', sans-serif;
            font-size: 40px; letter-spacing: 1px;
            color: var(--offwhite); line-height: 1;
        }

        .page-sub { font-size: 13px; color: var(--text-muted); margin-top: 6px; }

        /* ─── STATS ROW ───────────────────────────────────── */
        .stats-row {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 16px;
            margin-bottom: 32px;
        }

        .stat-card {
            background: var(--glass-bg);
            border: 1px solid var(--glass-border);
            border-radius: 10px;
            padding: 20px;
            transition: border-color 0.2s;
        }

        .stat-card:hover { border-color: var(--gold-border); }

        .stat-card-icon {
            width: 36px; height: 36px; border-radius: 8px;
            background: rgba(245,197,24,0.08);
            border: 1px solid var(--gold-border);
            display: flex; align-items: center; justify-content: center;
            margin-bottom: 14px;
        }

        .stat-card-icon svg {
            width: 16px; height: 16px;
            stroke: var(--yellow); fill: none;
            stroke-width: 1.5; stroke-linecap: round; stroke-linejoin: round;
        }

        .stat-card-val {
            font-family: 'Bebas Neue', sans-serif;
            font-size: 28px; color: var(--offwhite); line-height: 1;
        }

        .stat-card-label {
            font-size: 11px; letter-spacing: 1px; text-transform: uppercase;
            color: var(--text-muted); margin-top: 4px;
        }

        /* ─── CARDS ──────────────────────────────────────── */
        .section-card {
            background: var(--glass-bg);
            border: 1px solid var(--glass-border);
            border-radius: 12px;
            margin-bottom: 24px;
            overflow: hidden;
        }

        .section-head {
            display: flex; align-items: center; justify-content: space-between;
            padding: 20px 24px;
            border-bottom: 1px solid var(--glass-border);
        }

        .section-title {
            font-family: 'Bebas Neue', sans-serif;
            font-size: 18px; letter-spacing: 1px; color: var(--offwhite);
        }

        .section-body { padding: 24px; }

        /* ─── PROFILE FORM ───────────────────────────────── */
        .form-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px 28px;
        }

        .field-full { grid-column: 1 / -1; }

        .field-group label {
            display: block; font-size: 10px; letter-spacing: 2px;
            text-transform: uppercase; color: var(--text-muted); margin-bottom: 7px;
        }

        .input-wrap {
            position: relative; display: flex; align-items: center;
        }

        .input-wrap .icon {
            position: absolute; left: 12px; z-index: 1;
            width: 14px; height: 14px;
            stroke: var(--text-muted); fill: none;
            stroke-width: 1.5; stroke-linecap: round; stroke-linejoin: round;
            pointer-events: none; transition: stroke 0.2s;
        }

        .input-wrap:focus-within .icon { stroke: var(--yellow); }

        input[type="text"], input[type="email"], input[type="tel"],
        input[type="password"], textarea, select {
            width: 100%;
            background: rgba(10,10,10,0.6);
            border: 1px solid rgba(245,237,232,0.1);
            border-radius: 6px;
            padding: 11px 12px 11px 36px;
            color: var(--offwhite);
            font-family: 'DM Sans', sans-serif;
            font-size: 13px;
            transition: border-color 0.2s, box-shadow 0.2s;
            outline: none;
        }

        input:focus, textarea:focus, select:focus {
            border-color: var(--yellow);
            box-shadow: 0 0 0 3px rgba(245,197,24,0.08);
        }

        textarea {
            resize: vertical; min-height: 80px;
            padding: 11px 12px 11px 36px;
        }

        select { appearance: none; cursor: pointer; }

        .no-icon input, .no-icon textarea, .no-icon select {
            padding-left: 12px;
        }

        .input-readonly { opacity: 0.5; cursor: default; }

        /* Avatar upload */
        .avatar-upload-row {
            display: flex; align-items: center; gap: 24px;
            margin-bottom: 24px; padding-bottom: 24px;
            border-bottom: 1px solid var(--glass-border);
        }

        .avatar-large {
            width: 84px; height: 84px; border-radius: 50%;
            background: linear-gradient(135deg, var(--charcoal), var(--red));
            border: 2px solid var(--gold-border);
            display: flex; align-items: center; justify-content: center;
            font-family: 'Bebas Neue', sans-serif; font-size: 32px;
            overflow: hidden; flex-shrink: 0;
        }

        .avatar-large img { width: 100%; height: 100%; object-fit: cover; }

        .avatar-info { flex: 1; }

        .avatar-info h4 { font-size: 14px; font-weight: 600; margin-bottom: 4px; }
        .avatar-info p { font-size: 12px; color: var(--text-muted); margin-bottom: 12px; }

        .btn-upload {
            background: none;
            border: 1px solid var(--gold-border);
            border-radius: 6px; padding: 7px 14px;
            color: var(--yellow); font-family: 'DM Sans', sans-serif;
            font-size: 12px; cursor: pointer;
            transition: background 0.2s;
        }

        .btn-upload:hover { background: rgba(245,197,24,0.08); }

        /* Save btn */
        .btn-save {
            background: var(--red); border: none; border-radius: 6px;
            padding: 11px 28px; color: var(--offwhite);
            font-family: 'Bebas Neue', sans-serif;
            font-size: 16px; letter-spacing: 2px; cursor: pointer;
            transition: background 0.2s, transform 0.15s;
        }

        .btn-save:hover { background: var(--red-bright); transform: translateY(-1px); }

        .btn-outline {
            background: none;
            border: 1px solid rgba(245,237,232,0.15);
            border-radius: 6px; padding: 11px 22px;
            color: var(--text-muted); font-family: 'DM Sans', sans-serif;
            font-size: 13px; cursor: pointer;
            transition: border-color 0.2s, color 0.2s;
        }

        .btn-outline:hover { border-color: var(--offwhite); color: var(--offwhite); }

        .btn-row {
            display: flex; gap: 12px; justify-content: flex-end;
            padding: 18px 24px;
            border-top: 1px solid var(--glass-border);
        }

        /* ─── SAVED CARS ─────────────────────────────────── */
        .cars-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(220px, 1fr));
            gap: 16px;
        }

        .car-card {
            background: rgba(10,10,10,0.5);
            border: 1px solid var(--glass-border);
            border-radius: 10px; overflow: hidden;
            transition: border-color 0.2s, transform 0.2s;
            text-decoration: none; color: inherit;
            display: block;
        }

        .car-card:hover { border-color: var(--gold-border); transform: translateY(-2px); }

        .car-img {
            width: 100%; height: 130px;
            background: linear-gradient(135deg, var(--charcoal) 0%, #1a1414 100%);
            display: flex; align-items: center; justify-content: center;
            overflow: hidden;
        }

        .car-img img { width: 100%; height: 100%; object-fit: cover; }

        .car-img-placeholder svg {
            width: 40px; height: 40px;
            stroke: rgba(245,237,232,0.2); fill: none;
            stroke-width: 1; stroke-linecap: round; stroke-linejoin: round;
        }

        .car-info { padding: 14px; }

        .car-brand {
            font-size: 10px; letter-spacing: 2px; text-transform: uppercase;
            color: var(--yellow); margin-bottom: 4px;
        }

        .car-model { font-size: 14px; font-weight: 600; margin-bottom: 6px; }
        .car-price { font-family: 'Bebas Neue', sans-serif; font-size: 18px; color: var(--offwhite); }

        .car-status {
            display: inline-block; margin-top: 8px;
            font-size: 10px; letter-spacing: 1px; text-transform: uppercase;
            padding: 3px 8px; border-radius: 4px;
        }

        .status-available { background: rgba(46,204,113,0.1); color: #2ecc71; border: 1px solid rgba(46,204,113,0.2); }
        .status-sold { background: rgba(192,57,43,0.1); color: var(--red-bright); border: 1px solid rgba(192,57,43,0.2); }

        .unsave-btn {
            display: flex; align-items: center; gap: 4px;
            background: none; border: none; cursor: pointer;
            font-size: 10px; letter-spacing: 1px; text-transform: uppercase;
            color: var(--text-muted); margin-top: 10px; padding: 0;
            transition: color 0.2s;
        }

        .unsave-btn:hover { color: var(--red-bright); }

        .unsave-btn svg { width: 12px; height: 12px; stroke: currentColor; fill: none; stroke-width: 1.5; stroke-linecap: round; }

        /* ─── INQUIRIES TABLE ────────────────────────────── */
        .inquiry-table { width: 100%; border-collapse: collapse; }

        .inquiry-table th {
            text-align: left; font-size: 10px; letter-spacing: 2px;
            text-transform: uppercase; color: var(--text-muted);
            padding: 0 16px 14px; border-bottom: 1px solid var(--glass-border);
            font-weight: 500;
        }

        .inquiry-table td {
            padding: 14px 16px;
            font-size: 13px;
            border-bottom: 1px solid rgba(245,237,232,0.05);
            vertical-align: middle;
        }

        .inquiry-table tr:last-child td { border-bottom: none; }

        .inquiry-table tr:hover td { background: rgba(245,237,232,0.02); }

        .inquiry-subject { font-weight: 500; margin-bottom: 3px; }
        .inquiry-car { font-size: 11px; color: var(--text-muted); }

        .status-pill {
            display: inline-block; padding: 3px 10px; border-radius: 20px;
            font-size: 10px; letter-spacing: 1px; text-transform: uppercase; font-weight: 500;
        }

        .pill-pending  { background: rgba(245,197,24,0.1); color: var(--yellow); border: 1px solid rgba(245,197,24,0.2); }
        .pill-resolved { background: rgba(46,204,113,0.1); color: #2ecc71; border: 1px solid rgba(46,204,113,0.2); }
        .pill-new      { background: rgba(41,128,185,0.1); color: #74b9ff; border: 1px solid rgba(41,128,185,0.2); }

        .date-text { font-size: 11px; color: var(--text-muted); }

        /* Empty states */
        .empty-state {
            text-align: center; padding: 48px 24px;
        }

        .empty-state svg {
            width: 44px; height: 44px;
            stroke: rgba(245,237,232,0.15); fill: none;
            stroke-width: 1; stroke-linecap: round; stroke-linejoin: round;
            margin: 0 auto 16px;
        }

        .empty-state p { font-size: 13px; color: var(--text-muted); margin-bottom: 16px; }

        .btn-browse {
            display: inline-block;
            background: var(--red); border-radius: 6px;
            padding: 9px 20px; color: var(--offwhite);
            font-family: 'Bebas Neue', sans-serif;
            font-size: 14px; letter-spacing: 2px;
            text-decoration: none;
            transition: background 0.2s;
        }

        .btn-browse:hover { background: var(--red-bright); }

        /* Alert */
        .alert-success {
            padding: 12px 16px; border-radius: 6px;
            background: rgba(39,174,96,0.12); border-left: 3px solid #2ecc71;
            color: #a8f0c6; font-size: 13px; margin-bottom: 20px;
        }

        /* Tab bar */
        .tab-bar {
            display: flex; gap: 4px;
            background: rgba(10,10,10,0.4);
            border-radius: 8px; padding: 4px;
            margin-bottom: 28px;
        }

        .tab-btn {
            flex: 1; background: none; border: none;
            border-radius: 6px; padding: 9px;
            color: var(--text-muted); font-family: 'DM Sans', sans-serif;
            font-size: 12px; letter-spacing: 1px; text-transform: uppercase;
            cursor: pointer; transition: background 0.2s, color 0.2s;
        }

        .tab-btn.active {
            background: var(--charcoal);
            color: var(--yellow);
        }

        .tab-pane { display: none; }
        .tab-pane.active { display: block; }

        @media (max-width: 1024px) {
            .stats-row { grid-template-columns: repeat(2, 1fr); }
            .main-content { padding: 28px 24px; }
        }

        @media (max-width: 768px) {
            .sidebar { display: none; }
            .form-grid { grid-template-columns: 1fr; }
        }
    </style>
</head>
<body>

<!-- Navbar -->
<nav class="navbar">
    <a href="/" class="nav-logo">RYB <span>•</span> VEHICLE</a>
    <ul class="nav-links">
        <li><a href="/">Home</a></li>
        <li><a href="/catalog">Catalog</a></li>
        <li><a href="/profile" class="active">Profile</a></li>
    </ul>
    <div class="nav-right">
        <div class="nav-avatar">{{ strtoupper(substr(auth()->user()->name ?? 'U', 0, 1)) }}</div>
    </div>
</nav>

<div class="page-layout">

    <!-- Sidebar -->
    <aside class="sidebar">
        <div class="profile-mini">
            <div class="avatar-wrap">
                <div class="avatar-img">
                    @if(auth()->user()?->profile_photo)
                        <img src="{{ asset('storage/' . auth()->user()->profile_photo) }}" alt="Profile">
                    @else
                        {{ strtoupper(substr(auth()->user()?->name ?? 'U', 0, 1)) }}
                    @endif
                </div>
                <div class="avatar-badge"></div>
            </div>
            <div class="profile-name">{{ auth()->user()?->name ?? 'Customer' }}</div>
            <div class="profile-role">{{ ucfirst(auth()->user()?->role ?? 'customer') }}</div>
        </div>

        <p class="nav-section-label">Account</p>
        <ul class="sidebar-nav">
            <li>
                <a href="#" class="active" onclick="showTab('profile'); return false;">
                    <svg viewBox="0 0 24 24"><path d="M20 21v-2a4 4 0 00-4-4H8a4 4 0 00-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                    My Profile
                </a>
            </li>
            <li>
                <a href="#" onclick="showTab('saved'); return false;">
                    <svg viewBox="0 0 24 24"><path d="M20.84 4.61a5.5 5.5 0 00-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 00-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 000-7.78z"/></svg>
                    Saved Cars
                    {{-- @if($savedCount) <span class="badge">{{ $savedCount }}</span> @endif --}}
                </a>
            </li>
            <li>
                <a href="#" onclick="showTab('inquiries'); return false;">
                    <svg viewBox="0 0 24 24"><path d="M21 15a2 2 0 01-2 2H7l-4 4V5a2 2 0 012-2h14a2 2 0 012 2z"/></svg>
                    My Inquiries
                    {{-- @if($pendingInquiries) <span class="badge">{{ $pendingInquiries }}</span> @endif --}}
                </a>
            </li>
            <li>
                <a href="#" onclick="showTab('security'); return false;">
                    <svg viewBox="0 0 24 24"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"/><path d="M7 11V7a5 5 0 0110 0v4"/></svg>
                    Security
                </a>
            </li>
        </ul>

        <div class="sidebar-logout" style="position:absolute; bottom: 24px; left:0; right:0; padding: 0 24px;">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="btn-logout">
                    <svg viewBox="0 0 24 24"><path d="M9 21H5a2 2 0 01-2-2V5a2 2 0 012-2h4"/><polyline points="16 17 21 12 16 7"/><line x1="21" y1="12" x2="9" y2="12"/></svg>
                    Sign Out
                </button>
            </form>
        </div>
    </aside>

    <!-- Main Content -->
    <main class="main-content">

        @if (session('status'))
        <div class="alert-success">✓ &nbsp;{{ session('status') }}</div>
        @endif

        <!-- Stats -->
        <div class="stats-row">
            <div class="stat-card">
                <div class="stat-card-icon">
                    <svg viewBox="0 0 24 24"><path d="M20.84 4.61a5.5 5.5 0 00-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 00-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 000-7.78z"/></svg>
                </div>
                <div class="stat-card-val">{{ $savedCarsCount ?? 0 }}</div>
                <div class="stat-card-label">Saved Cars</div>
            </div>
            <div class="stat-card">
                <div class="stat-card-icon">
                    <svg viewBox="0 0 24 24"><path d="M21 15a2 2 0 01-2 2H7l-4 4V5a2 2 0 012-2h14a2 2 0 012 2z"/></svg>
                </div>
                <div class="stat-card-val">{{ $inquiriesCount ?? 0 }}</div>
                <div class="stat-card-label">Inquiries Sent</div>
            </div>
            <div class="stat-card">
                <div class="stat-card-icon">
                    <svg viewBox="0 0 24 24"><polyline points="20 6 9 17 4 12"/></svg>
                </div>
                <div class="stat-card-val">{{ $resolvedCount ?? 0 }}</div>
                <div class="stat-card-label">Resolved</div>
            </div>
            <div class="stat-card">
                <div class="stat-card-icon">
                    <svg viewBox="0 0 24 24"><path d="M6 2L3 6v14a2 2 0 002 2h14a2 2 0 002-2V6l-3-4z"/><line x1="3" y1="6" x2="21" y2="6"/><path d="M16 10a4 4 0 01-8 0"/></svg>
                </div>
                <div class="stat-card-val">{{ $purchasesCount ?? 0 }}</div>
                <div class="stat-card-label">Purchases</div>
            </div>
        </div>

        <!-- Tab Bar -->
        <div class="tab-bar">
            <button class="tab-btn active" id="tab-profile"   onclick="showTab('profile')">Profile</button>
            <button class="tab-btn"         id="tab-saved"    onclick="showTab('saved')">Saved Cars</button>
            <button class="tab-btn"         id="tab-inquiries" onclick="showTab('inquiries')">Inquiries</button>
            <button class="tab-btn"         id="tab-security" onclick="showTab('security')">Security</button>
        </div>

        <!-- ──── PROFILE TAB ──── -->
        <div class="tab-pane active" id="pane-profile">

            <div class="section-card">
                <div class="section-head">
                    <h3 class="section-title">Personal Information</h3>
                </div>
                <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')
                    <div class="section-body">

                        <!-- Avatar upload -->
                        <div class="avatar-upload-row">
                            <div class="avatar-large">
                                @if(auth()->user()->profile_photo ?? false)
                                    <img src="{{ asset('storage/' . auth()->user()->profile_photo) }}" alt="">
                                @else
                                    {{ strtoupper(substr(auth()->user()->name ?? 'U', 0, 1)) }}
                                @endif
                            </div>
                            <div class="avatar-info">
                                <h4>Profile Photo</h4>
                                <p>JPG, PNG or GIF. Max 2MB.</p>
                                <label for="avatar_upload" class="btn-upload" style="display:inline-block; cursor:pointer;">
                                    Upload Photo
                                </label>
                                <input type="file" id="avatar_upload" name="profile_photo" accept="image/*" style="display:none;" onchange="previewAvatar(this)">
                            </div>
                        </div>

                        <div class="form-grid">
                            <div class="field-group">
                                <label>Full Name</label>
                                <div class="input-wrap">
                                    <svg class="icon" viewBox="0 0 24 24"><path d="M20 21v-2a4 4 0 00-4-4H8a4 4 0 00-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                                    <input type="text" name="name" value="{{ old('name', auth()->user()->name) }}" required>
                                </div>
                            </div>

                            <div class="field-group">
                                <label>Phone Number</label>
                                <div class="input-wrap">
                                    <svg class="icon" viewBox="0 0 24 24"><path d="M22 16.92v3a2 2 0 01-2.18 2 19.79 19.79 0 01-8.63-3.07A19.5 19.5 0 013.07 9.82"/></svg>
                                    <input type="tel" name="phone_number" value="{{ old('phone_number', auth()->user()->phone_number) }}" placeholder="09XX XXX XXXX">
                                </div>
                            </div>

                            <div class="field-group field-full">
                                <label>Email Address</label>
                                <div class="input-wrap">
                                    <svg class="icon" viewBox="0 0 24 24"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>
                                    <input type="email" name="email" value="{{ old('email', auth()->user()->email) }}" required>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="btn-row">
                        <button type="button" class="btn-outline" onclick="this.closest('form').reset()">Cancel</button>
                        <button type="submit" class="btn-save">Save Changes</button>
                    </div>
                </form>
            </div>

        </div>

        <!-- ──── SAVED CARS TAB ──── -->
        <div class="tab-pane" id="pane-saved">
            <div class="section-card">
                <div class="section-head">
                    <h3 class="section-title">Saved Vehicles</h3>
                    <a href="/catalog" style="font-size:12px; color:var(--yellow); text-decoration:none;">Browse Catalog →</a>
                </div>
                <div class="section-body">
                    @if(isset($savedCars) && $savedCars->count())
                    <div class="cars-grid">
                        @foreach($savedCars as $car)
                        <div class="car-card" style="display:block; text-decoration:none; color:inherit;">
                            <div class="car-img">
                                @if($car->primaryImage)
                                    <img src="{{ asset('storage/' . $car->primaryImage->image_path) }}" alt="{{ $car->model_name }}">
                                @else
                                    <div class="car-img-placeholder">
                                        <svg viewBox="0 0 64 32"><rect x="4" y="12" width="56" height="16" rx="4"/><circle cx="16" cy="28" r="5"/><circle cx="48" cy="28" r="5"/><path d="M4 20 L14 10 L50 10 L60 20"/></svg>
                                    </div>
                                @endif
                            </div>
                            <div class="car-info">
                                <div class="car-brand">{{ $car->brand->brand_name ?? '' }}</div>
                                <div class="car-model">{{ $car->model_name }}</div>
                                <div class="car-price">₱{{ number_format($car->price) }}</div>
                                <span class="car-status {{ $car->status === 'Available' ? 'status-available' : 'status-sold' }}">
                                    {{ $car->status }}
                                </span>
                                <form method="POST" action="{{ route('profile.unsave', $car->id) }}" style="display:inline;">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="unsave-btn">
                                        <svg viewBox="0 0 24 24"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
                                        Remove
                                    </button>
                                </form>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    @else
                    <div class="empty-state">
                        <svg viewBox="0 0 24 24"><path d="M20.84 4.61a5.5 5.5 0 00-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 00-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 000-7.78z"/></svg>
                        <p>You haven't saved any vehicles yet.</p>
                        <a href="/catalog" class="btn-browse">Browse Catalog</a>
                    </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- ──── INQUIRIES TAB ──── -->
        <div class="tab-pane" id="pane-inquiries">
            <div class="section-card">
                <div class="section-head">
                    <h3 class="section-title">My Inquiries</h3>
                </div>
                <div class="section-body" style="padding: 0;">
                    @if(isset($inquiries) && $inquiries->count())
                    <table class="inquiry-table">
                        <thead>
                            <tr>
                                <th>Subject</th>
                                <th>Vehicle</th>
                                <th>Status</th>
                                <th>Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($inquiries as $inquiry)
                            <tr>
                                <td>
                                    <div class="inquiry-subject">{{ $inquiry->subject }}</div>
                                    <div class="inquiry-car" style="font-size:11px; color:var(--text-muted); margin-top:2px;">
                                        {{ Str::limit($inquiry->message, 60) }}
                                    </div>
                                </td>
                                <td>
                                    @if($inquiry->car)
                                    <div style="font-size:12px;">
                                        <div style="font-weight:500;">{{ $inquiry->car->model_name }}</div>
                                        <div class="date-text">{{ $inquiry->car->brand->brand_name ?? '' }}</div>
                                    </div>
                                    @else
                                    <span style="color:var(--text-muted); font-size:12px;">—</span>
                                    @endif
                                </td>
                                <td>
                                    <span class="status-pill {{ $inquiry->status === 'Resolved' ? 'pill-resolved' : ($inquiry->status === 'Pending' ? 'pill-pending' : 'pill-new') }}">
                                        {{ $inquiry->status }}
                                    </span>
                                </td>
                                <td>
                                    <span class="date-text">{{ $inquiry->created_at->format('M d, Y') }}</span>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @else
                    <div class="empty-state">
                        <svg viewBox="0 0 24 24"><path d="M21 15a2 2 0 01-2 2H7l-4 4V5a2 2 0 012-2h14a2 2 0 012 2z"/></svg>
                        <p>You haven't sent any inquiries yet.</p>
                        <a href="/catalog" class="btn-browse">Browse Cars</a>
                    </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- ──── SECURITY TAB ──── -->
        <div class="tab-pane" id="pane-security">
            <div class="section-card">
                <div class="section-head">
                    <h3 class="section-title">Change Password</h3>
                </div>
                <form method="POST" action="{{ route('password.update') }}">
                    @csrf @method('PUT')
                    <div class="section-body">
                        <div style="max-width: 480px;">
                            <div class="field-group" style="margin-bottom:20px;">
                                <label>Current Password</label>
                                <div class="input-wrap">
                                    <svg class="icon" viewBox="0 0 24 24"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"/><path d="M7 11V7a5 5 0 0110 0v4"/></svg>
                                    <input type="password" name="current_password" required placeholder="Your current password">
                                </div>
                            </div>
                            <div class="field-group" style="margin-bottom:20px;">
                                <label>New Password</label>
                                <div class="input-wrap">
                                    <svg class="icon" viewBox="0 0 24 24"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
                                    <input type="password" name="password" required placeholder="Min. 8 characters">
                                </div>
                            </div>
                            <div class="field-group" style="margin-bottom:0;">
                                <label>Confirm New Password</label>
                                <div class="input-wrap">
                                    <svg class="icon" viewBox="0 0 24 24"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
                                    <input type="password" name="password_confirmation" required placeholder="Repeat new password">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="btn-row">
                        <button type="submit" class="btn-save">Update Password</button>
                    </div>
                </form>
            </div>

            <!-- Danger Zone -->
            <div class="section-card" style="border-color: rgba(192,57,43,0.2);">
                <div class="section-head">
                    <h3 class="section-title" style="color:var(--red-bright);">Danger Zone</h3>
                </div>
                <div class="section-body">
                    <p style="font-size:13px; color:var(--text-muted); margin-bottom:16px;">
                        Permanently delete your account and all associated data. This action cannot be undone.
                    </p>
                    <form method="POST" action="{{ route('profile.destroy') }}" onsubmit="return confirm('Are you sure? This cannot be undone.')">
                        @csrf @method('DELETE')
                        <button type="submit" style="background:rgba(192,57,43,0.15); border:1px solid rgba(192,57,43,0.3); border-radius:6px; padding:10px 20px; color:var(--red-bright); font-family:'DM Sans',sans-serif; font-size:13px; cursor:pointer; transition:background 0.2s;">
                            Delete My Account
                        </button>
                    </form>
                </div>
            </div>
        </div>

    </main>

</div>

<script>
function showTab(name) {
    document.querySelectorAll('.tab-pane').forEach(p => p.classList.remove('active'));
    document.querySelectorAll('.tab-btn').forEach(b => b.classList.remove('active'));
    document.getElementById('pane-' + name).classList.add('active');
    document.getElementById('tab-' + name).classList.add('active');
    // Also update sidebar active link
    document.querySelectorAll('.sidebar-nav a').forEach(a => a.classList.remove('active'));
}

function previewAvatar(input) {
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = e => {
            document.querySelectorAll('.avatar-large, .avatar-img').forEach(el => {
                el.innerHTML = `<img src="${e.target.result}" alt="Preview" style="width:100%;height:100%;object-fit:cover;border-radius:50%;">`;
            });
        };
        reader.readAsDataURL(input.files[0]);
    }
}
</script>

</body>
</html>