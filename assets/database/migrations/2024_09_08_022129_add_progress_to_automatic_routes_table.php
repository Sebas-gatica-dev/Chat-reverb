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
        Schema::table('automatic_routes', function (Blueprint $table) {
            $table->integer('progress')->default(0)->after('status'); // Agregar la columna 'progress'
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('automatic_routes', function (Blueprint $table) {

            $table->dropColumn('progress'); // Eliminar la columna 'progress'
        });
    }
};
