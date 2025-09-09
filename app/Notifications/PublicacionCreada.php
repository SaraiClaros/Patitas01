<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use App\Models\Publicacion;
use Illuminate\Notifications\Messages\DatabaseMessage;

class PublicacionCreada extends Notification
{
    use Queueable;

    private $publicacion;

    public function __construct(Publicacion $publicacion)
    {
        $this->publicacion = $publicacion;
    }

    public function via($notifiable)
    {
        return ['database'];
    }

    public function toDatabase($notifiable)
    {
        return [
            'titulo' => '¡Publicación creada!',
            'mensaje' => 'Tu publicación "' . $this->publicacion->titulo . '" se ha subido correctamente.',
            'publicacion_id' => $this->publicacion->id,
        ];
    }
}
