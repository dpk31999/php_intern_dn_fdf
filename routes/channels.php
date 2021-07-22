<?php

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Broadcast;

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

// Broadcast::private('send-message-order-{id}', function ($user, $id) {
//     return false;
// });

// Broadcast::private('send-noti-user-order-admin', function ($user) {
//     return Auth::guard('admin')->check();
// });

// Broadcast::private('send-notification-order-pending', function ($user) {
//     return Auth::guard('admin')->check();
// });
