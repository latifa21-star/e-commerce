<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('auth')->only('logout');
    }

    /**
     * Rediriger les utilisateurs après la connexion en fonction de leur rôle.
     *
     * @return string
     */
    protected function redirectTo()
{
    if (Auth::check()) {
        $user = Auth::user();
        
        
        $role = auth()->user()->role->name;
        
        if ($role === 'super_admin' || $role === 'admin') {
            return '/dashboard'; 
        }else{
            return redirect()->route('welcome');

        }
    }

    
}



    /**
     * Déconnecter l'utilisateur et invalider la session.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logoutx(Request $request)
    {
        Auth::logout(); 
        $request->session()->invalidate(); 
        $request->session()->regenerateToken(); 

        return redirect()->route('welcome'); 
    }
}
