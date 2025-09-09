<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Clinica;
use App\Models\Refugio;
use App\Models\Publicacion;

class BusquedaController extends Controller
{
    public function index(Request $request)
    {
        $query = $request->input('q');

        // Si no hay búsqueda, devolver colecciones vacías
        if (!$query) {
            return view('busqueda', [
                'clinicas' => collect(),
                'refugios' => collect(),
                'publicaciones' => collect(),
            ]);
        }

        // Buscar en clínicas
        $clinicas = Clinica::query()
            ->where('nombre', 'like', "%{$query}%")
            ->orWhere('direccion', 'like', "%{$query}%")
            ->get();

        // Buscar en refugios
        $refugios = Refugio::query()
            ->where('nombre', 'like', "%{$query}%")
            ->orWhere('ubicacion', 'like', "%{$query}%")
            ->get();

        // Buscar en publicaciones
        $publicaciones = Publicacion::query()
            ->where('titulo', 'like', "%{$query}%")
            ->orWhere('descripcion', 'like', "%{$query}%")
            ->get();

        // Retornar vista con resultados organizados por categoría
        return view('busqueda', compact('clinicas', 'refugios', 'publicaciones'));
    }
}
