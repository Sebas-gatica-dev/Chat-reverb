<?php

use App\Enums\RequestPayment\StatusRequestPaymentEnum;
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
        Schema::create('request_payments', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuidMorphs('referenceable'); // Crea los campos morphs (budgetable_id y budgetable_type)
            $table->decimal('amount_charged', 15, 2)->nullable();
            $table->enum('status', array_column(StatusRequestPaymentEnum::cases(), 'value'))->default(StatusRequestPaymentEnum::PENDING);
            $table->foreignUuid('created_by')->constrained('users');
            $table->foreignUuid('branch_id')->constrained()->cascadeOnDelete();
            $table->foreignUuid('business_id')->constrained()->cascadeOnDelete();

            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('request_payments');
    }
};
