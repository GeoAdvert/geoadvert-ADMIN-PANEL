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
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {

        //   if(auth()->user()->hasRoles('tablet')){
            // dd('dd');
        //   }
        $request->authenticate();

        $request->session()->regenerate();
        if (auth()->user()->hasRole('tablet')) {
            if ($request->is_payment == 1) {
                return redirect()->route('summary.index');
            } else {
                return redirect()->route('start');
            }
        }

        if ($request->is_payment == 1) {
            return redirect()->route('summary.index');
        } else {
            return redirect()->intended(RouteServiceProvider::HOME);
        }
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        if($request->is_payment == 1){
            return redirect()->route('start');
        }else{
            return redirect('/');
        }
    }
}
