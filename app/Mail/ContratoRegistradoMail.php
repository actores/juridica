<?php

namespace App\Mail;

use App\Models\Contrato;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;
use Illuminate\Mail\Mailables\Attachment;

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

    public function build()
    {
        $email = $this->subject("Nuevo Registro de Contrato: {$this->contrato->consecutivo}")
                     ->view('emails.contrato_registrado');

        // 1. Adjuntar el Word generado
        $email->attach($this->wordPath, [
            'as' => "Contrato_{$this->contrato->consecutivo}.docx",
            'mime' => 'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
        ]);

        // 2. Adjuntar los PDFs que subió el usuario
        if ($this->contrato->rutas_documentos) {
            foreach ($this->contrato->rutas_documentos as $tipo => $ruta) {
                if (Storage::disk('public')->exists($ruta)) {
                    $email->attachFromStorageDisk('public', $ruta, "Soporte_{$tipo}.pdf");
                }
            }
        }

        return $email;
    }
}