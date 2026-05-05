<?php

namespace App\Http\Controllers;

use App\Models\Contrato;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use PhpOffice\PhpWord\TemplateProcessor;

class ContratoController extends Controller
{
    /**
     * Muestra el catálogo de contratos (Opcional si usas el Dashboard directamente).
     */
    public function index()
    {
        try {
            // 1. Consultamos los contratos ordenados por fecha de creación (descendente)
            // Usamos paginate(10) para que si hay muchos, la página no cargue lento
            $contratos = Contrato::orderBy('created_at', 'desc')->paginate(10);

            // 2. Retornamos la vista pasando la variable 'contratos'
            return view('contratos.index', compact('contratos'));
        } catch (\Exception $e) {
            Log::error("Error al listar contratos: " . $e->getMessage());
            return back()->with('error', 'No se pudieron cargar los contratos.');
        }
    }

    public function show(Contrato $contrato)
    {
        // Laravel hace el "Route Model Binding" automáticamente
        return view('contratos.show', compact('contrato'));
    }




    /**
     * Muestra el formulario específico para Centro Camaleón.
     */
    public function createCamaleon()
    {
        return view('contratos.camaleon'); // Carga la vista camaleon.blade.php
    }

    /**
     * Almacena un nuevo contrato, genera el documento Word y notifica por correo.
     */
    public function store(Request $request)
    {
        // 1. Validación exhaustiva
        $validatedData = $request->validate([
            'consecutivo'                 => 'required|string|unique:contratos,consecutivo',
            'tipo_contratista'            => 'required|string',
            'nombre_razon_social'         => 'required|string|max:255',
            'tipo_id'                     => 'required|string',
            'numero_de_identificacion'    => 'required|string|max:50',
            'fecha_de_expedicion'         => 'required|date',
            'direccion_de_notificaciones' => 'required|string|max:255',
            'telefono'                    => 'required|string|max:20',
            'correo_electronico'          => 'required|email|max:255',

            'servicio_prestado'           => 'required|string|max:255',
            'objeto_del_contrato'         => 'required|string',
            'alcance'                     => 'required|array',
            'fecha_de_inicio'             => 'required|date',
            'fecha_de_terminacion'        => 'required|date|after_or_equal:fecha_de_inicio',
            'duracion_total_del_contrato' => 'nullable|string|max:100',
            'publico_al_cual_se_dirige'   => 'required|string',
            'numero_personas'             => 'required|integer|min:0',
            'intuitu_personae'            => 'required|string',
            'nombre_ejecutor'             => 'nullable|required_if:intuitu_personae,Sí|string',
            'id_ejecutor'                 => 'nullable|required_if:intuitu_personae,Sí|string',

            'supervisor_del_contrato'     => 'required|string|max:255',
            'valor_del_contrato'          => 'required|numeric',
            'forma_de_pago'               => 'required|string',
            'forma_de_pago_otro'          => 'nullable|string',
            'banco'                       => 'required|string|max:100',
            'tipo_de_cuenta'              => 'required|string',
            'no_de_cuenta_para_pago'      => 'required|string|max:50',

            'observaciones'               => 'nullable|string',
            'documentos'                  => 'nullable|array',
            'documentos.*'                => 'file|mimes:pdf|max:5120',
        ]);

        try {
            $contrato = new \App\Models\Contrato();

            // --- AUDITORÍA Y CONTROL ---
            $contrato->user_id     = Auth::id();
            $contrato->consecutivo = $validatedData['consecutivo'];

            // --- DATOS DEL CONTRATISTA ---
            $contrato->tipo_contratista = $validatedData['tipo_contratista'];
            $contrato->nombre_razon     = strtoupper($validatedData['nombre_razon_social']);
            $contrato->tipo_id          = $validatedData['tipo_id'];
            $contrato->id_nit           = $validatedData['numero_de_identificacion'];
            $contrato->fecha_expedicion = $validatedData['fecha_de_expedicion'];
            $contrato->direccion        = $validatedData['direccion_de_notificaciones'];
            $contrato->telefono         = $validatedData['telefono'];
            $contrato->email            = $validatedData['correo_electronico'];

            // --- DETALLES DE EJECUCIÓN ---
            $contrato->servicio_prestado = $validatedData['servicio_prestado'];
            $contrato->objeto            = $validatedData['objeto_del_contrato'];
            $contrato->alcance           = $validatedData['alcance'];
            $contrato->fecha_inicio      = $validatedData['fecha_de_inicio'];
            $contrato->fecha_fin         = $validatedData['fecha_de_terminacion'];
            $contrato->duracion          = $validatedData['duracion_total_del_contrato'];
            $contrato->publico           = $validatedData['publico_al_cual_se_dirige'];
            $contrato->numero_personas   = $validatedData['numero_personas'];
            $contrato->supervisor        = $validatedData['supervisor_del_contrato'];

            // --- INTUITU PERSONAE ---
            $contrato->es_intuitu_personae = ($validatedData['intuitu_personae'] === 'Sí');
            $contrato->nombre_ejecutor     = $validatedData['nombre_ejecutor'] ?? null;
            $contrato->id_ejecutor         = $validatedData['id_ejecutor'] ?? null;

            // --- FINANZAS ---
            $contrato->valor_total      = $validatedData['valor_del_contrato'];
            $contrato->forma_pago       = $validatedData['forma_de_pago'];
            $contrato->forma_pago_otro  = $validatedData['forma_de_pago_otro'] ?? null;
            $contrato->banco            = $validatedData['banco'];
            $contrato->tipo_cuenta      = $validatedData['tipo_de_cuenta'];
            $contrato->numero_cuenta    = $validatedData['no_de_cuenta_para_pago'];

            // --- OBSERVACIONES ---
            $contrato->observaciones    = $validatedData['observaciones'];

            // --- PROCESAMIENTO DE DOCUMENTOS (PDF) ---
            if ($request->hasFile('documentos')) {
                $archivosGuardados = [];
                foreach ($request->file('documentos') as $tipoDoc => $archivo) {
                    if ($archivo->isValid()) {
                        $filename = str_replace('-', '_', $contrato->consecutivo) . "_{$tipoDoc}_" . time() . '.pdf';
                        $path = $archivo->storeAs('contratos/soportes', $filename, 'public');
                        $archivosGuardados[$tipoDoc] = $path;
                    }
                }
                $contrato->rutas_documentos = $archivosGuardados;
            }

            // Guardar en Base de Datos
            $contrato->save();

            // --- GENERACIÓN DE WORD PARA ADJUNTO ---
            $wordPath = $this->crearArchivoWordTemporal($contrato);

            // --- ENVÍO DE EMAIL ---
            // Reemplaza con el correo de la oficina jurídica o administrativa
            $emailDestino = 'juridica@actores.org.co';

            Mail::to($emailDestino)->send(new \App\Mail\ContratoRegistradoMail($contrato, $wordPath));

            $user = Auth::user();

            Mail::to($user->email)->send(new \App\Mail\ConfirmacionSolicitudMail($contrato, $user));

            // --- LIMPIEZA ---
            // Borramos el Word temporal después del envío para no acumular basura
            if (file_exists($wordPath)) {
                unlink($wordPath);
            }

            return redirect()->route('dashboard')
                ->with('success', "¡El contrato {$contrato->consecutivo} se ha registrado y notificado correctamente!");
        } catch (\Exception $e) {
            Log::error("Error guardando contrato: " . $e->getMessage());
            return back()
                ->withInput()
                ->with('error', 'Hubo un problema al procesar la solicitud: ' . $e->getMessage());
        }
    }


