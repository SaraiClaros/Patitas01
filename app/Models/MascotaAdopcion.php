<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MascotaAdopcion extends Model
{
     protected $table = 'mascota_adopcion'; 
     protected $primaryKey = "ID_mascota_adop";
    protected $fillable = [
        'nombre',
        'foto',
        'especie',
        'raza',
        'edad',
        'sexo',
        'estado_salud',
        'fecha_registro',
        'estado_adopcion',
        'descripcion',
        'usuario_id'
    ];
    public function usuario()
    {
        return $this->belongsTo(User::class, 'usuario_id');
    }
    public function solicitudes()
{
    return $this->hasMany(SolicitudAdopcion::class, 'mascota_id');
}

}
