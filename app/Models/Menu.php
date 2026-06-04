<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Attributes\Fillable;

#[Fillable([
    'restaurant_id', 'name', 'description',
    'price', 'image', 'category', 'is_available'
])]
class Menu extends Model
{
    public function restaurant() { return $this->belongsTo(Restaurant::class); }
}
