<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

#[Fillable([
    'customer_id', 'restaurant_id', 'table_id',
    'date', 'time', 'guest_count', 'status', 'notes'
])]
class Reservation extends Model
{
    //
}
