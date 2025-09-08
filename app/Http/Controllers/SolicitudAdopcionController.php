<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\solicitudAdopcion;
use App\Models\MascotaAdopcion;


class SolicitudAdopcionController extends Controller
{
    
    public function create($id)
    {
        $mascota = MascotaAdopcion::findOrFail($id);
        return view('mascotaAdopcion.form', compact('mascota'));
    }

   
    public function store(Request $request)
{
    $request->validate([
        'mascota_id' => 'required|exists:mascota_adopcion,ID_mascota_adop',
        'motivo'     => 'required|string',
        'Nombre'     => 'required|string',
        'DUI'        => 'required|string',
        'edad'       => 'required|integer|min:18|max:80',
        'telefono'   => 'required|string',
        'direccion'  => 'required|string',
        'tipo_casa'  => 'required|string',
        'personas_casa' => 'required|integer',
        'personas_enteradas' => 'required|string',
        'mascotas_casa' => 'required|string',
        'visitas'    => 'required|string',
        
    ]);

    SolicitudAdopcion::create([
        'usuario_id' => Auth::id(),
        'mascota_id' => $request->mascota_id,
        'motivo'     => $request->motivo,
        'Nombre'     => $request->Nombre,
        'DUI'        => $request->DUI,
        'edad'       => $request->edad,
        'telefono'   => $request->telefono,
        'direccion'  => $request->direccion,
        'tipo_casa'  => $request->tipo_casa,
        'personas_casa' => $request->personas_casa,
        'personas_enteradas' => $request->personas_enteradas,
        'mascotas_casa' => $request->mascotas_casa,
        'visitas'    => $request->visitas,
        'estado' =>'pendiente'
    ]);

    return redirect()->route('adopta.index')->with('success', True);
}



    
    public function index()
    {
        $usuarioRefugio = Auth::id();

        $solicitudes = solicitudAdopcion::whereHas('mascota', function ($query) use ($usuarioRefugio) {
            $query->where('usuario_id', $usuarioRefugio); 
        })->with(['usuario', 'mascota'])->get();

        return view('adopciones.index', compact('solicitudes'));
    }
}
