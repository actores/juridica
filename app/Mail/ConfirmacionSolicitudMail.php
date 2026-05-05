<?php

namespace App\Mail;

use App\Models\Contrato;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ConfirmacionSolicitudMail extends Mailable
{
    use Queueable, SerializesModels;

    public $contrato;
    public $user;

    public function __construct(Contrato $contrato, User $user)
    {
        $this->contrato = $contrato;
        $this->user = $user;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            from: new Address('noresponder@actores.tech', 'Área Jurídica — Actores S.C.G.'),
            subject: 'Radicado ' . $this->contrato->consecutivo . ' | Contrato ' . $this->contrato->nombre_razon . ' — Solicitud recibida',
            replyTo: [
                new Address('juridica@actores.org.co', 'Área Jurídica — Actores S.C.G.'),
            ],
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.confirmacion-solicitante',
        );
    }
}