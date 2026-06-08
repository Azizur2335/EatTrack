<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Attributes\Fillable;

#[Fillable(['promo_id', 'customer_id'])]
class ClaimedPromo extends Model
{
    public function promo()    { return $this->belongsTo(Promo::class); }
    public function customer() { return $this->belongsTo(User::class, 'customer_id'); }
}