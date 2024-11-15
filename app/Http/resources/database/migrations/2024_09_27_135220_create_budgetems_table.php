<?php

use App\Enums\TypeBudgetemEnum;
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
        Schema::create('budgetems', function (Blueprint $table) {
            
            $table->uuid('id')->primary();
            $table->string('name');
            
            $table->integer('value')->nullable();

            $table->integer('default_quantity')->nullable();


            $table->string('description')->nullable();
            $table->string('description_item')->nullable();
            
            $table->boolean('operator')->default(true);
            //Minimo y maximo
            $table->float('min', 10, 2)->nullable();
            $table->float('max', 10, 2)->nullable();
            //Tipo de operador
            $table->enum('type', array_column(TypeBudgetemEnum::cases(), 'value'));
            //Visible boolean document
            $table->boolean('visible_doc')->default(true);
            //Tipo Privado o publico
            $table->boolean('private')->default(false);
            
            //Relacion con business
            $table->foreignUuid('business_id')->constrained()->onDelete('cascade');

            $table->softDeletes();
            

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('budgetems');
    }
};
