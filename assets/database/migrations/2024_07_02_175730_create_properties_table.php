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
            $table->string('property_name');
            $table->foreignUuid('property_type')->constrained('property_types');
            $table->string('documentation')->nullable();
            $table->integer('frequency');
            $table->foreignUuid('branch_id')->constrained('branches');
            $table->foreignUuid('created_by')->constrained('users');
            $table->string('photo')->nullable();

            $table->string('address');
            $table->string('between_streets');
            $table->string('floor')->nullable();
            $table->string('apartment')->nullable();

            $table->foreignId('country_id')->constrained('countries');
            $table->foreignId('province_id')->constrained('provinces');
            $table->foreignId('city_id')->constrained('cities');
            $table->foreignId('neighborhood_id')->constrained('neighborhoods');
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
