@extends('layouts.navigation')

@section('title', 'Listado de Solicitudes de Esterilización')

@section('content')
<div class="container mt-4">
    <h2>Solicitudes Registradas</h2>
    <hr>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

   

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre del dueño</th>
                <th>Correo</th>
                <th>Nombre de la mascota</th>
                <th>Especie</th>
                <th>Raza</th>
                <th>Sexo</th>
                <th>Fecha</th>
                <th>Descripción</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($solicitudes as $solicitud)
                <tr>
                    <td>{{ $solicitud->id_solicitud }}</td>
                    <td>{{ $solicitud->nombre_dueno }}</td>
                    <td>{{ $solicitud->correo }}</td>
                    <td>{{ $solicitud->nombre_mascota }}</td>
                    <td>{{ $solicitud->especie }}</td>
                    <td>{{ $solicitud->raza }}</td>
                    <td>{{ $solicitud->sexo }}</td>
                    <td>{{ $solicitud->fecha }}</td>
                    <td>{{ $solicitud->descripcion }}</td>
                    <td>
                        
                        
                        <form action="{{ route('solicitudes.destroy', $solicitud->id_solicitud) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm" onclick="return confirm('¿Eliminar solicitud?')">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="10" class="text-center">No hay solicitudes registradas.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
