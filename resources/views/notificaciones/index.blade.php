@extends('layouts.navigation')

@section('title', 'Notificaciones')

@section('content')
<h1 style="text-align:center; margin-bottom:20px;">Notificaciones</h1>

@if($notificaciones->isEmpty())
    <p style="text-align:center;">No tienes notificaciones nuevas.</p>
@else
    <ul style="list-style:none; padding:0; max-width:600px; margin:0 auto;">
        @foreach($notificaciones as $notif)
            @php
                $isUnread = is_null($notif->read_at);
                $titulo = $notif->data['titulo'] ?? 'Nueva notificación';
                $mensaje = $notif->data['mensaje'] ?? '';
                $url = $notif->data['url'] ?? '#';
            @endphp
            <li style="margin-bottom: 15px; padding: 15px; border-radius:8px; 
                       background-color: {{ $isUnread ? '#eaf5ff' : '#f9f9f9' }};
                       border-left: 5px solid {{ $isUnread ? '#007bff' : '#ccc' }};">
                <a href="{{ $url }}" style="text-decoration:none; color:#333;">
                    <strong>{{ $titulo }}</strong><br>
                    <span>{{ $mensaje }}</span><br>
                    <small style="color:#666;">{{ $notif->created_at->diffForHumans() }}</small>
                </a>

                @if($isUnread)
                    <form action="{{ route('notificaciones.leer', $notif->id) }}" method="POST" style="margin-top:5px;">
                        @csrf
                        <button type="submit" style="padding:5px 10px; font-size:12px; border-radius:4px; border:none; background:#007bff; color:white;">Marcar como leído</button>
                    </form>
                @endif
            </li>
        @endforeach
    </ul>
@endif
@endsection
