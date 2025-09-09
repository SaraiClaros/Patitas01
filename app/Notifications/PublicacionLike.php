<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use App\Models\Reaccion;
use Illuminate\Notifications\Messages\DatabaseMessage;

class PublicacionLike extends Notification
{
    use Queueable;

    private $reaccion;

    public function __construct(Reaccion $reaccion)
    {
        $this->reaccion = $reaccion;
    }

    public function via($notifiable)
    {
        return ['database'];
    }

    public function toDatabase($notifiable)
    {
        return [
            'titulo' => 'Tu publicación recibió un like',
            'mensaje' => $this->reaccion->user->name . ' le dio like a tu publicación',
            'publicacion_id' => $this->reaccion->publicacion_id,
        ];
    }
}
