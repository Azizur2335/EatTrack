<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

#[Fillable([
    'restaurant_id', 'name', 'description',
    'price', 'image', 'category', 'is_available'
])]
class Menu extends Model
{
    public function restaurant() { return $this->belongsTo(Restaurant::class); }
}
