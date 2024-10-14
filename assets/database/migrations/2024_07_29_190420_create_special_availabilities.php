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
        Schema::create('special_availabilities', function (Blueprint $table) {

            $table->uuid('id')->primary();
            $table->string('description')->nullable();
            $table->date('specific_date');
            $table->time('start_time');
            $table->time('end_time');
            $table->uuidMorphs('available');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('special_availabilities');
    }
};
