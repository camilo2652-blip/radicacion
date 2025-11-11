<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notificacion extends Model
{
    use HasFactory;

    protected $table = 'notificacions';

    protected $fillable = [
        'radicado_id',
        'titulo',
        'mensaje',
        'leido',
    ];

    public function radicado()
    {
        return $this->belongsTo(Radicado::class, 'radicado_id');
    }
}
