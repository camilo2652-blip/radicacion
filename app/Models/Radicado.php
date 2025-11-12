<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Notificacion; // 🔹 Importante para crear la notificación

class Radicado extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'numero',
        'asunto',
        'descripcion',
        'archivo',
    ];

    // 🔹 Relación: un radicado tiene muchas notificaciones
    public function notificaciones()
    {
        return $this->hasMany(Notificacion::class, 'radicado_id');
    }

    public function ciudadano()
{
    return $this->belongsTo(User::class, 'user_id');
}


    // 🔹 Relación: un radicado pertenece a un usuario
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // 🪄 Evento que se ejecuta automáticamente al crear un radicado
    protected static function booted()
    {
        static::created(function ($radicado) {
            Notificacion::create([
                'radicado_id' => $radicado->id,
                'titulo' => 'Nuevo documento radicado',
                'mensaje' => 'Tu documento con asunto "' . $radicado->asunto . '" ha sido radicado exitosamente. Con el identificador: ' . $radicado->numero,
                'leido' => false,
            ]);
        });
    }
}

