<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

#[Fillable([
    'restaurant_id', 'table_number',
    'capacity', 'status'
])]
class Table extends Model
{
    //
}
