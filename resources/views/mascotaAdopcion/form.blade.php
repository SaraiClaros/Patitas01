<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    

</head>
<body>
    <h1>Formulario de Adopción para {{ $mascota->nombre }}</h1>

    <form action="{{ route('solicitudes.store',  $mascota->ID_mascota_adop) }}" method="POST">
        @csrf
        <input type="hidden" name="mascota_id" value="{{ $mascota->ID_mascota_adop }}">

        <label>Motivo de Adopción:</label>
        <textarea name="motivo" required></textarea><br>

        <label>Nombre completo:</label>
        <input type="text" name="Nombre" required><br>
        
        <label>DUI:</label>
        <input type="text" name="DUI" required><br>

        <label>Edad:</label>
        <input type="number" name="edad" min="18" max="80" required><br>

        <label>Teléfono:</label>
        <input type="tel" name="telefono" required><br>

        <label>Dirección:</label>
        <input type="text" name="direccion" required><br>

        <label>Casa propia o Alquilada:</label>
        <select name="tipo_casa" required>
            <option value="Casa propia">Casa Propia</option>
            <option value="Casa Alquilada">Casa Alquilada</option>
        </select><br>

        <label>¿Cuántas personas viven con usted?:</label>
        <input type="number" name="personas_casa" required><br>

        <label>¿Estas personas están enteradas y de acuerdo con su interés por adoptar?:</label>
        <select name="personas_enteradas" required>
            <option value="Si">Si</option>
            <option value="No">No</option>
        </select><br>

        <label>¿Tiene mascotas?:</label>
        <select name="mascotas_casa" required>
            <option value="Si tengo">Si</option>
            <option value="No tengo">No</option>
        </select><br>

        <label>¿Está de acuerdo a que se hagan visitas mensuales a su casa?:</label>
        <select name="visitas" required>
            <option value="Estoy de acuerdo">Si</option>
            <option value="No estoy de acuerdo">No</option>
        </select><br>

        <button type="submit">Enviar Solicitud</button>
    </form>
</body>



</html>