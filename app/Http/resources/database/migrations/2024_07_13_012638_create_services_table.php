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
        Schema::create('services', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('name');
            $table->string('description')->nullable();
            $table->foreignUuid('business_id')->constrained();
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::table('customers', function (Blueprint $table) {
            $table->foreignUuid('service_id')->nullable()->constrained('services')->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('services');
        Schema::table('customers', function (Blueprint $table) {
            $table->dropConstrainedForeignId('service_id');
        });
    }
};
