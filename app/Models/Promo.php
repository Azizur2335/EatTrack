<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Attributes\Fillable;

#[Fillable([
    'restaurant_id', 'title', 'description',
    'discount', 'start_date', 'end_date', 'status'
])]
class Promo extends Model
{
    public function restaurant() { return $this->belongsTo(Restaurant::class); }
}