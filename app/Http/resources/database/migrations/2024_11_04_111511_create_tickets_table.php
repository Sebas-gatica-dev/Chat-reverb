<?php

use App\Enums\Tickets\StatusTicketEnum;
use App\Enums\Tickets\TypeTicketEnum;
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
        Schema::create('tickets', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('description');
            $table->decimal('amount', 14, 2);
            $table->enum('status', array_column(StatusTicketEnum::cases(), 'value'));
            $table->enum('type', array_column(TypeTicketEnum::cases(), 'value'));
            $table->string('path')->nullable(); // Ruta al archivo asociado
            //discount billing
            $table->boolean('discount_bill')->default(false);

            //FOREIGN KEYS
            $table->foreignUuid('created_by')->constrained('users');
            $table->foreignUuid('user_id')->constrained('users');
            $table->foreignUuid('business_id')->constrained();
            $table->foreignUuid('branch_id')->nullable()->constrained();
            $table->foreignUuid('bank_account_id')->nullable()->constrained();
            //SOFT DELETES
            $table->softDeletes();
            //TIMESTAMPS
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tickets');
    }
};
