<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('home');
    }

    public function allUsers(Request $request)
    {
        $status = $request->status;
        $users = User::role('user');

        if ($status) {
            $users = $users->where('status', trim($status));
        }

        $users = $users->paginate(10);

        return view('users', compact('users'));
    }

    public function activateUser(Request $request, $id)
    {
        $getUser = User::where('id', $id)->role('user')->first();

        if ($getUser) {
            $getUser->status = 'active';
            $getUser->save();

            session()->flash('success', 'User\'s account has been activated successfully.');
            return redirect()->back();
        }

        session()->flash('error', 'We could not complete your request at this time. Please try again.');
        return redirect()->back();
    }

    public function suspendUser(Request $request, $id)
    {
        $getUser = User::where('id', $id)->role('user')->first();

        if ($getUser) {
            $getUser->status = 'suspended';
            $getUser->save();

            session()->flash('success', 'User\'s account has been suspended successfully.');
            return redirect()->back();
        }

        session()->flash('error', 'We could not complete your request at this time. Please try again.');
        return redirect()->back();
    }
}
