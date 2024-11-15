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
        Schema::create('automatic_routes', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->json('routes')->nullable(); // JSON with route details (latitudes, longitudes, times, etc.)
            $table->date('start_date'); // Start date of the route organization
            $table->date('end_date'); // End date of the route organization
            $table->json('selected_visits')->nullable(); // JSON of selected visits
            $table->json('uncoordinated_visits')->nullable(); // JSON of visits that are uncoordinated
            $table->json('selected_employees')->nullable(); // JSON of selected employees
            $table->json('modified_routes')->nullable(); // JSON for modified routes
            $table->boolean('route_saved')->default(false); // Boolean to track if the route was saved in the DB
            $table->boolean('contemplate_organizedvisit')->default(true); // Boolean to track if the route was saved in the DB
            $table->bigInteger('requests')->nullable(); // Number of requests made to the API

            $table->string('job_id')->nullable();
            $table->string('status')->nullable();
            $table->softDeletes();
            $table->timestamps();
            // Optional: Define foreign key constraints if necessary
            $table->foreignUuid('business_id')->nullable()->references('id')->on('businesses');
            $table->foreignUuid('user_id')->nullable()->references('id')->on('users');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('automatic_routes');
    }
};
