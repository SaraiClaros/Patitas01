<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Mi App')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            display: flex;
            height: 100vh;
            margin: 0;
        }

        .main-content {
            margin-left: 220px; 
            padding: 20px; 
        }

        .sidebar {
            position: fixed; 
            top: 0;
            left: 0;
            height: 100vh; 
            width: 220px;
            background-color: rgb(12, 12, 12);
            color: white;
            padding: 20px 0;
            overflow-y: auto; 
            z-index: 1000; 
        }

        .sidebar a {
            color: white;
            padding: 10px 20px;
            display: block;
            text-decoration: none;
        }
        .sidebar a:hover {
            background-color: #495057;
        }

        .content {
            flex: 1;
            padding: 20px;
            overflow-y: auto;
            margin-left: 220px;
        }
    </style>
</head>
<body>

    <div class="sidebar">
        <h4 class="text-center">Menú</h4>
        <a href="{{ route('publicaciones.index') }}">🏠 Home</a>
        <a href="{{ route('publicaciones.create') }}">📸 Crear Publicación</a>
        <a href="{{ route('adopta.index') }}">🐾 Ver Mascotas en adopción</a>
        <a href="{{ route('publicaciones.create') }}">🔍 Buscar</a>
        <a href="{{ route('publicaciones.index') }}">🌍 Explorar</a>
        @auth
        @if (Auth::user()->tipo_usuario === 'refugio')
            <a href="{{ route('mascotaAdopcion.create') }}">🐶 Publicar mascota en adopción</a>
        @endif
    @endauth

    @auth
        @if (Auth::user()->tipo_usuario === 'veterinaria')
<<<<<<< HEAD

        <a href="{{ route('campanas.create') }}">Publicar C.E.</a>
        <a href="{{ route('solicitudes.index') }}">Recibir solicitudes C.E.</a>
         <a href="{{ route('campanas.index') }}">Control C.E.</a>



=======
>>>>>>> 3fb9ab4 (Guarda cambios antes del rebase)
        <div class="dropdown" data-bs-display="static">
            <a class="btn btn-secondary dropdown-toggle w-100" href="#" role="button"
            id="menuDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                🗂️ Expedientes
            </a>
            <ul class="dropdown-menu dropdown-menu-dark w-100" aria-labelledby="menuDropdown">
                <li><a class="dropdown-item" href="{{ route('duenos.index') }}">Dueños</a></li>
                <li><a class="dropdown-item" href="{{ route('mascotas.index') }}">Mascotas</a></li>
                <li><a class="dropdown-item" href="{{ route('consultas.index') }}">Consultas</a></li>
                <li><a class="dropdown-item" href="{{ route('historial.index') }}">Historial Médico</a></li>
                <li><a class="dropdown-item" href="{{ route('vacunaciones.index') }}">Vacunaciones</a></li>
                <li><a class="dropdown-item" href="{{ route('tratamientos.index') }}">Tratamientos</a></li>
                <li><a class="dropdown-item" href="{{ route('tratamientos.index') }}">Descargar Reporte</a></li>
                <li><a class="dropdown-item" href="{{ route('tratamientos.index') }}">Enviar Reporte</a></li>
            </ul>
        </div>
        @endif
    @endauth

    <a href="{{ route('profile.edit') }}">👤 Perfil</a>

    <!-- Botón de notificaciones como enlace -->
    <a href="{{ route('notificaciones.index') }}">🔔 Notificaciones</a>

    <!-- Cierre de sesión -->
    <form method="POST" action="{{ route('logout') }}" class="mt-3 px-3">
        @csrf
        <button type="submit" style="background: none; border: none; color: white; text-align: left; padding: 10px 0; width: 100%;">
            🚪 Cerrar sesión
        </button>
    </form>
  </div>

  <!-- Contenido principal -->
  <div class="content">
      @yield('content')
  </div>

  <!-- Scripts -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
