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
        Schema::create('featureables', function (Blueprint $table) {
            $table->foreignUuid('feature_id')->constrained();
            $table->uuidMorphs('featureable'); // Esto crea los campos featureable_id y featureable_type
            $table->integer('count')->default(3);
            $table->boolean('status')->default(true);
            $table->foreignUuid('industry_id')->nullable()->constrained(); //COLUMNA PIVOT
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('featureables');
    }
};
