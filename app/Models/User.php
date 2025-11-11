<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Notifications\ResetPasswordNotification; // 👈 AÑADE ESTA LÍNEA

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'nombre',
        'usuario',
        'documento',
        'email',
        'telefono',
        'direccion',
        'password',
        'rol',
    ];

    // 🔹 Campos ocultos (por seguridad)
    protected $hidden = [
        'password',
        'remember_token',
    ];

    // 🔹 Conversión automática de tipos
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // 🔹 Relaciones
    public function radicados()
    {
        return $this->hasMany(Radicado::class, 'ciudadano_id');
    }

    public function movimientos()
    {
        return $this->hasMany(Movimiento::class, 'usuario_id');
    }

    // 🔹 Verificación de rol
    public function isRole($rol)
    {
        return $this->rol === $rol;
    }

    // ✅ Notificación personalizada en español
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPasswordNotification($token));
    }
}
