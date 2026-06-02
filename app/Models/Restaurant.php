<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

#[Fillable([
    'owner_id', 'name', 'description',
    'address', 'city', 'phone', 'latitude',
    'longitude', 'image', 'status',
    'category', 'maps_link', 'open_time',
    'close_time'
])]
class Restaurant extends Model
{
    
}
