<?php

use App\Enums\RequestPayment\ReceiptTypeEnum;
use App\Enums\RequestPayment\StatusReceiptEnum;
use App\Enums\Tickets\StatusTicketEnum;
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
        Schema::create('receipts', function (Blueprint $table) {
            // UUID como clave primaria
            $table->uuid('id')->primary();

           
            $table->enum('status', array_column(StatusTicketEnum::cases(), 'value'))->default(StatusTicketEnum::PENDING);
            $table->enum('type', array_column(ReceiptTypeEnum::cases(), 'value'));
        
            $table->string('path')->nullable();
            $table->date('date_paid')->nullable();
            $table->time('time_paid')->nullable();
            $table->foreignUuid('created_by')->constrained('users');

            $table->foreignUuid('branch_id')->constrained()->cascadeOnDelete();
            $table->foreignUuid('business_id')->constrained()->cascadeOnDelete();

            $table->foreignUuid('request_payment_id')->constrained('request_payments')->cascadeOnDelete();
            
            $table->decimal('amount', 15, 2);




            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('receipts');
    }
};
