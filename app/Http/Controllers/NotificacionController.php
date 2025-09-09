<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NotificacionController extends Controller
{
    // Mostrar todas las notificaciones del usuario autenticado
    public function index()
    {
        $user = auth()->user();

        // Traer todas las notificaciones (leídas y no leídas) ordenadas por fecha
        $notificaciones = $user->notifications()->latest()->get();

        // Marcar las notificaciones no leídas como leídas
        $user->unreadNotifications->markAsRead();

        // Retornar la vista con las notificaciones
        return view('notificaciones.index', compact('notificaciones'));
    }
}
