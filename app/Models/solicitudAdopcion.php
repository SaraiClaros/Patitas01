<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class solicitudAdopcion extends Model
{
     protected $table = 'solicitudes_adopcion';

    protected $fillable = [
        'usuario_id',
        'mascota_id',
        'motivo',
        'Nombre',
        'DUI',
        'edad',
        'telefono',
        'direccion',
        'tipo_casa',
        'personas_casa',
        'personas_enteradas',
        'mascotas_casa',
        'visitas',
        'estado',
    ];

    public function usuario()
    {
        return $this->belongsTo(User::class, 'usuario_id');
    }

    public function mascota()
    {
        return $this->belongsTo(MascotaAdopcion::class, 'mascota_id');
    }
}
