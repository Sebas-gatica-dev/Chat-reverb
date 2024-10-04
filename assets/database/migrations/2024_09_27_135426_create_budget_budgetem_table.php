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
            $table->foreignUuid('budgetem_id')->constrained(); //Relacion con budgetem (variables de presupuesto)
            $table->foreignUuid('budget_id')->constrained(); //Relacion con budget (presupuesto)
            $table->integer('quantity')->nullable(); //Cantidad
            //total
            $table->float('total', 10, 2);


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
