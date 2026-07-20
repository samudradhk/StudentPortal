<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class AuthController extends Controller
{
    public function showLogin(){
        return view('login');
    }

    public function login(Request $request){
        $validated = $request->validate(
            [
                'email' => 'required|email',
                'password' => ['required',
                    Password::min(6)
                        ->max(20)
                        ->mixedCase()
                        ->symbols()
                        ->numbers()
                ]
            ],
            [
                'email.required' => __('main.messages.email_required')
            ]
        );

        if(Auth::attempt($validated)){
            $request->session()->regenerate();
            session([
                'role' => 'Superadmin'
            ]);

            return redirect()->route('home');
        }

         return back()->withErrors(['login' => __('main.messages.login_failed')]);
    }

    public function showRegister(){
        return view('register'); 
    }

    public function register(Request $request){
        $validated = $request->validate([
           'email' => ['required', 'email'],
           'name' => ['required'],
           'password' => ['required', 'confirmed'],
        ]);

        User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password'])
        ]);

        return redirect()->route('login');
    }

    public function logout(Request $request){
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}