<?php

namespace App\Http\Controllers\Auth;

use App\Events\Auth\UserLoginSuccess;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        $email = $request->email;
        $password = $request->password;
        $remember = $request->remember_me;

        if (Auth::attempt(['email' => $email, 'password' => $password], $remember)) {
            $request->session()->regenerate();

            $user = auth()->user();

            event(new UserLoginSuccess($request, $user));

            // Cek apakah user adalah dashboard admin berdasarkan email
            if ($user->email === 'dashboardadmin@medical.com' || 
                str_contains($user->email, 'dashboardadmin') || 
                $user->name === 'Dashboard Admin') {
                return redirect()->route('dashboardadmin.index');
            }

            return redirect()->intended(route('home', absolute: false));
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
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