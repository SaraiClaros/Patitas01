@extends('layouts.navigation')

@section('title', 'Publicaciones')

@section('content')

<style>
  .container {
    max-width: 500px;
    margin: 40px auto;
    padding: 20px;
    box-shadow: 0 4px 8px rgba(0,0,0,0.1);
    border-radius: 8px;
    background-color: #fff;
    font-family: Arial, sans-serif;
  }

  .card {
    max-width: 500px;
    border: 1px solid #ddd;
    border-radius: 8px;
    overflow: hidden;
    margin-bottom: 30px;
    box-shadow: 0 2px 6px rgba(0,0,0,0.1);
  }

  .card img, .card video {
    width: 100%;
    max-height: 350px;
    object-fit: cover;
    display: block;
  }

  .card-body {
    padding: 15px 20px;
  }

  .card-title {
    font-size: 24px;
    margin-bottom: 12px;
    font-weight: bold;
    color: #333;
  }

  .card-text {
    font-size: 16px;
    margin-bottom: 12px;
    color: #555;
  }

  .text-muted {
    font-size: 14px;
    color: #888;
    margin-bottom: 12px;
  }

  .btn-love {
    background-color: transparent;
    border: 2px solid #e0245e;
    color: #e0245e;
    padding: 8px 16px;
    font-size: 14px;
    border-radius: 20px;
    cursor: pointer;
    transition: all 0.3s ease;
  }
  .btn-love.loved {
    background-color: #e0245e;
    color: white;
  }
  .btn-love:hover {
    background-color: #e0245e;
    color: white;
  }

  .comentario {
    background-color: #f9f9f9;
    border-radius: 6px;
    padding: 8px 12px;
    margin: 8px 0;
    text-align: left;
    font-size: 14px;
  }

  textarea {
    width: 100%;
    padding: 8px 10px;
    font-size: 14px;
    border-radius: 6px;
    border: 1px solid #ccc;
    resize: vertical;
  }

  button[type="submit"] {
    margin-top: 8px;
    padding: 8px 16px;
    background-color: #007bff;
    border: none;
    color: white;
    font-size: 14px;
    border-radius: 6px;
    cursor: pointer;
  }
  button[type="submit"]:hover {
    background-color: #0056b3;
  }

  .search-bar {
    display: flex;
    justify-content: center;
    margin: 20px 0;
  }

  .search-bar input {
    width: 500px;
    padding: 6px 12px;
    border-radius: 25px;
    border: 1px solid #ccc;
    font-size: 14px;
  }
</style>

<h2 style="text-align: center; margin-bottom: 40px;">Publicaciones que pueden ser de tu interés</h2>

<div class="search-bar">
    <form action="{{ route('busqueda') }}" method="GET">
        <input 
            type="text" 
            name="q" 
            placeholder="🔍 Buscar..." 
            value="{{ request('q') }}">
    </form>
</div>

<div class="container">
    @foreach ($publicaciones as $publicacion)
        <div class="card">
            <p class="text-muted">
                Publicado por: <strong>{{ $publicacion->user->name }}</strong> | 
                Publicado el: {{ $publicacion->created_at->format('d/m/Y H:i') }}
            </p>

            {{-- Mostrar imagen o video desde storage --}}
            @if ($publicacion->media && file_exists(public_path('storage/' . $publicacion->media)))
                @php
                    $ext = strtolower(pathinfo($publicacion->media, PATHINFO_EXTENSION));
                @endphp

                @if (in_array($ext, ['jpg', 'jpeg', 'png', 'gif']))
                    <img src="{{ asset('storage/' . $publicacion->media) }}" alt="media" />
                @elseif (in_array($ext, ['mp4', 'webm']))
                    <video controls>
                        <source src="{{ asset('storage/' . $publicacion->media) }}" type="video/{{ $ext }}">
                        Tu navegador no soporta la reproducción de video.
                    </video>
                @endif
            @endif

            <div class="card-body">
                <h3 class="card-title">{{ $publicacion->titulo }}</h3>
                <p class="card-text">{{ $publicacion->descripcion }}</p>

                {{-- Botón love --}}
                <form action="{{ route('reacciones.love', $publicacion) }}" method="POST" style="display:inline;">
                    @csrf
                    <button type="submit" class="btn-love {{ $publicacion->reaccionesLove->contains('user_id', auth()->id()) ? 'loved' : '' }}">
                        ❤️ Love ({{ $publicacion->reaccionesLove->count() }})
                    </button>
                </form>

                <hr>

                <h4>Comentarios:</h4>
                @foreach ($publicacion->comentarios as $comentario)
                    <div class="comentario">
                        <strong>{{ $comentario->user->name }}</strong>: {{ $comentario->contenido }}
                    </div>
                @endforeach

                @auth
                <form action="{{ route('comentarios.store', $publicacion) }}" method="POST">
                    @csrf
                    <textarea name="contenido" rows="3" placeholder="Escribe un comentario..." required></textarea>
                    <button type="submit">Comentar</button>
                </form>
                @endauth
            </div>
        </div>
    @endforeach
</div>

@endsection
