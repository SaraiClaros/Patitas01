<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>En Adopción: {{ $mascota->nombre }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f5f5f5;
            margin: 0;
            padding: 0;
        }
        .detalle {
            max-width: 900px;
            margin: 30px auto;
            background: #fff;
            padding: 20px;
            border-radius: 12px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
            display: flex;
            gap: 20px;
        }
        .foto {
            max-width: 300px;
            border-radius: 10px;
            border: 1px solid #ddd;
        }
        .info {
            flex: 1;
        }
        .info h1 {
            margin-bottom: 10px;
            color: #333;
        }
        .btn {
            display: inline-block;
            margin-top: 20px;
            padding: 10px 15px;
            background: #28a745;
            color: white;
            text-decoration: none;
            border-radius: 5px;
        }
        .btn:hover {
            background: #218838;
        }
        .btn-disabled {
            display: inline-block;
            margin-top: 20px;
            padding: 10px 20px;
            background: #6c757d;
            color: white;
            border-radius: 5px;
            font-weight: bold;
            cursor: not-allowed;
        }
    </style>
</head>
<body>

    <div class="detalle">
        <img src="{{ asset('storage/'.$mascota->foto) }}" alt="{{ $mascota->nombre }}" class="foto">

        <div class="info">
            <h1>En Adopción: {{ $mascota->nombre }}</h1>
            <p><strong>Especie:</strong> {{ $mascota->especie }}</p>
            <p><strong>Raza:</strong> {{ $mascota->raza }}</p>
            <p><strong>Edad:</strong> {{ $mascota->edad }} años</p>
            <p><strong>Sexo:</strong> {{ $mascota->sexo }}</p>
            <p><strong>Estado de Salud:</strong> {{ $mascota->estado_salud }}</p>
            <p><strong>Estado de Adopción:</strong> {{ $mascota->estado_adopcion }}</p>
            <p><strong>Descripción:</strong> {{ $mascota->descripcion }}</p>

            @auth
                @if (Auth::user()->tipo_usuario === 'usuario')
                    @php
                        $yaAplico = $mascota->solicitudes->where('usuario_id', Auth::id())->count() > 0;
                    @endphp

                    @if ($yaAplico)
                        <span class="btn btn-disabled">Solicitud enviada</span>
                    @else
                        <a href="{{ route('solicitudes.create', $mascota->ID_mascota_adop) }}" class="btn">
                            Adoptar
                        </a>
                    @endif
                @endif
            @endauth


            <a href="{{ route('adopta.index') }}" class="btn btn-back">⬅ Volver</a>

        </div>
    </div>

</body>
</html>
