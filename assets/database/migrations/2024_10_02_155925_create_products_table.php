
<?php

use App\Enums\ProductTypeEnum;
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
        Schema::create('products', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('name');
            $table->string('slug'); 
            $table->string('description');
            $table->enum('type',array_column(ProductTypeEnum::cases(),'value')); // campo que hace referencia al UnitsHistoryTypeEnum
            $table->unsignedInteger('quantity')->nullable();
            $table->foreignUuid('business_id')->references('id')->on('businesses');
            $table->string('barcode')->nullable();
            $table->integer('unit_of_measurement')->nullable();
            $table->integer('measure')->nullable();
            $table->foreignUuid('created_by')->references('id')->on('users');
            $table->unsignedSmallInteger('profit')->nullable();
            $table->unsignedSmallInteger('cost')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
