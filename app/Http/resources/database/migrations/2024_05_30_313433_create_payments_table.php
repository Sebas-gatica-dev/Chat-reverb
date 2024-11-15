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
        Schema::create('payments', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('subscription_id')->constrained();
            $table->string('payment_method');
            $table->string('link')->nullable();
            $table->decimal('amount', 10, 2); // 10 dígitos en total, 2 decimales
            $table->timestamp('paid_at')->nullable();
            $table->string('preference_id')->nullable();
            $table->integer('status')->default('0');
            $table->text('response')->nullable();
            $table->string('currency');
            $table->boolean('is_partial')->default(false);
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
