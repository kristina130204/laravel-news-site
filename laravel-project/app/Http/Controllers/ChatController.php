<?php

namespace App\Http\Controllers;

use App\Events\MessageSent;
use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
    public function fetchMessages()
    {
        return Message::with('user')->get();
    }
    public function allMessages()
    {
        $messages = Message::paginate(10);
        return view('admin.messages.index', compact('messages'));
    }
    public function sendMessage(Request $request)
    {
        $user = Auth::user();
        if(!($user->banned)){
            $message = $user->messages()->create([
            'message' => $request->input('message'),
            ]);
            broadcast(new MessageSent($user, $message))->toOthers();
            return ['status' => 'sent'];
        }
        return ['status' => 'banned'];
    }
    public function deleteMessage(Message $message)
    {
        $message->delete();
        return redirect()->back();
    }
}
