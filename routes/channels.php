<?php

use App\Models\Chat;
use App\Models\User;
use Illuminate\Support\Facades\Broadcast;


Broadcast::channel('App.Models.User.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});


// Broadcast::channel('App.Models.Chat.{chat}', function (User $user, Chat $chat) {

//     $chat = $user->chats()->where('id', $chat)->first();

//     return empty($chat);

// });


Broadcast::channel('chats.{chatId}', function (User $user, int $chatId) {


    // $chat = $user->chats()->where('id', $chatId)->first();


    //  return empty($chat);


    return true;

    
});
