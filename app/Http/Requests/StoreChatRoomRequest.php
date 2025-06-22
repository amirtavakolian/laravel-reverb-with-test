<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Hash;

class StoreChatRoomRequest extends FormRequest
{

    public function rules(): array
    {
        return [
            "name" => "required|min:3",
            "password" => "nullable|min:5",
            "limit" => "nullable|numeric|max:100",
            "status" => "required|in:0,1"
        ];
    }

    protected function passedValidation()
    {
        $extraFields['joining_link'] = generateUniqueJoiningLink();

        if ($this->input('password')) {
            $extraFields['password'] = Hash::make($this->input('password'));
        }

        $extraFields['user_id'] = auth()->user()->id;

        $this->merge($extraFields);
    }
}

