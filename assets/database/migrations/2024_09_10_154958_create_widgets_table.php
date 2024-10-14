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
        Schema::create('widgets', function (Blueprint $table) {
            $table->id();
            $table->foreignId('template_id')->constrained()->onDelete('cascade'); // Relación con el template
            $table->string('type'); // Tipo de widget (bar, line, etc.)
            $table->string('title'); // Título del widget
            $table->text('description')->nullable(); // Descripción del widget
            $table->string('size')->default('medium'); // Tamaño del widget
            $table->string('color')->nullable(); // Color del widget
            $table->json('date_range')->nullable(); // Rango de fechas para los datos
            $table->string('logic'); // Lógica asociada al widget
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('widgets');
    }
};
