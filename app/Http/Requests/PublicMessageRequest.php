<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PublicMessageRequest extends FormRequest
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
