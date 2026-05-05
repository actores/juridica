<?php

namespace App\Mail;

use App\Models\Contrato;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;

class ContratoRegistradoMail extends Mailable
{
    use Queueable, SerializesModels;

    public $contrato;
    public $wordPath;

    public function __construct(Contrato $contrato, $wordPath)
    {
        $this->contrato = $contrato;
        $this->wordPath = $wordPath;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            from: new Address('noresponder@actores.tech', 'Área Jurídica — Actores S.C.G.'),
            subject: 'Nuevo contrato | ' . $this->contrato->consecutivo . ' — ' . $this->contrato->nombre_razon,
            replyTo: [
                new Address($this->contrato->email, $this->contrato->nombre_razon),
            ],
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.contrato_registrado',
        );
    }

    public function attachments(): array
    {
        $adjuntos = [];

        // 1. Word generado
        $adjuntos[] = Attachment::fromPath($this->wordPath)
            ->as("Contrato_{$this->contrato->consecutivo}.docx")
            ->withMime('application/vnd.openxmlformats-officedocument.wordprocessingml.document');

        // 2. PDFs subidos por el usuario
        if ($this->contrato->rutas_documentos) {
            foreach ($this->contrato->rutas_documentos as $tipo => $ruta) {
                if (Storage::disk('public')->exists($ruta)) {
                    $adjuntos[] = Attachment::fromStorageDisk('public', $ruta)
                        ->as("Soporte_{$tipo}.pdf")
                        ->withMime('application/pdf');
                }
            }
        }

        return $adjuntos;
    }
}