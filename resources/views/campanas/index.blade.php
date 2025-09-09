@extends('layouts.navigation')

@section('title', 'Lista de Campañas de Esterilización')

@section('content')
<div class="container mt-4">
    <h2>Campañas de Esterilización</h2>
    <a href="{{ route('campanas.create') }}" class="btn btn-success mb-3">Crear Nueva Campaña</a>
    
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if($campanas->isEmpty())
        <p>No hay campañas registradas.</p>
    @else
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Fechas</th>
                <th>Descripción</th>
                <th>Criterios</th>
                <th>Publicado por</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($campanas as $campana)
            <tr>
                <td>{{ $campana->id_campana }}</td>
                <td>{{ $campana->fecha_inicio->format('d/m/Y') }} → {{ $campana->fecha_fin->format('d/m/Y') }}</td>
                <td>{{ $campana->descripcion }}</td>
                <td>{{ $campana->criterios }}</td>
                <td>{{ $campana->user->name ?? 'Desconocido' }}</td>
                <td>
                   
                    <a href="{{ route('campanas.edit', $campana->id_campana) }}" class="btn btn-warning btn-sm">Editar</a>
                    <form action="{{ route('campanas.destroy', $campana->id_campana) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger btn-sm" onclick="return confirm('¿Eliminar campaña?')">Eliminar</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @endif
</div>
@endsection
