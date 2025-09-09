@extends('layouts.navigation')

@section('title', 'Publicaciones')

@section('content')

<style>
  .form-wrapper {
    max-width: 600px;
    margin: 40px auto;
    padding: 30px;
    border-radius: 12px;
    background-color: #ffffff;
    box-shadow: 0 4px 16px rgba(0,0,0,0.1);
    font-family: 'Segoe UI', sans-serif;
  }

  .form-wrapper h2 {
    text-align: center;
    margin-bottom: 25px;
    color: #333;
  }

  .form-group {
    margin-bottom: 20px;
  }

  .form-group label {
    display: block;
    font-weight: 600;
    margin-bottom: 6px;
    color: #555;
  }

  .form-group input[type="text"],
  .form-group textarea,
  .form-group input[type="file"],
  .form-group select {
    width: 100%;
    padding: 10px 12px;
    border: 1px solid #ccc;
    border-radius: 8px;
    font-size: 15px;
    transition: border 0.3s;
  }

  .form-group input:focus,
  .form-group textarea:focus,
  .form-group select:focus {
    outline: none;
    border-color: #007bff;
    box-shadow: 0 0 0 2px rgba(0,123,255,0.1);
  }

  .alert-danger {
    background-color: #f8d7da;
    color: #842029;
    border: 1px solid #f5c2c7;
    border-radius: 8px;
    padding: 15px;
    margin-bottom: 20px;
  }

  .btn-wrapper {
    display: flex;
    justify-content: space-between;
    gap: 10px;
  }

  .btn-primary, .btn-secondary {
    padding: 10px 20px;
    font-size: 15px;
    border: none;
    border-radius: 8px;
    cursor: pointer;
    transition: 0.3s;
  }

  .btn-primary {
    background-color: #007bff;
    color: white;
  }

  .btn-primary:hover {
    background-color: #0056b3;
  }

  .btn-secondary {
    background-color: #6c757d;
    color: white;
  }

  .btn-secondary:hover {
    background-color: #565e64;
  }

  /* Vista previa de medios */
  #preview {
    margin-top: 15px;
  }

  #preview img, #preview video {
    max-width: 100%;
    max-height: 350px;
    border-radius: 8px;
    margin-top: 10px;
    object-fit: cover;
  }
</style>

<div class="form-wrapper">
  <h2>Planeta Mascota</h2>

  @if ($errors->any())
      <div class="alert alert-danger">
          <strong>¡Ups!</strong> Hubo algunos problemas con tus datos:
          <ul>
              @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
              @endforeach
          </ul>
      </div>
  @endif

  <form action="{{ route('publicaciones.store') }}" method="POST" enctype="multipart/form-data">
      @csrf

      <div class="form-group">
          <label for="titulo">Título</label>
          <input type="text" name="titulo" id="titulo" value="{{ old('titulo') }}" required>
      </div>

      <div class="form-group">
          <label for="descripcion">Descripción</label>
          <textarea name="descripcion" id="descripcion" rows="4">{{ old('descripcion') }}</textarea>
      </div>

      <div class="form-group">
          <label for="especie">Especie</label>
          <select name="especie" id="especie" required>
              <option value="">Selecciona especie</option>
              <option value="Felina" {{ old('especie') == 'Felina' ? 'selected' : '' }}>Felina</option>
              <option value="Canino" {{ old('especie') == 'Canino' ? 'selected' : '' }}>Canino</option>
              <option value="Otro" {{ old('especie') == 'Otro' ? 'selected' : '' }}>Otro</option>
          </select>
      </div>

      <div class="form-group">
          <label for="edad">Edad</label>
          <select name="edad" id="edad" required>
              <option value="">Selecciona edad</option>
              <option value="Cachorro" {{ old('edad') == 'Cachorro' ? 'selected' : '' }}>Cachorro</option>
              <option value="Adulto" {{ old('edad') == 'Adulto' ? 'selected' : '' }}>Adulto</option>
          </select>
      </div>

      <div class="form-group">
          <label for="estado">Estado</label>
          <select name="estado" id="estado" required>
              <option value="">Selecciona estado</option>
              <option value="Disponible" {{ old('estado') == 'Disponible' ? 'selected' : '' }}>Disponible</option>
              <option value="Adoptada" {{ old('estado') == 'Adoptada' ? 'selected' : '' }}>Adoptada</option>
          </select>
      </div>

      <div class="form-group">
          <label for="media">Archivo multimedia </label>
          <input type="file" name="media" id="media" accept="image/*,video/mp4,video/webm">
      </div>

      <div id="preview"></div>

      <div class="btn-wrapper">
          <button type="submit" class="btn-primary">📤 Publicar</button>
          <a href="{{ route('publicaciones.index') }}" class="btn-secondary">❌ Cancelar</a>
      </div>
  </form>
</div>

<script>
  const mediaInput = document.getElementById('media');
  const preview = document.getElementById('preview');

  mediaInput.addEventListener('change', function() {
    preview.innerHTML = '';
    const file = this.files[0];
    if (!file) return;

    const ext = file.name.split('.').pop().toLowerCase();
    if(['jpg','jpeg','png','gif'].includes(ext)){
      const img = document.createElement('img');
      img.src = URL.createObjectURL(file);
      preview.appendChild(img);
    } else if(['mp4','webm'].includes(ext)){
      const video = document.createElement('video');
      video.src = URL.createObjectURL(file);
      video.controls = true;
      preview.appendChild(video);
    }
  });
</script>

@endsection
