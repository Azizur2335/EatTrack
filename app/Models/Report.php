<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Attributes\Fillable;

#[Fillable([
    'customer_id', 'category', 'title', 'message',
    'screenshot', 'reservation_id', 'restaurant_id',
    'status', 'admin_note'
])]
class Report extends Model
{
    public function customer()    { return $this->belongsTo(User::class, 'customer_id'); }
    public function reservation() { return $this->belongsTo(Reservation::class); }
    public function restaurant()  { return $this->belongsTo(Restaurant::class); }
}