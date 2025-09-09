<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Publicacion extends Model
{
    use HasFactory;

    protected $fillable = [
        'titulo',
        'descripcion',
        'media',
        'user_id',
        'especie',
        'edad',
        'estado',
    ];

    // Relación con el usuario
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relación con comentarios
    public function comentarios()
    {
        return $this->hasMany(Comentario::class);
    }

    // Relación con reacciones
    public function reacciones()
    {
        return $this->hasMany(Reaccion::class);
    }

    // Filtrar reacciones tipo "love"
    public function reaccionesLove()
    {
        return $this->reacciones()->where('tipo', 'love');
    }
}
