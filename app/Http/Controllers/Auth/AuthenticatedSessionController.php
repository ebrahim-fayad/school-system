<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create($role): View
    {
        $type =$role;
        return view('auth.login',compact('type'));
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request,$type): RedirectResponse
    {
        $request->authenticate($type);

        $request->session()->regenerate();

        return redirect()->intended(RouteServiceProvider::Admin);
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request,$type): RedirectResponse
    {

        Auth::guard($type)->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return to_route('login',$type);
    }
}
