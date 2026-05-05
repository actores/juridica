<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('contratos', function (Blueprint $table) {
            $table->id();

            // AUDITORÍA Y CONTROL
            $table->foreignId('user_id')
                ->constrained()
                ->onUpdate('cascade')
                ->onDelete('restrict');

            // IDENTIFICADOR ÚNICO (Simplemente lo ponemos después de user_id)
            $table->string('consecutivo')->unique();

            // DATOS DE IDENTIFICACIÓN
            $table->string('tipo_contratista')->nullable();
            $table->string('nombre_razon');
            $table->string('tipo_id', 20)->nullable();
            $table->string('id_nit', 50);
            $table->date('fecha_expedicion')->nullable();

            // CONTACTO
            $table->string('direccion')->nullable();
            $table->string('telefono', 20)->nullable();
            $table->string('email')->nullable();

            // DETALLES DEL CONTRATO
            $table->string('servicio_prestado')->nullable();
            $table->text('objeto')->nullable();
            $table->json('alcance')->nullable();
            $table->date('fecha_inicio')->nullable();
            $table->date('fecha_fin')->nullable();
            $table->string('duracion')->nullable();

            // INTUITU PERSONAE
            $table->boolean('es_intuitu_personae')->default(false);
            $table->string('nombre_ejecutor')->nullable();
            $table->string('id_ejecutor')->nullable();

            // ROLES Y SUPERVISIÓN
            $table->string('publico')->nullable();
            $table->string('supervisor')->nullable();

            // DATOS FINANCIEROS
            $table->decimal('valor_total', 15, 2)->default(0);
            $table->string('forma_pago')->nullable();
            $table->text('forma_pago_otro')->nullable();
            $table->string('banco')->nullable();
            $table->string('tipo_cuenta')->nullable();
            $table->string('numero_cuenta', 50)->nullable();

            // GESTIÓN DOCUMENTAL
            $table->text('observaciones')->nullable();
            $table->json('rutas_documentos')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contratos');
    }
};
