<?php

namespace App\Http\Controllers;

use App\Events\PrivateChatSent;
use App\Events\PublicMessageSent;
use App\Http\Requests\PrivateChatRequest;
use App\Http\Requests\PublicChatRequest;
use App\Models\PrivateChat;
use App\Models\PublicChatRoom;
use App\Models\User;


class ChatController extends Controller
{

    public function publicChat(PublicChatRequest $request)
    {
        PublicChatRoom::query()->create($request->validated());

        broadcast(new PublicMessageSent($request->input('message'), $request->input('chatroom_id')));
    }

    public function privateChat(PrivateChatRequest $request)
    {
        $privateMessage = PrivateChat::create([
            'sender_id' => auth()->user()->id,
            'receiver_id' => $request->receiver_id,
            'message' => $request->message,
        ]);

        $privateMessage = $privateMessage->toArray();

        $privateMessage['sender_firstname'] = User::query()->where('id', auth()->user()->id)->first()->name;
        $privateMessage['receiver_firstname'] = User::query()->where('id', $request->receiver_id)->first()->name;

        broadcast(new PrivateChatSent($privateMessage))->toOthers();

        return response()->json(['status' => 'sent']);

    }
}


