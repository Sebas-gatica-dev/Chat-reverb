<?php

use App\Enums\Units\UnitDownActionReasonTypeEnum;
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
            $table->enum('reason_action',array_column(UnitDownActionReasonTypeEnum::cases(), 'value'))->nullable();
            $table->unsignedInteger('quantity')->nullable(); // Quantity
            $table->unsignedInteger('initial_quantity')->nullable(); // Initial quantity
            $table->unsignedInteger('current_quantity')->nullable(); // Current quantity
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
