<?php

use App\Enums\AutomaticRoutesStatus;
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
            // Modifica la columna 'status' existente a un enum
            $table->enum('status', array_column(AutomaticRoutesStatus::cases(), 'value'))
                  ->default(AutomaticRoutesStatus::GENERATING->value)
                  ->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('automatic_routes', function (Blueprint $table) {
            $table->string('status')->nullable()->change();
        });
    }
};
