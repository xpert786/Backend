<?php

use Illuminate\Support\Facades\Broadcast;
use App\Broadcasting\NewMessageChannel;

/*
|--------------------------------------------------------------------------
| Broadcast Channels
|--------------------------------------------------------------------------
|
| Here you may register all of the event broadcasting channels that your
| application supports. The given channel authorization callbacks are
| used to check if an authenticated user can listen to the channel.
|
*/

Broadcast::channel('App.Models.User.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});

// Broadcast::channel('chat.{userId}', NewMessageChannel::class);
/* Broadcast::channel('chat', function () {
    return true; // Allow all authenticated users to listen to the 'chat' channel
});
 */
Broadcast::channel('chat', function ($user) {
    return Auth::check();
  });
  