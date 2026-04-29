<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

   /**
     * Handle an incoming authentication request.
     */
    public function store(\App\Http\Requests\Auth\LoginRequest $request): \Illuminate\Http\RedirectResponse
    {
        // Validates credentials against the database
        $request->authenticate();

        // Regenerates the session ID to prevent fixation attacks (Security Best Practice)
        $request->session()->regenerate();

        // Extract the authenticated user
        $user = $request->user();

        // Route based on Spatie Roles (Adhering to RYB Tech Stack)
        if ($user->hasRole('Admin')) {
            return redirect()->intended(route('admin.dashboard'));
        }

        // Fallback for standard customers
        return redirect()->intended(route('home'));
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
