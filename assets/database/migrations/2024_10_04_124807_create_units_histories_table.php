<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Enums\Units\UnitsHistoryTypeEnum;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('unit_histories', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('unit_id')->references('id')->on('units'); //UnitsHistoryTypeEnum
            $table->enum('type',array_column(UnitsHistoryTypeEnum::cases(), 'value')); // campo que hace referencia al UnitsHistoryTypeEnum
            $table->string('originable_type')->nullable(); // Antes 'desde_type'
            $table->uuid('originable_id')->nullable();     // Antes 'desde_id'
            $table->string('destinationable_type')->nullable(); // Antes 'hasta_type'
            $table->uuid('destinationable_id')->nullable();     // Antes 'hasta_id'
            $table->foreignUuid('created_by')->references('id')->on('users');
            $table->string('description')->nullable();
            $table->softDeletes();         
            $table->timestamps();
        });
    }



    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('unit_histories');
    }
};
