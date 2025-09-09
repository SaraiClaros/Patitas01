@extends('layouts.navigation')

@section('title', 'Registrar Solicitud de Esterilización')

@section('content')
<div class="container mt-4">
    <h2>Registrar Nueva Solicitud</h2>
    <hr>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('solicitudes.store') }}" method="POST">
        @csrf

        <h4>Datos del dueño</h4>
        <div class="mb-3">
            <label for="nombre_dueno" class="form-label">Nombre del dueño</label>
            <input type="text" name="nombre_dueno" id="nombre_dueno" class="form-control" value="{{ old('nombre_dueno') }}" required>
        </div>
        <div class="mb-3">
            <label for="correo" class="form-label">Correo</label>
            <input type="email" name="correo" id="correo" class="form-control" value="{{ old('correo') }}" required>
        </div>
        <div class="mb-3">
            <label for="estado_economico" class="form-label">Estado económico</label>
            <input type="text" name="estado_economico" id="estado_economico" class="form-control" value="{{ old('estado_economico') }}">
        </div>

        <h4>Datos de la mascota</h4>
        <div class="mb-3">
            <label for="nombre_mascota" class="form-label">Nombre de la mascota</label>
            <input type="text" name="nombre_mascota" id="nombre_mascota" class="form-control" value="{{ old('nombre_mascota') }}" required>
        </div>
        <div class="mb-3">
            <label for="especie" class="form-label">Especie</label>
            <input type="text" name="especie" id="especie" class="form-control" value="{{ old('especie') }}">
        </div>
        <div class="mb-3">
            <label for="raza" class="form-label">Raza</label>
            <input type="text" name="raza" id="raza" class="form-control" value="{{ old('raza') }}">
        </div>
        <div class="mb-3">
            <label for="sexo" class="form-label">Sexo</label>
            <select name="sexo" id="sexo" class="form-select">
                <option value="">-- Seleccione --</option>
                <option value="Macho" {{ old('sexo') == 'Macho' ? 'selected' : '' }}>Macho</option>
                <option value="Hembra" {{ old('sexo') == 'Hembra' ? 'selected' : '' }}>Hembra</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="fecha" class="form-label">Fecha</label>
            <input type="date" name="fecha" id="fecha" class="form-control" value="{{ old('fecha', date('Y-m-d')) }}" required>
        </div>

        <div class="mb-3">
            <label for="descripcion" class="form-label">Descripción (opcional)</label>
            <textarea name="descripcion" id="descripcion" class="form-control" rows="3">{{ old('descripcion') }}</textarea>
        </div>

        <button type="submit" class="btn btn-primary">Registrar Solicitud</button>
        <a href="{{ route('solicitudes.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection
