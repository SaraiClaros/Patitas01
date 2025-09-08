
<!DOCTYPE html>
<html lang="en">
<head>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adopta</title>
    <style>
    body {
    font-family: Arial, sans-serif;
    background-color: #f3f3f3;
    margin: 0;
    padding: 20px;
}
h1{
    color: #e491a8;
}
h2{
    color: #FF8C69;
}

.titulo {
    text-align: center;
    margin-bottom: 30px;
    color: #333;
}

.contenedor-tarjetas {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(220px, 1fr));
    gap: 20px;
    padding: 0 40px;
}

.tarjeta {
    background-color: white;
    border-radius: 10px;
    box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    padding: 20px;
    text-align: center;
}

.foto-mascota {
    width: 100%;
    height: 180px;
    object-fit: cover;
    border-radius: 8px;
    margin-bottom: 15px;

    .btn-info {
        display: inline-block;
        margin-top: 10px;
        padding: 8px 12px;
        background-color: #e491a8;
        color: white;
        text-decoration: none;
        border-radius: 5px;
        font-weight: bold;
        transition: background-color 0.3s;
    }

    .btn-info:hover {
        background-color: #d37590;
    }
}
</style>



<body>
    <h1>Mascotas Disponibles para Adopción</h1>
    
        <h2>Adopta con responsabilidad</h2>
       
        <div class="contenedor-tarjetas">
            @foreach ($mascotas as $mascota)
                <div class="tarjeta">
                    <img src="{{ asset('storage/' . $mascota->foto) }}" alt="Foto de {{ $mascota->nombre }}" class="foto-mascota">
                    <p><strong>ID:</strong> {{ $mascota->ID_mascota_adop }}</p>
                    <h2>{{ $mascota->nombre }}</h2>
                    <p><strong>Edad:</strong> {{ $mascota->edad }}</p>
                     <a href="{{ route('mascotas.show', $mascota->ID_mascota_adop) }}" class="btn-info">
        Más información
    </a>
                </div>
        @endforeach
        </div>
   @if(session('success'))
<script>
    Swal.fire({
        title: '¡Solicitud enviada!',
        text: 'Tu solicitud de adopción ha sido enviada con éxito.',
        icon: 'success',
        confirmButtonText: 'Aceptar',
        confirmButtonColor: '#3085d6'
    });
</script>
@endif
</body>
</html>