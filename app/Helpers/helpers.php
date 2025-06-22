<?php

use App\Models\ChatRoom;

function generateUniqueJoiningLink(): string
{
    $link = substr(str_shuffle('0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'), 0, 7);

    if (ChatRoom::query()->where('joining_link', $link)->exists()) {
        return generateUniqueJoiningLink();
    }

    return $link;
}
