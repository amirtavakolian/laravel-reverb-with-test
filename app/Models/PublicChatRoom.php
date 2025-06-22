<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PublicChatRoom extends Model
{
    protected $table = 'public_chatroom';
    protected $fillable = ['message', 'chatroom_id', 'sender_id'];
    protected $with = ['sender'];

    public function sender()
    {
        return $this->belongsTo(User::class, 'sender_id');
    }

}


