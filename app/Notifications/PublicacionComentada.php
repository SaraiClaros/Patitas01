<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use App\Models\Comentario;
use Illuminate\Notifications\Messages\DatabaseMessage;

class PublicacionComentada extends Notification
{
    use Queueable;

    private $comentario;

    public function __construct(Comentario $comentario)
    {
        $this->comentario = $comentario;
    }

    public function via($notifiable)
    {
        return ['database'];
    }

    public function toDatabase($notifiable)
    {
        return [
            'titulo' => 'Nuevo comentario',
            'mensaje' => $this->comentario->user->name . ' comentó tu publicación: ' . $this->comentario->contenido,
            'publicacion_id' => $this->comentario->publicacion_id,
        ];
    }
}