    public function generarWord(Contrato $contrato)
    {
        try {
            // 1. Cargar la plantilla
            $templatePath = storage_path('app/templates/plantilla_contrato_centro_camaleon.docx');

            if (!file_exists($templatePath)) {
                throw new \Exception("La plantilla no existe en la ruta especificada.");
            }

            $templateProcessor = new \PhpOffice\PhpWord\TemplateProcessor($templatePath);

            // --- PROCESAMIENTO DE ALCANCE (LISTADO NUMERADO) ---
            $alcanceTexto = '';
            if (is_array($contrato->alcance) && count($contrato->alcance) > 0) {
                foreach ($contrato->alcance as $index => $item) {
                    // Crea una línea tipo "1. Descripción de la obligación"
                    // El \n al final asegura que la siguiente empiece abajo
                    $alcanceTexto .= ($index + 1) . ". " . $item . "\n";
                }
            } else {
                $alcanceTexto = "Sin obligaciones específicas.";
            }

            // --- DETERMINAR FORMA DE PAGO ---
            $formaPagoFinal = ($contrato->forma_pago === 'Otro')
                ? $contrato->forma_pago_otro
                : $contrato->forma_pago;

            // 2. Relacionar Variables (Word => Modelo)

            // Variables nuevas solicitadas
            $templateProcessor->setValue('CONSECUTIVO', $contrato->consecutivo);
            $templateProcessor->setValue('ANIO', date('Y')); // Año actual (2026)

            // Datos del Contratista
            $templateProcessor->setValue('NOMBRE_RAZON_SOCIAL', strtoupper($contrato->nombre_razon ?? ''));
            $templateProcessor->setValue('NUMERO_DE_IDENTIFICACION', is_numeric($contrato->id_nit) ? number_format($contrato->id_nit, 0, ',', '.') : ($contrato->id_nit ?? ''));
            $templateProcessor->setValue('FECHA_DE_EXPEDICION', $contrato->fecha_expedicion ? $contrato->fecha_expedicion->format('d/m/Y') : 'N/A');
            $templateProcessor->setValue('DIRECCION_DE_NOTIFICACIONES', $contrato->direccion ?? '');
            $templateProcessor->setValue('TELEFONO', $contrato->telefono ?? '');
            $templateProcessor->setValue('CORREO_ELECTRONICO', $contrato->email ?? '');

            // Detalles del Contrato
            $templateProcessor->setValue('OBJETO_DEL_CONTRATO', $contrato->objeto ?? '');
            $templateProcessor->setValue('ALCANCE_DEL_OBJETO', trim($alcanceTexto)); // trim para quitar el último salto de línea

            $templateProcessor->setValue('FECHA_DE_INICIO', $contrato->fecha_inicio ? $contrato->fecha_inicio->format('d/m/Y') : 'N/A');
            $templateProcessor->setValue('FECHA_DE_TERMINACION', $contrato->fecha_fin ? $contrato->fecha_fin->format('d/m/Y') : 'N/A');
            $templateProcessor->setValue('DURACION_TOTAL_DEL_CONTRATO', $contrato->duracion ?? 'N/A');
            $templateProcessor->setValue('PUBLICO_AL_CUAL_SE_DIRIGE', $contrato->publico ?? 'N/A');
            $templateProcessor->setValue('SUPERVISOR_DEL_CONTRATO', $contrato->supervisor ?? '');

            // Finanzas
            $templateProcessor->setValue('VALOR_DEL_CONTRATO', number_format($contrato->valor_total ?? 0, 2, ',', '.'));
            $templateProcessor->setValue('FORMA_DE_PAGO', $formaPagoFinal ?? '');
            $templateProcessor->setValue('BANCO', $contrato->banco ?? '');
            $templateProcessor->setValue('TIPO_DE_CUENTA', $contrato->tipo_cuenta ?? '');
            $templateProcessor->setValue('NO_DE_CUENTA_PARA_PAGO', $contrato->numero_cuenta ?? '');

            // 3. Nombre del archivo de salida
            $nombreLimpio = str_replace([' ', '/', '\\'], '_', $contrato->nombre_razon);
            $fileName = "Contrato_" . $contrato->consecutivo . "_" . $nombreLimpio . ".docx";
            $tempPath = storage_path('app/public/' . $fileName);

            // 4. Guardar archivo temporal y descargar
            $templateProcessor->saveAs($tempPath);

            return response()->download($tempPath)->deleteFileAfterSend(true);
        } catch (\Exception $e) {
            Log::error("Error al generar Word para contrato {$contrato->id}: " . $e->getMessage());
            return back()->with('error', 'Error al generar el documento: ' . $e->getMessage());
        }
    }

