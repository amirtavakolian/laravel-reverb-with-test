<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PublicChatRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'message' => 'required',
            'chatroom_id' => 'required|exists:chat_rooms,id',
            'sender_id' => 'required|exists:users,id'
        ];
    }
}
