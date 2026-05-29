<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

#[Fillable([
    'owner_id', 'name', 'description',
    'address', 'phone', 'latitude',
    'longitude', 'image', 'status'
])]
class Restaurant extends Model
{
    
}
