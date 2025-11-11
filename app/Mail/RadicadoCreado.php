<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\Radicado;

class RadicadoCreado extends Mailable
{
    use Queueable, SerializesModels;

    public $radicado;

    /**
     * Crear una nueva instancia del mensaje.
     */
    public function __construct(Radicado $radicado)
    {
        $this->radicado = $radicado;
    }

    /**
     * Construir el mensaje.
     */
    public function build()
    {
        return $this->subject('Confirmación de radicado: ' . $this->radicado->numero)
                    ->markdown('emails.radicado-creado');
    }
}
