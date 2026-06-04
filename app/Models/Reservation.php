<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Attributes\Fillable;

#[Fillable([
    'customer_id', 'restaurant_id', 'table_id',
    'date', 'time', 'guest_count', 'status', 'notes'
])]
class Reservation extends Model
{
    public function customer() { return $this->belongsTo(User::class, 'customer_id'); }
    public function restaurant() { return $this->belongsTo(Restaurant::class); }
    public function table() { return $this->belongsTo(Table::class); }
}
