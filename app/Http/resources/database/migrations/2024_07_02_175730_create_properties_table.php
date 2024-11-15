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
        Schema::create('properties', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('property_name')->nullable();
            $table->foreignUuid('property_type')->nullable()->constrained('property_types');
            $table->string('documentation')->nullable();
            $table->integer('frequency')->nullable();
            $table->foreignUuid('branch_id')->nullable()->constrained('branches');
            $table->foreignUuid('created_by')->constrained('users');
            $table->string('photo')->nullable();

            $table->string('address')->nullable();
            $table->string('between_streets')->nullable();
            $table->string('floor')->nullable();
            $table->string('apartment')->nullable();

            $table->foreignId('country_id')->nullable()->constrained('countries');
            $table->foreignId('province_id')->nullable()->constrained('provinces');
            $table->foreignId('city_id')->nullable()->constrained('cities');
            $table->foreignId('neighborhood_id')->nullable()->constrained('neighborhoods');
            $table->foreignId('subzone_id')->nullable()->constrained('subzones');
            $table->string('latitude')->nullable();
            $table->string('longitude')->nullable();

            $table->foreignUuid('customer_id')->constrained('customers');
            $table->foreignUuid('business_id')->constrained('businesses');

            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('properties');
    }
};
