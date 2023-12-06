<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Laravel\Socialite\Facades\Socialite;

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
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();

        // Check if the authenticated user is an admin
        if (Auth::check() && Auth::user()->role === 'Admin') {
            return redirect()->route('adminDashboard');
        } else {
            // If the user is not an admin, redirect to the regular user view
            return redirect()->route('dashboard');
        }
        // return redirect()->intended(RouteServiceProvider::HOME);
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

    public function loginWithSocialite($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    public function handleSocialiteCallback($provider)
    {
        $user = Socialite::driver($provider)->user();

        // Your logic to handle the user data (create or log in the user)

        return redirect('/dashboard'); // Redirect to the dashboard or any desired route
    }
}
