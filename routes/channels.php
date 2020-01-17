<?php
use App\Models\Carrera;

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

Broadcast::channel('carrera.{carrera_id}', function ($user, $carrera_id) {
    if (in_array('Administradores', $user->getRoleNames()->toArray())) {
        return true;
    } elseif (in_array('Conductores', $user->getRoleNames()->toArray())) {
        return (int) $user->id === (int) Carrera::find($carrera_id)->conductor_id;
    } elseif (in_array('Usuarios', $user->getRoleNames()->toArray())) {
        return (int) $user->id === (int) Carrera::find($carrera_id)->usuario_id;
    } else {
        return false;
    }
});

Broadcast::channel('nuevas.carreras.{carrera_id}', function ($user, $carrera_id) {
    if (in_array('Administradores', $user->getRoleNames()->toArray())) {
        return true;
    }
    return (int) $user->empresa_id === (int) Carrera::find($carrera_id)->empresa_id;
});
