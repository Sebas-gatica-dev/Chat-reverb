<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Enums\Units\UnitsStatusEnum;
use App\Enums\ProductTypeEnum;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('units', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->unsignedSmallInteger('profit_margin'); // Updated name
            $table->unsignedSmallInteger('cost');
            $table->string('batch')->nullable(); // Updated name
            $table->string('tag')->nullable(); // Fixed definition
            $table->enum('type', array_column(ProductTypeEnum::cases(), 'value')); // Updated name
            $table->date('expiration_date')->nullable();
            $table->foreignUuid('product_id')->nullable()->references('id')->on('products');
            $table->foreignUuid('warehouse_id')->nullable()->references('id')->on('warehouses');
            $table->date('entry_date')->nullable(); 
            $table->foreignUuid('created_by')->references('id')->on('users');
            $table->integer('weight')->nullable();
            $table->softDeletes();
            $table->foreignUuid('worker_id')->nullable()->references('id')->on('users');
            // New fields
            $table->unsignedInteger('initial_quantity'); // Initial quantity
            $table->unsignedInteger('current_quantity'); // Current quantity
            $table->enum('status',array_column(UnitsStatusEnum::cases(),'value')); // Status of the unit

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
