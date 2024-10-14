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
        Schema::create('visits', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->date('date')->nullable();
            $table->time('time')->nullable();
            $table->decimal('price', 14, 2);
            $table->boolean('iva')->default(false);
            //tabla de disponibilidad de horarios de acuerdo a dia y hora y franja horaria
            $table->integer('status')->default(0);
            //tabla de estados de la visita, en donde tomamos horarios del estado y ubicacion de la visita
            //tabla transferencias/payment_customer con status completo, cargado de comprobantes y verificacion de que entro en la cuenta
            $table->integer('expected_payment')->nullable();
            $table->foreignUuid('visit_type_id')->constrained();
            $table->foreignUuid('property_id')->constrained();
            //tabla de operarios/empleados que se encargan de la visita
            $table->foreignUuid('customer_id')->constrained();
            //tabla de comisiones de los empleados
            $table->foreignUuid('created_by')->constrained('users');
            $table->foreignUuid('business_id')->constrained();
            $table->unsignedMediumInteger('duration_time');

            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('visits');
    }
};
