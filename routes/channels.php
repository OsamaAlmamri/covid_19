<?php

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

use App\Order;

Broadcast::channel('App.User.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});


//Broadcast::channel('order.{orderId}', function ($user, $order) {
////    return $user->id === Order::findOrNew($orderId)->user_id;
//     return ($user->id === $order->user_id);
////    return false ;
//},['guards' => ['web', 'admin']]);
