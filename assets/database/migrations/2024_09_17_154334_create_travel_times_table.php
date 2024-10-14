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
        Schema::create('travel_times', function (Blueprint $table) {
            $table->id();
            $table->decimal('origin_latitude', 10, 6);
            $table->decimal('origin_longitude', 10, 6);
            $table->decimal('destination_latitude', 10, 6);
            $table->decimal('destination_longitude', 10, 6);
            $table->unsignedInteger('travel_time_minutes');
            $table->timestamps();

            // Índice único para evitar duplicados
            $table->unique([
                'origin_latitude',
                'origin_longitude',
                'destination_latitude',
                'destination_longitude'
            ], 'unique_travel_times');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('travel_times');
    }
};
