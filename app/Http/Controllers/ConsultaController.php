<?php

namespace App\Http\Controllers;

use App\Models\Consulta;
use App\Models\Mascota;
use Illuminate\Http\Request;

class ConsultaController extends Controller
{
    // Listado de consultas
    public function index()
    {
        $consultas = Consulta::with('mascota')->get();
        return view('consultas.index', compact('consultas'));
    }

    // Formulario de nueva consulta
    public function create()
    {
        $consulta = null; // Para que la vista sepa que es creación
        $mascotas = Mascota::all();
        return view('consultas.create', compact('consulta', 'mascotas'));
    }

    // Guardar nueva consulta
    public function store(Request $request)
    {
        $request->validate([
            'ID_mascota' => 'required|exists:mascotas,ID_mascota',
            'fecha_cita' => 'required|date',
            'motivo'     => 'required|string|max:255',
            'estado'     => 'required|string|max:50',
        ]);

        Consulta::create($request->all());

        return redirect()->route('consultas.index')
            ->with('success', 'Consulta registrada correctamente.');
    }

    // Formulario de edición
    public function edit(Consulta $consulta)
    {
        $mascotas = Mascota::all();
        return view('consultas.create', compact('consulta', 'mascotas'));
    }

    // Actualizar consulta
    public function update(Request $request, Consulta $consulta)
    {
        $request->validate([
            'ID_mascota' => 'required|exists:mascotas,ID_mascota',
            'fecha_cita' => 'required|date',
            'motivo'     => 'required|string|max:255',
            'estado'     => 'required|string|max:50',
        ]);

        $consulta->update($request->all());

        return redirect()->route('consultas.index')
            ->with('success', 'Consulta actualizada correctamente.');
    }

    // Eliminar consulta
    public function destroy(Consulta $consulta)
    {
        $consulta->delete();

        return redirect()->route('consultas.index')
            ->with('success', 'Consulta eliminada correctamente.');
    }
}
