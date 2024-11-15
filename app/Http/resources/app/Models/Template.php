<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Template extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description', 'business_id'];

    public function templateable()
    {
        return $this->morphTo(); // Esta es la relación correcta
    }

    public function widgets()
    {
        return $this->hasMany(Widget::class)->orderBy('order', 'asc');
    }

    public function roles()
    {
        return $this->morphedByMany(Role::class, 'templateable');
    }
    
    public function users()
    {
        return $this->morphedByMany(User::class, 'templateable');
    }
    
}
