<?php

use App\Enums\Salaries\ModallyProfitCounterSalaryEnum;
use App\Enums\Salaries\ModallyProfitSalaryEnum;
use App\Enums\Salaries\ProfitOfSalaryEnum;
use App\Enums\Salaries\TaxesSalaryEnum;
use App\Enums\Salaries\TransportSalaryEnum;
use App\Enums\Salaries\TypeSalaryEnum;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Mockery\Matcher\Type;
use Symfony\Component\Mailer\Transport;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('salaries', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('user_id')->constrained()->cascadeOnDelete();
            $table->foreignUuid('business_id')->constrained()->cascadeOnDelete();
            $table->enum('type', array_column(TypeSalaryEnum::cases(), 'value'));
            $table->decimal('type_value', 10, 2)->nullable();
            $table->boolean('only_profits')->default(false);
            $table->enum('taxes', array_column(TaxesSalaryEnum::cases(), 'value'))->default(TaxesSalaryEnum::NONE);
            $table->decimal('taxes_value', 10, 2)->nullable();
            $table->enum('transport', array_column(TransportSalaryEnum::cases(), 'value'))->default(TransportSalaryEnum::NONE);
            $table->decimal('transport_value', 10, 2)->nullable();
            $table->enum('profit_of', array_column(ProfitOfSalaryEnum::cases(), 'value'))->nullable();
            $table->enum('modally_profit', array_column(ModallyProfitSalaryEnum::cases(), 'value'))->nullable();
            $table->json('modally_profit_ids')->nullable();
            $table->enum('modally_profit_counter', array_column(ModallyProfitCounterSalaryEnum::cases(), 'value'))->nullable();
            $table->integer('modally_profit_quantity')->nullable();
            $table->decimal('salary', 10, 2)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('salaries');
    }
};
