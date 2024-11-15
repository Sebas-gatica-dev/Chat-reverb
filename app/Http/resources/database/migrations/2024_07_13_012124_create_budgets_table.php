<?php

use App\Enums\StatusBudgetEnum;
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
            $table->bigInteger('code');
            $table->string('name');
            //total
            $table->float('total', 10, 2);
            //IVA
            $table->boolean('iva')->default(false);

            $table->boolean('budgetems_private')->default(false);

            // $table->tinyInteger('generating_pdf')->default(0); //0 no generado, 1 generado, 2 error

            $table->enum('status', array_column(StatusBudgetEnum::cases(), 'value'))->default(StatusBudgetEnum::NOT_GENERATED);


            //Relacion con lead o customer polimorfica
            $table->foreignUuid('customer_id')->constrained('customers');

            $table->foreignUuid('property_id')->nullable()->constrained('properties');

            $table->string('once_item_title')->nullable();

            $table->foreignUuid('business_id')->constrained();

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
