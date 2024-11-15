<?php

use App\Enums\WidgetDatesEnum;
use App\Enums\WidgetLogicEnum;
use App\Enums\WidgetSizesEnum;
use App\Enums\WidgetTypesEnum;
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
        Schema::create('widgets', function (Blueprint $table) {
            $table->id();
            $table->foreignId('template_id')->constrained()->onDelete('cascade'); // Relación con el template
            $table->enum('type',array_column(WidgetTypesEnum::cases(),'value')); // campo que hace referencia al UnitsHistoryTypeEnum
            $table->string('title'); // Título del widget
            $table->text('description')->nullable(); // Descripción del widget
            $table->enum('size',array_column(WidgetSizesEnum::cases(),'value')); // campo que hace referencia al UnitsHistoryTypeEnum
            $table->string('color')->nullable(); // Color del widget
            $table->enum('date',array_column(WidgetDatesEnum::cases(),'value')); // campo que hace referencia al UnitsHistoryTypeEnum
            $table->enum('logic',array_column(WidgetLogicEnum::cases(),'value')); // campo que hace referencia al UnitsHistoryTypeEnum
            $table->tinyInteger('order')->default(0); // Orden del widget
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('widgets');
    }
};
