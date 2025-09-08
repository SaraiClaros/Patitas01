@extends('layouts.navigation')

@section('title', 'Mascota en adopcion')

@section('content')
    <style>
    body {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        background-color: #fff8f9;
        padding: 40px;
        color: #333;
    }

    h1 {
        text-align: center;
        color: #e491a8;
    }

    form {
        max-width: 600px;
        margin: 0 auto;
        background-color: #ffffff;
        padding: 30px;
        border-radius: 10px;
        box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
        border-top: 10px solid #ffd747;
    }

    div {
        margin-bottom: 15px;
    }

    label {
        display: block;
        margin-bottom: 5px;
        font-weight: bold;
        color: #e491a8;
    }

    input[type="text"],
    input[type="date"],
    input[type="file"],
    select,
    textarea {
        width: 100%;
        padding: 10px;
        border: 2px solid #e491a8;
        border-radius: 5px;
        font-size: 14px;
        background-color: #fff9fa;
    }

    textarea {
        resize: vertical;
        min-height: 80px;
    }

    button {
        background-color: #e491a8;
        color: white;
        padding: 12px 20px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        font-weight: bold;
        font-size: 16px;
        width: 100%;
        transition: background-color 0.3s;
    }

    button:hover {
        background-color: #d47e96;
    }

    p {
        text-align: center;
        font-weight: bold;
    }
</style>
</head>
<body>
    <h1>Registrar Mascota en Adopción</h1>

    @if(session('success'))
        <p style="color:green">{{ session('success') }}</p>
    @endif

    <form action="{{ route('mascotas.store') }}" method="POST" enctype="multipart/form-data">

        @csrf
        <div>
        <label>Nombre:</label><br>
        <input type="text" name="nombre"></div><br><br>

        <div>
        <label for="especie">Especie:</label>
        <select id="especie" name="especie" required>
            <option value="">Selecciona</option>
            <option value="Felino">Felino</option>
            <option value="Canino">Canino</option>
        </select></div>

        <div id="campo-raza">
         <label for="raza">Raza:</label>
        <select id="raza" name="raza">
            <option value="Mestizo">Mestizo</option>
             <option value="Chihuahua">Chihuahua</option>
            <option value="Husky Siberiano">Husky Siberiano</option>
            <option value="French">French</option>
            <option value="Maltes">Maltes</option>
            </select>
    </div>

        
        <div>
        <label>Edad:</label><br>
        <select name="edad">
            <option value="Cachorro (0 - 6 meses)">Cachorro (0 - 6 meses)</option>
            <option value="Joven (7 meses - 1 año)">Joven (7 meses - 1 año)</option>
            <option value="Adulto joven (1 - 3 años)">Adulto joven (1 - 3 años)</option>
            <option value="Adulto (4 - 6 años)">Adulto (4 - 6 años)</option>
            <option value="Adulto mayor (7 - 9 años)">Adulto mayor (7 - 9 años) </option>
            <option value="Senior (10 años o más)">Senior (10 años o más)</option>
            </select></div>

        <div>
        <label>Sexo:</label><br>
         <select name="sexo">
            <option value="Hembra">Hembra</option>
            <option value="Macho">Macho</option></select></div>

        <div>
        <label>Estado de salud:</label><br>
        <select name="estado_salud">
            <option value="Saludable">Saludable</option>
            <option value="tratamiento médico">Con tratamiento médico</option>
            <option value="Discapacidad física">Discapacidad física</option>
            <option value="Condición crónica">Condición crónica</option>
        </select></div>

        <div>
        <label>Fecha de registro:</label><br>
        <input type="date" name="fecha_registro"></div>

        <div>
        <label>Estado de adopción:</label><br>
        <select name="estado_adopcion">
            <option value="Disponible">Disponible</option>
            <option value="En proceso">En proceso</option>
            <option value="Adoptado">Adoptado</option>
        </select></div>

        <div>
        <label>Descripción:</label><br>
        <textarea name="descripcion"></textarea></div>

        <div>
        <label for="Foto">Fotografía:</label>
            <input type="file" name="foto" id="foto" accept="image/*">
        </div>

        <button type="submit">Guardar</button>
    </form>
    <script>
    document.addEventListener('DOMContentLoaded', function () {
        const especieSelect = document.getElementById('especie');
        const campoRaza = document.getElementById('campo-raza');
        const inputRaza = document.getElementById('raza');

        function actualizarCampoRaza() {
            const especie = especieSelect.value.toLowerCase();

            if (especie === 'felino') {
                campoRaza.style.display = 'none';
                inputRaza.value = 'Mestizo';
                inputRaza.disabled = false; 
            } else {
                campoRaza.style.display = 'block';
                inputRaza.disabled = false;
                inputRaza.value = '';
            }
        }

        actualizarCampoRaza();
        especieSelect.addEventListener('change', actualizarCampoRaza);
    });
</script>
@endsection