    private function crearArchivoWordTemporal(\App\Models\Contrato $contrato)
    {
        $templatePath = storage_path('app/templates/plantilla_contrato_centro_camaleon.docx');
        $templateProcessor = new \PhpOffice\PhpWord\TemplateProcessor($templatePath);

        // Procesamiento de Alcance
        $alcanceTexto = '';
        if (is_array($contrato->alcance)) {
            foreach ($contrato->alcance as $index => $item) {
                $alcanceTexto .= ($index + 1) . ". " . $item . "\n";
            }
        }

        // Identificación con puntos (Solo si es C.C.)
        $idDoc = ($contrato->tipo_id === 'C.C.' && is_numeric($contrato->id_nit))
            ? number_format($contrato->id_nit, 0, ',', '.')
            : $contrato->id_nit;

        // Forma de Pago
        $formaPago = ($contrato->forma_pago === 'Otro') ? $contrato->forma_pago_otro : $contrato->forma_pago;

        // Llenado de variables
        $templateProcessor->setValue('CONSECUTIVO', $contrato->consecutivo);
        $templateProcessor->setValue('ANIO', date('Y'));
        $templateProcessor->setValue('NOMBRE_RAZON_SOCIAL', strtoupper($contrato->nombre_razon));
        $templateProcessor->setValue('NUMERO_DE_IDENTIFICACION', $idDoc);
        $templateProcessor->setValue('FECHA_DE_EXPEDICION', $contrato->fecha_expedicion->format('d/m/Y'));
        $templateProcessor->setValue('DIRECCION_DE_NOTIFICACIONES', $contrato->direccion);
        $templateProcessor->setValue('TELEFONO', $contrato->telefono);
        $templateProcessor->setValue('CORREO_ELECTRONICO', $contrato->email);
        $templateProcessor->setValue('OBJETO_DEL_CONTRATO', $contrato->objeto);
        $templateProcessor->setValue('ALCANCE_DEL_OBJETO', trim($alcanceTexto));
        $templateProcessor->setValue('FECHA_DE_INICIO', $contrato->fecha_inicio->format('d/m/Y'));
        $templateProcessor->setValue('FECHA_DE_TERMINACION', $contrato->fecha_fin->format('d/m/Y'));
        $templateProcessor->setValue('DURACION_TOTAL_DEL_CONTRATO', $contrato->duracion);
        $templateProcessor->setValue('PUBLICO_AL_CUAL_SE_DIRIGE', $contrato->publico);
        $templateProcessor->setValue('SUPERVISOR_DEL_CONTRATO', $contrato->supervisor);
        $templateProcessor->setValue('VALOR_DEL_CONTRATO', number_format($contrato->valor_total, 2, ',', '.'));
        $templateProcessor->setValue('FORMA_DE_PAGO', $formaPago);
        $templateProcessor->setValue('BANCO', $contrato->banco);
        $templateProcessor->setValue('TIPO_DE_CUENTA', $contrato->tipo_cuenta);
        $templateProcessor->setValue('NO_DE_CUENTA_PARA_PAGO', $contrato->numero_cuenta);

        $tempPath = storage_path('app/public/temp_' . $contrato->consecutivo . '_' . time() . '.docx');
        $templateProcessor->saveAs($tempPath);

        return $tempPath;
    }
}
