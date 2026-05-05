<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Contrato extends Model
{
    use HasFactory;

    /**
     * Los atributos que se pueden asignar masivamente.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'consecutivo',           // <--- IMPORTANTE
        'tipo_contratista',      // Agregado
        'nombre_razon',
        'tipo_id',               // Agregado
        'id_nit',
        'fecha_expedicion',
        'direccion',
        'telefono',
        'email',
        'servicio_prestado',     // Agregado
        'objeto',
        'alcance',
        'fecha_inicio',
        'fecha_fin',
        'duracion',
        'es_intuitu_personae',   // Agregado
        'nombre_ejecutor',       // Agregado
        'id_ejecutor',           // Agregado
        'publico',
        'numero_personas',
        'supervisor',
        'valor_total',
        'forma_pago',            // Agregado
        'forma_pago_otro',       // Agregado
        'banco',
        'tipo_cuenta',
        'numero_cuenta',
        'observaciones',
        'rutas_documentos'
    ];



    /**
     * Los atributos que deben ser convertidos a tipos nativos.
     * Esto asegura que las fechas sean objetos Carbon y los números sean consistentes.
     *
     * @var array<string, string>
     */
    protected $casts = [
        // Fechas: Para poder formatearlas fácil en la vista o el Word
        'fecha_expedicion' => 'date',
        'fecha_inicio'     => 'date',
        'fecha_fin'        => 'date',

        // Números: Para que siempre tengan los 2 decimales de moneda
        'valor_total'      => 'decimal:2',

        // JSON a Array: ESTO ES VITAL
        // Como el "alcance" y las "rutas" vienen como múltiples datos, 
        // Laravel los convierte de JSON a Array de PHP automáticamente.
        'alcance'          => 'array',
        'rutas_documentos' => 'array',

        // Booleanos: Para el switch de Intuitu Personae
        'es_intuitu_personae' => 'boolean',
    ];

    

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
