<?php

use App\Enums\StatusVisitEnum;
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
        Schema::create('status_changes', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('visit_id')->constrained();
            $table->enum('status' , array_column(StatusVisitEnum::cases(), 'value'))->default(StatusVisitEnum::PENDING);
            $table->unsignedBigInteger('interval_status')->nullable();
            $table->json('data')->nullable();
            $table->string('latitude')->nullable();
            $table->string('longitude')->nullable();
            $table->boolean('out_of_range')->nullable();
            $table->timestamps();
        });

        // Schema::create('status_changes', function (Blueprint $table) {
        //     $table->uuid('id')->primary();
        //     $table->foreignUuid('visit_id')->constrained();
        //     $table->integer('status')->default(0);
        //     $table->string('approximate_time')->nullable();
        //     $table->text('comment')->nullable();
        //     $table->string('latitude')->nullable();
        //     $table->string('longitude')->nullable();
        //     $table->timestamps();
        // });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('status_changes');
    }
};
