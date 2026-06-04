<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Attributes\Fillable;

class Table extends Model
{
    protected $fillable = [
        'restaurant_id',
        'table_number',
        'capacity',
        'status',
    ];

    public function restaurant() { return $this->belongsTo(Restaurant::class); }
    public function reservations() { return $this->hasMany(Reservation::class); }
}