<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index(Request $request)
    {
        return view('auth.login');
    }

    public function processLogin(Request $request)
    {
        $request->validate([
            'email' => ['required', 'string', 'email', 'max:255'],
            'password' => ['required', 'string', 'min:8'],
        ]);

        $user = User::whereIn('status', ['pending', 'active', 'suspended', 'inactive'])->where('email', $request->email)->first();
        
        if ($user) {
            if (password_verify($request->password, $user->password)) {
                if ($user->status == 'active') {
                    $authAttempted = Auth::attempt(['email' => $request->email, 'password' => $request->password]);

                    if ($authAttempted) {
                        return redirect()->intended('/home');
                    }
                }
                elseif ($user->status == 'pending') {
                    session()->flash('info', 'Your account must be verified by an admin before you can login');
                    return redirect()->back();
                }
                elseif ($user->status == 'suspended') {
                    session()->flash('error', 'Your account has been suspended by an admin. If you feel this is an error, kindly contact the admin.');
                    return redirect()->back();
                }
            }
        }
        
        // If the code execution was not stopped before getting here, then invalid records was submitted
        session()->flash('error', 'These credentials do not match our records.');
        return redirect()->back();
    }
}
