<?php

namespace App\Http\Controllers;

use App\Providers\RouteServiceProvider as ProvidersRouteServiceProvider;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    protected $redirectTo = ProvidersRouteServiceProvider::HOME;

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function showLoginForm()
    {
        return view('login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (auth()->attempt($credentials)) {
            $request->session()->regenerate();
            $user = auth()->user();
            
            // Handle only 'admin' and 'staff' levels
            if ($user->level === 'admin') {
                return redirect()->intended(route('admin.admin-index'));
            } elseif ($user->level === 'staff') {
                return redirect()->intended(route('staff.admin-index'));
            } else {
                // Logout if the user's level is not valid
                Auth::logout();
                $request->session()->invalidate();
                $request->session()->regenerateToken();
                return redirect()->route('loginform')->with('fail', 'Unauthorized user level.');
            }
        }

        return redirect()->back()->with('fail', 'Login failed. Invalid email or password.');
    }

    protected function authenticated(Request $request, $user)
    {
        
        $user->update([
            'last_login_at' => now(),
        ]);
    }
    
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}
