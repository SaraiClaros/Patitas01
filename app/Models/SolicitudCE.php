<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SolicitudCE extends Model
{
    use HasFactory;

    protected $table = 'solicitud_ce';
    protected $primaryKey = 'id_solicitud';

    protected $fillable = [
        'nombre_dueno',
        'correo',
        'estado_economico',
        'nombre_mascota',
        'especie',
        'raza',
        'sexo',
        'fecha',
        'descripcion',
    ];

    
}
