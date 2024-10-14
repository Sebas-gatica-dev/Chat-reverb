<?php

use App\Enums\SourcesEnum;
use App\Enums\StatusLedEnum;
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
        Schema::create('leads', function (Blueprint $table) {

            $table->uuid('id')->primary();
            $table->date('date');
            $table->time('time');
            $table->string('name')->nullable();
            $table->string('surname')->nullable();
            $table->string('email')->nullable();
            $table->enum('gender', ['male', 'female'])->default('male');
            $table->string('phone')->nullable();
            $table->enum('source', array_column(SourcesEnum::cases(), 'value'))
                ->nullable();
            $table->enum('type_contact', array_column(TypeContactEnum::cases(), 'value'));
            $table->enum('status', array_column(StatusLedEnum::cases(), 'value'))
                ->default(StatusLedEnum::IN_PROCESS->value);
            $table->string('description')->nullable();
            $table->foreignId('country_id')->nullable()->constrained('countries');
            $table->foreignId('province_id')->nullable()->constrained('provinces');
            $table->foreignId('city_id')->nullable()->constrained('cities');
            $table->foreignId('neighborhood_id')->nullable()->constrained('neighborhoods');
            $table->foreignId('subzone_id')->nullable()->constrained('subzones');
            $table->foreignUuid('property_type_id')->nullable()->constrained('property_types')->nullOnDelete();
            $table->foreignUuid('service_id')->nullable()->constrained('services')->nullOnDelete();
            $table->foreignUuid('branch_id')->nullable()->constrained('branches')->nullOnDelete();
            $table->foreignUuid('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignUuid('business_id')->nullable()->constrained('businesses')->nullOnDelete();
            $table->foreignUuid('customer_id')->nullable()->constrained('customers')->nullOnDelete();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('leads');
    }
};
