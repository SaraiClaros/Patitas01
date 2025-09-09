@extends('layouts.navigation')

@section('title', 'Resultados de búsqueda')

@section('content')
<div style="display: flex; gap: 20px; margin: 20px; font-family: Arial, sans-serif;">

    <!-- Filtro lateral izquierdo -->
    <div style="flex: 1; border: 1px solid #ddd; border-radius: 8px; padding: 15px; background: #f9f9f9;">
        <h4 style="margin-bottom: 15px;">Filtrar resultados</h4>

        <form action="{{ route('busqueda') }}" method="GET">
            <input type="hidden" name="q" value="{{ request('q') }}">

            <!-- Tipo de búsqueda -->
            <div style="margin-bottom: 12px;">
                <label style="font-weight: bold;">Buscar en:</label>
                <select name="tipo" style="width: 100%; padding: 6px; border-radius: 6px; border: 1px solid #ccc;">
                    <option value="" {{ request('tipo')=='' ? 'selected' : '' }}>Todo</option>
                    <option value="clinicas" {{ request('tipo')=='clinicas' ? 'selected' : '' }}>Clínicas</option>
                    <option value="refugios" {{ request('tipo')=='refugios' ? 'selected' : '' }}>Refugios</option>
                    <option value="publicaciones" {{ request('tipo')=='publicaciones' ? 'selected' : '' }}>Publicaciones</option>
                </select>
            </div>

            <!-- Orden -->
            <div style="margin-bottom: 12px;">
                <label style="font-weight: bold;">Ordenar por:</label>
                <select name="orden" style="width: 100%; padding: 6px; border-radius: 6px; border: 1px solid #ccc;">
                    <option value="recientes" {{ request('orden')=='recientes' ? 'selected' : '' }}>Más recientes</option>
                    <option value="antiguas" {{ request('orden')=='antiguas' ? 'selected' : '' }}>Más antiguas</option>
                </select>
            </div>

            <!-- Especie -->
            <div style="margin-bottom: 12px;">
                <label style="font-weight: bold;">Especie:</label><br>
                <label><input type="checkbox" name="especie[]" value="Felina" {{ in_array('Felina', request('especie', [])) ? 'checked' : '' }}> Felina</label><br>
                <label><input type="checkbox" name="especie[]" value="Canino" {{ in_array('Canino', request('especie', [])) ? 'checked' : '' }}> Canino</label><br>
                <label><input type="checkbox" name="especie[]" value="Otro" {{ in_array('Otro', request('especie', [])) ? 'checked' : '' }}> Otro</label>
            </div>

            <!-- Estado -->
            <div style="margin-bottom: 12px;">
                <label style="font-weight: bold;">Estado:</label><br>
                <label><input type="checkbox" name="estado[]" value="Disponible" {{ in_array('Disponible', request('estado', [])) ? 'checked' : '' }}> Disponible</label><br>
                <label><input type="checkbox" name="estado[]" value="Adoptada" {{ in_array('Adoptada', request('estado', [])) ? 'checked' : '' }}> Adoptada</label>
            </div>

            <!-- Edad -->
            <div style="margin-bottom: 12px;">
                <label style="font-weight: bold;">Edad:</label><br>
                <label><input type="checkbox" name="edad[]" value="Cachorro" {{ in_array('Cachorro', request('edad', [])) ? 'checked' : '' }}> Cachorro</label><br>
                <label><input type="checkbox" name="edad[]" value="Adulto" {{ in_array('Adulto', request('edad', [])) ? 'checked' : '' }}> Adulto</label>
            </div>

            <button type="submit" style="padding: 6px 12px; border-radius: 6px; background: #007bff; color: white; border: none; cursor: pointer;">Aplicar filtro</button>
        </form>
    </div>

    <!-- Resultados -->
    <div style="flex: 3;">
        <form action="{{ route('busqueda') }}" method="GET" style="margin-bottom: 20px;">
            <input 
                type="text" 
                name="q" 
                placeholder="Buscar..." 
                value="{{ request('q') }}"
                style="width: 100%; padding: 8px 12px; border-radius: 25px; border: 1px solid #ccc; font-size: 14px;">
        </form>

        {{-- Clínicas --}}
        @if(request('tipo')=='' || request('tipo')=='clinicas')
            <h3>Clínicas</h3>
            <ul>
                @forelse($clinicas as $clinica)
                    <li>{{ $clinica->nombre }} - {{ $clinica->direccion }}</li>
                @empty
                    <li>No se encontraron clínicas.</li>
                @endforelse
            </ul>
        @endif

        {{-- Refugios --}}
        @if(request('tipo')=='' || request('tipo')=='refugios')
            <h3>Refugios</h3>
            <ul>
                @forelse($refugios as $refugio)
                    <li>{{ $refugio->nombre }} - {{ $refugio->ubicacion }}</li>
                @empty
                    <li>No se encontraron refugios.</li>
                @endforelse
            </ul>
        @endif

        {{-- Publicaciones --}}
        @if(request('tipo')=='' || request('tipo')=='publicaciones')
            <h3>Publicaciones</h3>
            <div style="display: flex; flex-wrap: wrap; gap: 15px;">
                @forelse($publicaciones as $pub)
                    <div style="border: 1px solid #ddd; border-radius: 8px; width: calc(50% - 7.5px); padding: 10px; box-shadow: 0 2px 8px rgba(0,0,0,0.05);">
                        @if($pub->media)
                            @php $ext = strtolower(pathinfo($pub->media, PATHINFO_EXTENSION)); @endphp

                            @if(in_array($ext, ['jpg','jpeg','png','gif']))
                                <img src="{{ asset('storage/' . $pub->media) }}" alt="imagen" style="width: 100%; height: 180px; object-fit: cover; border-radius: 8px; margin-bottom: 8px;">
                            @elseif(in_array($ext, ['mp4','webm']))
                                <video src="{{ asset('storage/' . $pub->media) }}" controls style="width: 100%; height: 180px; object-fit: cover; border-radius: 8px; margin-bottom: 8px;"></video>
                            @endif
                        @endif

                        <h5 style="margin: 5px 0;">{{ $pub->titulo }}</h5>
                        <p style="font-size: 14px; color: #555;">{{ $pub->descripcion }}</p>
                        <small style="color: #888;">Publicado por {{ $pub->user->name }} el {{ $pub->created_at->format('d/m/Y') }}</small>
                    </div>
                @empty
                    <p>No se encontraron publicaciones.</p>
                @endforelse
            </div>
        @endif
    </div>
</div>
@endsection
