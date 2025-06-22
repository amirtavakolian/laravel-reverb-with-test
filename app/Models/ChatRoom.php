<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ChatRoom extends Model
{
    protected $fillable = ['name', 'password', 'limit', 'joining_link', 'user_id', 'status'];
    protected $with = ['messages'];

    public function messages()
    {
        return $this->hasMany(PublicChatRoom::class, 'chatroom_id');
    }
}
