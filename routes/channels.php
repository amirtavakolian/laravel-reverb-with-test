<?php

use Illuminate\Support\Facades\Broadcast;
use Illuminate\Support\Facades\Log;

/*Broadcast::channel('App.Models.User.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});*/

Broadcast::channel('user-registered', function ($user) {
    return $user->isAdmin();
});

Broadcast::channel('chat-room.{chatRoomId}', function ($user, $roomId) {
    return ['name' => $user->name, 'id' => $user->id];
});

Broadcast::channel('private-chat.{receiverId}', function ($user, $receiverId) {
    return (int) $user->id === (int) $receiverId;
});

