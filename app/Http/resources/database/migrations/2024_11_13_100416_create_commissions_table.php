<?php

use App\Enums\Salaries\TypeSalaryEnum;
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
        Schema::create('commissions', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('user_id')->constrained();
            $table->foreignUuid('visit_id')->constrained();
            $table->foreignUuid('business_id')->constrained();
            $table->uuid('referenceable_id')->nullable();
            $table->string('referenceable_type')->nullable();
            $table->enum('type_salary', array_column(TypeSalaryEnum::cases(), 'value'));
            $table->decimal('transport', 10, 2);
            $table->decimal('tax', 10, 2);
            $table->decimal('value', 10, 2);
            $table->decimal('total', 10, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('commissions');
    }
};
