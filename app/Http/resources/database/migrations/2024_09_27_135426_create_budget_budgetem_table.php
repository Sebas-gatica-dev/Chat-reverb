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
        Schema::create('budget_budgetem', function (Blueprint $table) {
            
            // Polymorphic relation to variables (Budgetem) or products (Product)
            $table->uuidMorphs('itemable'); // Crea los campos itemable_id y itemable_type

            $table->uuidMorphs('budgetable'); // Crea los campos morphs (budgetable_id y budgetable_type)
            
            
            $table->integer('quantity')->nullable(); //Cantidad
            $table->float('value', 10, 2)->nullable(); //Valor

            $table->boolean('visible_doc')->default(true); //Visible en documento
            //Tipo Privado o publico
            $table->boolean('private')->default(false);
            //total
            $table->float('total', 10, 2)->nullable();
            $table->smallInteger('order')->nullable(); //Orden

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('budget_budgetem');
    }
};
