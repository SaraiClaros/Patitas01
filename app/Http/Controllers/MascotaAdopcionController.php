<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MascotaAdopcion;
use App\Http\Controllers\Auth;

class MascotaAdopcionController extends Controller
{
     public function create()
    {
        return view('mascotaAdopcion.create');
    }

    public function store(Request $request)
{
    $request->validate([
        'foto' => 'required|image|mimes:jpg,jpeg,png|max:2048',
        'nombre' => 'required|string',
        'especie' => 'required|string',
        'raza' => 'required|string',
        'edad' => 'required|string',
        'sexo' => 'required|string',
        'estado_salud' => 'required|string',
        'fecha_registro' => 'required|date',
        'estado_adopcion' => 'required|string',
        'descripcion' => 'nullable|string',
    ]);

    
    if ($request->hasFile('foto')) {
        $rutaImagen = $request->file('foto')->store('mascotas', 'public');
    } else {
        return back()->with('error', 'No se cargó la imagen correctamente.');
    }
    if ($request->especie === 'Felino') {
    $request->merge(['raza' => 'Mestizo']);
}

    MascotaAdopcion::create([
        'foto' => $rutaImagen,
        'nombre' => $request->nombre,
        'especie' => $request->especie,
        'raza' => $request->raza,
        'edad' => $request->edad,
        'sexo' => $request->sexo,
        'estado_salud' => $request->estado_salud,
        'fecha_registro' => $request->fecha_registro,
        'estado_adopcion' => $request->estado_adopcion,
        'descripcion' => $request->descripcion,
        'usuario_id' => Auth::id(),
    ]);


    return redirect()->route('mascotaAdopcion.create')->with('success', 'Mascota registrada con éxito.');
}

public function index()
{
    $mascotas = MascotaAdopcion::all();
    return view('mascotaAdopcion.Adopta', compact('mascotas'));
}
public function show($id)
{
    $mascota = MascotaAdopcion::with('solicitudes')->findOrFail($id);
    return view('mascotaAdopcion.detalle', compact('mascota'));
}




}