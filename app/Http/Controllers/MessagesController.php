<?php

namespace App\Http\Controllers;

use App\Models\messages;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class MessagesController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function userMessages()
    {
        $userID = auth()->user()->id;

        $messages = messages::where('user_id', $userID)->orderBy('created_at', 'DESC')->paginate(10);

        return view('view-messages', compact('messages'));
    }

    public function sendMessageForm()
    {
        return view('send-message');
    }

    public function submitMessageSent(Request $request)
    {
        $request->validate([
            'subject' => 'required|min:5|max:150',
            'body' => 'required|min:10',
        ]);

        $userID = auth()->user()->id;

        messages::create([
            'user_id' => $userID,
            'subject' => $request->subject,
            'message' => strip_tags(nl2br($request->body)),
        ]);

        session()->flash('success', 'Message sent successfully.');
        return redirect()->to(route('user-messages'));
    }

    public function allMessages()
    {
        $messages = messages::with('user')->paginate(10);

        return view('admin-view-messages', compact('messages'));
    }
}
