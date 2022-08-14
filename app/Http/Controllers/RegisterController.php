<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class RegisterController extends Controller
{
    public function index(Request $request)
    {
        return view('auth.register');
    }

    public function processRegister(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'phone' => ['required', 'min:9', 'regex:/[0-9]{9,20}/'],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
        ]);

        $role = Role::where('name', 'user')->first();
        if (!$role) {
            Role::create([
                'name' => 'user',
            ]);

            Role::create([
                'name' => 'admin',
            ]);
        }

        $user->assignRole("user");

        session()->flash('info', 'Registration successful. Your account must be verified by an admin before you can login');
        return redirect('login');
    }
}
