<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

#[Fillable([
    'owner_id', 'name', 'description',
    'address', 'city', 'phone', 'latitude',
    'longitude', 'image', 'status',
    'category', 'maps_link', 'open_time',
    'close_time'
])]
class Restaurant extends Model
{
    use HasFactory;

    public function owner() { return $this->belongsTo(User::class, 'owner_id'); }
    public function menus() { return $this->hasMany(Menu::class); }
    public function tables() { return $this->hasMany(Table::class); }
    public function promos() { return $this->hasMany(Promo::class); }
    public function reservations() { return $this->hasMany(Reservation::class); }
    public function reviews() { return $this->hasMany(Review::class); }
}
