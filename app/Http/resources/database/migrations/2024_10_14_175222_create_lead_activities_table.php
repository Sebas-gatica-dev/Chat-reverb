<?php

use App\Enums\TypeContactEnum;
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
        Schema::create('lead_activities', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('customer_id')->constrained();
            $table->foreignUuid('user_id')->constrained();
            $table->date('date');
            $table->time('time');
            $table->enum('type_contact', array_column(TypeContactEnum::cases(), 'value'));
            $table->text('comment')->nullable();
            $table->boolean('is_initial')->default(false); // Indica si es la actividad inicial
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lead_activities');
    }
};
