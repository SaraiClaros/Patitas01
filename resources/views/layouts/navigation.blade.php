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

        <a href="{{ route('campanas.create') }}">Publicar C.E.</a>
        <a href="{{ route('solicitudes.index') }}">Recibir solicitudes C.E.</a>


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
    <!-- Cierre de sesión -->
    <form method="POST" action="{{ route('logout') }}" style="margin-top: 20px; padding: 0 20px;">
        @csrf
        <button type="submit" style="background: none; border: none; color: white; text-align: left; padding: 10px 0; width: 100%;">
            🚪 Cerrar sesión
        </button>
    </form>
  </div>

  <!-- Menú de usuario arriba a la derecha -->
  @auth
  <div class="user-menu" style="position: absolute; top: 10px; right: 10px; z-index: 9999;">
      <div style="position: relative;">
          <button id="dropdownToggle" onclick="toggleDropdown()" 
              style="background:none; border:none; cursor:pointer; color:black; font-weight:bold; 
              font-size: 1.2rem; 
              text-align: center; 
              padding-top: 8px;  
              width: 150px; 
              display: block;">
              {{ Auth::user()->name }}
          </button>

          <div id="dropdown" style="display:none; position:absolute; top:100%; right:0; background:white; border:1px solid #ccc; padding:0.5rem; box-shadow:0 4px 8px rgba(0,0,0,0.1); min-width:150px; z-index:9999;">
              <a href="{{ route('profile.edit') }}" style="color:black; text-decoration:none; padding:0.3rem; display: block;">
                  Actualizar Perfil
              </a>

              <form method="POST" action="{{ route('logout') }}" style="margin:0;">
                  @csrf
                  <button type="submit" style="background:none; border:none; padding:0.3rem; cursor:pointer; color:black; width: 100%; text-align: left;">
                      Cerrar sesión
                  </button>
              </form>
          </div>
      </div>
  </div>
  @endauth

  <!-- Header -->
  @isset($header)
  <header class="bg-white shadow">
      <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
          {{ $header }}
      </div>
  </header>
  @endisset

  <!-- Contenido principal -->
  <div class="content">
      @yield('content')
  </div>

  <!-- Scripts -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

  <script>
      function toggleDropdown() {
          const dropdown = document.getElementById('dropdown');
          dropdown.style.display = dropdown.style.display === 'none' ? 'block' : 'none';
      }

      document.addEventListener('click', function(e) {
          const dropdown = document.getElementById('dropdown');
          const toggle = document.getElementById('dropdownToggle');
          if (dropdown && toggle && !toggle.contains(e.target) && !dropdown.contains(e.target)) {
              dropdown.style.display = 'none';
          }
      });
  </script>

</body>
</html>
