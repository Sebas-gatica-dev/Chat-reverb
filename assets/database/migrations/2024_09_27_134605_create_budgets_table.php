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
        Schema::create('budgets', function (Blueprint $table) {
            //UUID
            $table->uuid('id')->primary();
            $table->string('name');
            //total
            $table->float('total', 10, 2);
            //IVA
            $table->boolean('iva')->default(false);
            //Relacion con lead o customer polimorfica
            $table->uuidMorphs('budgetable');

            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('budgets');
    }
};
