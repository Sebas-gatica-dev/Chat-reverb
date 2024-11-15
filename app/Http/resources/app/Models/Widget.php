<?php

namespace App\Models;

use App\Enums\WidgetDatesEnum;
use App\Enums\WidgetLogicEnum;
use App\Enums\WidgetSizesEnum;
use App\Enums\WidgetTypesEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Widget extends Model
{
    use HasFactory;

    protected $fillable = [
        'template_id', 'type', 'title', 'description', 'size', 'color', 'date', 'logic', 'order'
    ];


    protected $casts = [
        'date' => WidgetDatesEnum::class,
        'size' => WidgetSizesEnum::class,
        'type' => WidgetTypesEnum::class,
        'logic' => WidgetLogicEnum::class,
    ];


    public function template()
    {
        return $this->belongsTo(Template::class);
    }
}
