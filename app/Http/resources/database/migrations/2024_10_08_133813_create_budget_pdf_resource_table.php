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
        Schema::create('budget_pdf_resource', function (Blueprint $table) {
            // $table->id();
            $table->uuidMorphs('budgetable'); // Crea los campos morphs (budgetable_id y budgetable_type)
            
            $table->string('pdf_resource_id'); // Change to string
            $table->smallInteger('order')->nullable();
            
            // $table->foreignUuid('pdf_resource_id')->references('id')->on('pdf_resources');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('budget_pdf_resource');
    }
};
