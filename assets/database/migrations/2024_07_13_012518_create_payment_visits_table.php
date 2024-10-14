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
        Schema::create('payment_visits', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('visit_id')->constrained();
            $table->decimal('amount', 8, 2);
            $table->string('description')->nullable();
            $table->string('payment_method');
            $table->string('file')->nullable();
            $table->string('status')->default(0);
            $table->foreignUuid('bank_account_id')->constrained();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payment_visits');
    }
};
