<?php

namespace App\Http\Controllers;

use App\Models\SolicitudCE;
use Illuminate\Http\Request;

class SolicitudCEController extends Controller
{
    // Mostrar todas las solicitudes
    public function index()
    {
        $solicitudes = SolicitudCE::latest()->get();
        return view('solicitudes.index', compact('solicitudes'));
    }

    // Mostrar formulario de creación
    public function create()
    {
        return view('solicitudes.create');
    }

    // Guardar nueva solicitud
    public function store(Request $request)
    {
        $request->validate([
            'nombre_dueno'    => 'required|string|max:100',
            'correo'          => 'required|email|max:100',
            'estado_economico'=> 'nullable|string|max:50',
            'nombre_mascota'  => 'required|string|max:100',
            'especie'         => 'nullable|string|max:50',
            'raza'            => 'nullable|string|max:50',
            'sexo'            => 'nullable|in:Macho,Hembra',
            'fecha'           => 'required|date',
            'descripcion'     => 'nullable|string',
        ]);

        SolicitudCE::create($request->all());

        return redirect()->route('solicitudes.index')
                         ->with('success', 'Solicitud registrada correctamente.');
    }

    // Mostrar una solicitud
    public function show($id)
    {
        $solicitud = SolicitudCE::findOrFail($id);
        return view('solicitudes.show', compact('solicitud'));
    }

    // Formulario de edición
    public function edit($id)
    {
        $solicitud = SolicitudCE::findOrFail($id);
        return view('solicitudes.create', compact('solicitud'));
    }

    // Actualizar solicitud
    public function update(Request $request, $id)
    {
        $solicitud = SolicitudCE::findOrFail($id);

        $request->validate([
            'nombre_dueno'    => 'required|string|max:100',
            'correo'          => 'required|email|max:100',
            'estado_economico'=> 'nullable|string|max:50',
            'nombre_mascota'  => 'required|string|max:100',
            'especie'         => 'nullable|string|max:50',
            'raza'            => 'nullable|string|max:50',
            'sexo'            => 'nullable|in:Macho,Hembra',
            'fecha'           => 'required|date',
            'descripcion'     => 'nullable|string',
        ]);

        $solicitud->update($request->all());

        return redirect()->route('solicitudes.index')
                         ->with('success', 'Solicitud actualizada correctamente.');
    }

    // Eliminar solicitud
    public function destroy($id)
    {
        $solicitud = SolicitudCE::findOrFail($id);
        $solicitud->delete();

        return redirect()->route('solicitudes.index')
                         ->with('success', 'Solicitud eliminada correctamente.');
    }
}
