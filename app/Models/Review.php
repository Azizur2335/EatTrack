<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Attributes\Fillable;

#[Fillable(['reservation_id', 'customer_id', 'restaurant_id', 'rating', 'comment'])]
class Review extends Model
{
    public function customer()    { return $this->belongsTo(User::class, 'customer_id'); }
    public function restaurant()  { return $this->belongsTo(Restaurant::class); }
    public function reservation() { return $this->belongsTo(Reservation::class); }
}