<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Publicacion;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Notifications\PublicacionCreada;
use App\Notifications\PublicacionComentada;
use App\Notifications\PublicacionLike;

class PublicacionController extends Controller
{
    // Mostrar todas las publicaciones
    public function index()
    {
        $publicaciones = Publicacion::with('user', 'comentarios', 'reacciones')->latest()->get();
        return view('publicaciones.index', compact('publicaciones'));
    }

    // Mostrar formulario para crear publicación
    public function create()
    {
        return view('publicaciones.create');
    }

    // Guardar publicación en la base de datos
    public function store(Request $request)
    {
        // Validación de campos
        $request->validate([
            'titulo' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'media' => 'nullable|file|mimes:jpg,jpeg,png,gif,mp4,webm|max:20480', // 20MB
            'especie' => 'required|string|in:Felina,Canino,Otro',
            'edad' => 'required|string|in:Cachorro,Adulto',
            'estado' => 'required|string|in:Disponible,Adoptada',
        ]);

        $mediaPath = null;

        // Guardar archivo multimedia si se subió
        if ($request->hasFile('media')) {
            $file = $request->file('media');
            $mediaPath = $file->store('imagenes', 'public'); // ruta relativa
        }

        // Crear la publicación
        $publicacion = Publicacion::create([
            'titulo' => $request->titulo,
            'descripcion' => $request->descripcion,
            'media' => $mediaPath,
            'user_id' => auth()->id(),
            'especie' => $request->especie,
            'edad' => $request->edad,
            'estado' => $request->estado,
        ]);

        // Enviar notificación al usuario que creó la publicación
        auth()->user()->notify(new PublicacionCreada($publicacion));

        return redirect()->route('publicaciones.index')->with('success', 'Publicación creada correctamente.');
    }

    // Método para manejar los likes
    public function like(Publicacion $publicacion)
    {
        $user = auth()->user();

        // Evitar que un usuario dé like más de una vez
        if (!$publicacion->reacciones()->where('user_id', $user->id)->exists()) {
            $publicacion->reacciones()->create([
                'user_id' => $user->id,
                'tipo' => 'love',
            ]);

            // Notificar al dueño de la publicación
            if ($publicacion->user->id !== $user->id) {
                $publicacion->user->notify(new NuevaReaccion($publicacion, $user));
            }
        }

        return back();
    }

    // Método para agregar comentarios
    public function comentar(Request $request, Publicacion $publicacion)
    {
        $request->validate([
            'contenido' => 'required|string|max:500',
        ]);

        $comentario = $publicacion->comentarios()->create([
            'user_id' => auth()->id(),
            'contenido' => $request->contenido,
        ]);

        // Notificar al dueño de la publicación
        if ($publicacion->user->id !== auth()->id()) {
            $publicacion->user->notify(new NuevoComentario($publicacion, auth()->user(), $comentario));
        }

        return back();
    }
}
