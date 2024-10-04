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
        Schema::create('units', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->decimal('profit', 10, 2);
            $table->string('type'); 
            $table->date('expiration_date');
            $table->foreignUuid('product_id')->references('id')->on('products');
            $table->foreignUuid('warehouse_id')->references('id')->on('warehouses');
            $table->date('entry_date'); 
            $table->decimal('weight', 8, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('units');
    }
};
