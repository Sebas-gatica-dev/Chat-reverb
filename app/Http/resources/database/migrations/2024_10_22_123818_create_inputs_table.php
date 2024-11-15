<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Enums\Forms\InputTypeEnum;
use App\Enums\Forms\SectorTypeEnum;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('inputs', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->enum('sector', array_column(SectorTypeEnum::cases(), 'value'));
            $table->string('label')->nullable();
            $table->integer('order');
            $table->string('placeholder')->nullable();
            $table->boolean('required')->nullable();
            $table->json('options')->nullable();
            $table->foreignUuid('business_id')->constrained();
            $table->enum('input_type', array_column(InputTypeEnum::cases(), 'value'));
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inputs');
    }
};
