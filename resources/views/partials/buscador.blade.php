@extends('layouts.navigation')

@section('title', 'Buscar')

@section('content')
<div style="display: flex; gap: 20px; margin: 20px;">
    <!-- Filtro lateral izquierdo -->
    <div style="flex: 1; border: 1px solid #ddd; border-radius: 8px; padding: 15px; background: #f9f9f9;">
        <h4>Filtrar resultados</h4>

        <form action="{{ route('busqueda') }}" method="GET">
            <!-- Mantener la búsqueda principal -->
            <input type="hidden" name="q" value="{{ request('q') }}">

            <!-- Tipo de búsqueda -->
            <div style="margin-bottom: 10px;">
                <h5>Buscar en</h5>
                <select name="tipo" style="width: 100%; padding: 6px; border-radius: 6px; border: 1px solid #ccc;">
                    <option value="" {{ request('tipo')=='' ? 'selected' : '' }}>Todo</option>
                    <option value="clinicas" {{ request('tipo')=='clinicas' ? 'selected' : '' }}>Clínicas</option>
                    <option value="refugios" {{ request('tipo')=='refugios' ? 'selected' : '' }}>Refugios</option>
                    <option value="publicaciones" {{ request('tipo')=='publicaciones' ? 'selected' : '' }}>Publicaciones</option>
                </select>
            </div>

            <!-- Orden -->
            <div style="margin-bottom: 10px;">
                <h5>Ordenar por</h5>
                <select name="orden" style="width: 100%; padding: 6px; border-radius: 6px; border: 1px solid #ccc;">
                    <option value="recientes" {{ request('orden')=='recientes' ? 'selected' : '' }}>Más recientes</option>
                    <option value="antiguas" {{ request('orden')=='antiguas' ? 'selected' : '' }}>Más antiguas</option>
                </select>
            </div>

            <!-- Especie -->
            <div>
                <h5>Especie</h5>
                <label><input type="checkbox" name="especie[]" value="Felina" {{ in_array('Felina', request('especie', [])) ? 'checked' : '' }}> Felina</label><br>
                <label><input type="checkbox" name="especie[]" value="Canino" {{ in_array('Canino', request('especie', [])) ? 'checked' : '' }}> Canino</label><br>
                <label><input type="checkbox" name="especie[]" value="Otro" {{ in_array('Otro', request('especie', [])) ? 'checked' : '' }}> Otro</label>
            </div>

            <!-- Estado -->
            <div>
                <h5>Estado</h5>
                <label><input type="checkbox" name="estado[]" value="Disponible" {{ in_array('Disponible', request('estado', [])) ? 'checked' : '' }}> Disponible</label><br>
                <label><input type="checkbox" name="estado[]" value="Adoptada" {{ in_array('Adoptada', request('estado', [])) ? 'checked' : '' }}> Adoptada</label>
            </div>

            <!-- Edad -->
            <div>
                <h5>Edad</h5>
                <label><input type="checkbox" name="edad[]" value="Cachorro" {{ in_array('Cachorro', request('edad', [])) ? 'checked' : '' }}> Cachorro</label><br>
                <label><input type="checkbox" name="edad[]" value="Adulto" {{ in_array('Adulto', request('edad', [])) ? 'checked' : '' }}> Adulto</label>
            </div>

            <!-- Botón aplicar filtro -->
            <div style="margin-top: 10px;">
                <button type="submit" style="padding: 6px 12px; border-radius: 6px; background: #007bff; color: white; border: none;">Aplicar filtro</button>
            </div>
        </form>
    </div>

    <!-- Resultados -->
    <div style="flex: 3;">
        @if(request('q'))
            <h3>Resultados para: "<strong>{{ request('q') }}</strong>"</h3>

            @if(request('tipo')=='' || request('tipo')=='clinicas')
                <h4>Clínicas</h4>
                <ul>
                    @forelse($clinicas as $clinica)
                        <li>{{ $clinica->nombre }} - {{ $clinica->direccion }}</li>
                    @empty
                        <li>No se encontraron clínicas.</li>
                    @endforelse
                </ul>
            @endif

            @if(request('tipo')=='' || request('tipo')=='refugios')
                <h4>Refugios</h4>
                <ul>
                    @forelse($refugios as $refugio)
                        <li>{{ $refugio->nombre }} - {{ $refugio->ubicacion }}</li>
                    @empty
                        <li>No se encontraron refugios.</li>
                    @endforelse
                </ul>
            @endif

            @if(request('tipo')=='' || request('tipo')=='publicaciones')
                <h4>Publicaciones</h4>
                <ul>
                    @forelse($publicaciones as $pub)
                        <li>{{ $pub->titulo }} - {{ $pub->descripcion }} <small>(Publicado por {{ $pub->user->name }})</small></li>
                    @empty
                        <li>No se encontraron publicaciones.</li>
                    @endforelse
                </ul>
            @endif
        @else
            <p>Escribe algo en la barra de búsqueda para comenzar.</p>
        @endif
    </div>
</div>
@endsection
