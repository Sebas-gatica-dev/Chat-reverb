<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Widget extends Model
{
    use HasFactory;

    protected $fillable = [
        'template_id', 'type', 'title', 'description', 'size', 'color', 'date_range', 'logic'
    ];



    public function template()
    {
        return $this->belongsTo(Template::class);
    }
}
