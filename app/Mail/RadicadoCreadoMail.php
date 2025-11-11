<?php

namespace App\Mail;

use App\Models\Radicado;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class RadicadoCreadoMail extends Mailable
{
    use Queueable, SerializesModels;

    public $radicado;

    /**
     * Create a new message instance.
     */
    public function __construct(Radicado $radicado)
    {
        $this->radicado = $radicado;
    }

    /**
     * Build the message.
     */
    public function build()
    {
        return $this->subject('Confirmación de radicación de documento')
                    ->view('emails.radicado-creado');
    }
}
