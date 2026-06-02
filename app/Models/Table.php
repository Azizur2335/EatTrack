<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

#[Fillable([
    'restaurant_id', 'table_number',
    'capacity', 'status'
])]
class Table extends Model
{
    public function restaurant() { return $this->belongsTo(Restaurant::class); }
    public function reservations() { return $this->hasMany(Reservation::class); }
}
