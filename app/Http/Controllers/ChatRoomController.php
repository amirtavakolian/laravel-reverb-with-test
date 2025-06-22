<?php

namespace App\Http\Controllers;

use App\Events\PublicMessageSent;
use App\Http\Requests\PublicMessageRequest;
use App\Http\Requests\StoreChatRoomRequest;
use App\Models\ChatRoom;
use App\Models\PublicChatRoom;
use Illuminate\Support\Facades\Hash;

class ChatRoomController extends Controller
{

    public function index()
    {
        $chatRooms = ChatRoom::all();

        return view('chat.chat-room', compact('chatRooms'));
    }

    public function store(StoreChatRoomRequest $request)
    {
        ChatRoom::query()->create($request->all());

        return redirect()->back()->with('chat_room_created_successfully', 'chat room created successfully');
    }

    public function enter(ChatRoom $chatRoom)
    {
        return view('chat.public-chat', compact('chatRoom'));
    }

    public function publicMessage(PublicMessageRequest $request)
    {
        PublicChatRoom::query()->create($request->validated());

        broadcast(new PublicMessageSent($request->input('message'), $request->input('chatroom_id')));
    }
}
