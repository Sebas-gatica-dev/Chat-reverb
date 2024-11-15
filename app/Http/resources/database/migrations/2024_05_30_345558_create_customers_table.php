<?php

use App\Enums\GenderEnum;
use App\Enums\SourceEnum;
use App\Enums\StatusCustomerEnum;
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
        Schema::create('customers', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->date('date_lead')->nullable();
            $table->time('time_lead')->nullable();
            $table->json('services')->nullable();
            $table->enum('type_contact', array_column(TypeContactEnum::cases(), 'value'));
            $table->enum('status', array_column(StatusCustomerEnum::cases(), 'value'))
                ->default(StatusCustomerEnum::IN_PROCESS->value);
            $table->string('name')->nullable();
            $table->string('surname')->nullable();
            $table->string('business_name')->nullable();
            $table->enum('gender', array_column(GenderEnum::cases(), 'value'))->nullable();
            $table->enum('source', array_column(SourceEnum::cases(), 'value'))->nullable();
            $table->string('email')->nullable();
            $table->foreignUuid('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignUuid('business_id')->nullable()->constrained('businesses')->nullOnDelete();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customers');
    }
};
