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

            // Mail::to($emailDestino)->send(new \App\Mail\ContratoRegistradoMail($contrato, $wordPath));

            $user = Auth::user();

            // Mail::to($user->email)->send(new \App\Mail\ConfirmacionSolicitudMail($contrato, $user));

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

    /**
     * Convierte un número entero a su forma escrita en español (0-9999).
     * Pensado para días (1-31) y años (ej. 2026).
     */
    private function numeroALetras(int $numero): string
    {
        if ($numero === 0) return 'cero';

        $unidades = [
            1 => 'uno',
            2 => 'dos',
            3 => 'tres',
            4 => 'cuatro',
            5 => 'cinco',
            6 => 'seis',
            7 => 'siete',
            8 => 'ocho',
            9 => 'nueve',
            10 => 'diez',
            11 => 'once',
            12 => 'doce',
            13 => 'trece',
            14 => 'catorce',
            15 => 'quince',
            16 => 'dieciséis',
            17 => 'diecisiete',
            18 => 'dieciocho',
            19 => 'diecinueve',
            20 => 'veinte',
            21 => 'veintiuno',
            22 => 'veintidós',
            23 => 'veintitrés',
            24 => 'veinticuatro',
            25 => 'veinticinco',
            26 => 'veintiséis',
            27 => 'veintisiete',
            28 => 'veintiocho',
            29 => 'veintinueve',
            30 => 'treinta',
        ];

        $decenas = [
            3 => 'treinta',
            4 => 'cuarenta',
            5 => 'cincuenta',
            6 => 'sesenta',
            7 => 'setenta',
            8 => 'ochenta',
            9 => 'noventa',
        ];

        $centenas = [
            1 => 'ciento',
            2 => 'doscientos',
            3 => 'trescientos',
            4 => 'cuatrocientos',
            5 => 'quinientos',
            6 => 'seiscientos',
            7 => 'setecientos',
            8 => 'ochocientos',
            9 => 'novecientos',
        ];

        // 1 - 30
        if ($numero <= 30) {
            return $unidades[$numero];
        }

        // 31 - 99
        if ($numero < 100) {
            $d = intdiv($numero, 10);
            $u = $numero % 10;
            return $u === 0 ? $decenas[$d] : $decenas[$d] . ' y ' . $unidades[$u];
        }

        // 100
        if ($numero === 100) return 'cien';

        // 101 - 999
        if ($numero < 1000) {
            $c = intdiv($numero, 100);
            $resto = $numero % 100;
            return $resto === 0 ? $centenas[$c] : $centenas[$c] . ' ' . $this->numeroALetras($resto);
        }

        // 1000 - 9999 (suficiente para años)
        if ($numero < 10000) {
            $miles = intdiv($numero, 1000);
            $resto = $numero % 1000;
            $prefijo = $miles === 1 ? 'mil' : $this->numeroALetras($miles) . ' mil';
            return $resto === 0 ? $prefijo : $prefijo . ' ' . $this->numeroALetras($resto);
        }

        return (string) $numero; // fallback
    }

    /**
     * Genera el texto formal del período de ejecución del contrato.
     * Reglas:
     * - Un solo día: "el día veintinueve (29) de mayo de dos mil veintiséis (2026)"
     * - Mismo mes y año: "desde el día X hasta el Y de MES de AÑO"
     * - Distinto mes, mismo año: "desde el día X de MES_A hasta el Y de MES_B de AÑO"
     * - Distinto año: "desde el día X de MES_A de AÑO_A hasta el Y de MES_B de AÑO_B"
     */
    private function generarTextoPeriodo($fechaInicio, $fechaFin): string
    {
        $meses = [
            1 => 'enero',
            2 => 'febrero',
            3 => 'marzo',
            4 => 'abril',
            5 => 'mayo',
            6 => 'junio',
            7 => 'julio',
            8 => 'agosto',
            9 => 'septiembre',
            10 => 'octubre',
            11 => 'noviembre',
            12 => 'diciembre',
        ];

        // Aseguramos instancias Carbon
        $inicio = \Carbon\Carbon::parse($fechaInicio);
        $fin    = \Carbon\Carbon::parse($fechaFin);

        $diaIni  = (int) $inicio->day;
        $mesIni  = (int) $inicio->month;
        $anioIni = (int) $inicio->year;

        $diaFin  = (int) $fin->day;
        $mesFin  = (int) $fin->month;
        $anioFin = (int) $fin->year;

        $diaIniTxt  = $this->numeroALetras($diaIni)  . " ({$diaIni})";
        $diaFinTxt  = $this->numeroALetras($diaFin)  . " ({$diaFin})";
        $anioIniTxt = $this->numeroALetras($anioIni) . " ({$anioIni})";
        $anioFinTxt = $this->numeroALetras($anioFin) . " ({$anioFin})";

        // Caso 1: mismo día
        if ($inicio->isSameDay($fin)) {
            return "el día {$diaIniTxt} de {$meses[$mesIni]} de {$anioIniTxt}";
        }

        // Caso 2: mismo mes y mismo año
        if ($mesIni === $mesFin && $anioIni === $anioFin) {
            return "desde el día {$diaIniTxt} hasta el {$diaFinTxt} de {$meses[$mesIni]} de {$anioIniTxt}";
        }

        // Caso 3: distinto mes, mismo año
        if ($anioIni === $anioFin) {
            return "desde el día {$diaIniTxt} de {$meses[$mesIni]} hasta el {$diaFinTxt} de {$meses[$mesFin]} de {$anioIniTxt}";
        }

        // Caso 4: distinto año
        return "desde el día {$diaIniTxt} de {$meses[$mesIni]} de {$anioIniTxt} hasta el {$diaFinTxt} de {$meses[$mesFin]} de {$anioFinTxt}";
    }

    private function generarTextoDuracion($fechaInicio, $fechaFin): string
    {
        $meses = [
            1 => 'enero',
            2 => 'febrero',
            3 => 'marzo',
            4 => 'abril',
            5 => 'mayo',
            6 => 'junio',
            7 => 'julio',
            8 => 'agosto',
            9 => 'septiembre',
            10 => 'octubre',
            11 => 'noviembre',
            12 => 'diciembre',
        ];

        $inicio = \Carbon\Carbon::parse($fechaInicio);
        $fin    = \Carbon\Carbon::parse($fechaFin);

        // Cantidad de días (inclusivo: del 29 al 31 son 3 días)
        $cantDias = $inicio->diffInDays($fin) + 1;
        $cantDiasTxt = $this->numeroALetras($cantDias) . " ({$cantDias})";

        $diaIni  = (int) $inicio->day;
        $mesIni  = (int) $inicio->month;
        $anioIni = (int) $inicio->year;

        $diaFin  = (int) $fin->day;
        $mesFin  = (int) $fin->month;
        $anioFin = (int) $fin->year;

        $diaIniTxt  = $this->numeroALetras($diaIni)  . " ({$diaIni})";
        $diaFinTxt  = $this->numeroALetras($diaFin)  . " ({$diaFin})";
        $anioIniTxt = $this->numeroALetras($anioIni) . " ({$anioIni})";
        $anioFinTxt = $this->numeroALetras($anioFin) . " ({$anioFin})";

        // Caso 1: un solo día
        if ($inicio->isSameDay($fin)) {
            return "un (1) día, correspondiente al {$diaIniTxt} de {$meses[$mesIni]} de {$anioIniTxt}";
        }

        // Caso 2: mismo mes y mismo año
        if ($mesIni === $mesFin && $anioIni === $anioFin) {
            return "{$cantDiasTxt} días, comprendidos entre el {$diaIniTxt} y el {$diaFinTxt} de {$meses[$mesIni]} de {$anioIniTxt}";
        }

        // Caso 3: distinto mes, mismo año
        if ($anioIni === $anioFin) {
            return "{$cantDiasTxt} días, comprendidos entre el {$diaIniTxt} de {$meses[$mesIni]} y el {$diaFinTxt} de {$meses[$mesFin]} de {$anioIniTxt}";
        }

        // Caso 4: distinto año
        return "{$cantDiasTxt} días, comprendidos entre el {$diaIniTxt} de {$meses[$mesIni]} de {$anioIniTxt} y el {$diaFinTxt} de {$meses[$mesFin]} de {$anioFinTxt}";
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

            $templateProcessor->setValue('PERIODO_EJECUCION', $this->generarTextoPeriodo($contrato->fecha_inicio, $contrato->fecha_fin));
            $templateProcessor->setValue('DURACION_CONTRATO', $this->generarTextoDuracion($contrato->fecha_inicio, $contrato->fecha_fin));
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
        $templateProcessor->setValue('PERIODO_EJECUCION', $this->generarTextoPeriodo($contrato->fecha_inicio, $contrato->fecha_fin));
        $templateProcessor->setValue('DURACION_CONTRATO', $this->generarTextoDuracion($contrato->fecha_inicio, $contrato->fecha_fin));
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
