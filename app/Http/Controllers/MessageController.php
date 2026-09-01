<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
    public function index()
    {
        $messages = Message::forUser(Auth::id())
            ->with(['sender', 'receiver'])
            ->latest()
            ->get();

        $unreadCount = Message::unreadForUser(Auth::id())->count();

        return view('messages.index', compact('messages', 'unreadCount'));
    }

    public function show($id)
    {
        $message = Message::findOrFail($id);

        if ($message->sender_id !== Auth::id() && $message->receiver_id !== Auth::id()) {
            abort(403);
        }

        $message->markAsRead();

        return view('messages.show', compact('message'));
    }

    public function create()
    {
        $users = User::where('id', '!=', Auth::id())
            ->orderBy('role')
            ->orderBy('name')
            ->get();

        return view('messages.create', compact('users'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'receiver_id' => ['required', 'exists:users,id'],
            'subject' => ['required', 'string', 'max:255'],
            'message' => ['required', 'string', 'max:5000'],
        ]);

        Message::create([
            'sender_id' => Auth::id(),
            'receiver_id' => $validated['receiver_id'],
            'subject' => $validated['subject'],
            'message' => $validated['message'],
        ]);

        return redirect()
            ->route('messages.index')
            ->with('success', 'Pesan berhasil dikirim.');
    }

    public function getUnreadCount()
    {
        $count = Message::unreadForUser(Auth::id())->count();

        return response()->json(['count' => $count]);
    }

    public function markAsRead($id)
    {
        $message = Message::where('id', $id)
            ->where('receiver_id', Auth::id())
            ->firstOrFail();

        $message->markAsRead();

        return response()->json(['success' => true]);
    }
}
