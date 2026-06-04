<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ReservationResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id'          => $this->id,
            'date'        => $this->date,
            'time'        => $this->time,
            'guest_count' => $this->guest_count,
            'status'      => $this->status,
            'notes'       => $this->notes,
            'restaurant'  => [
                'id'   => $this->restaurant->id,
                'name' => $this->restaurant->name,
            ],
            'table'       => [
                'id'           => $this->table->id,
                'table_number' => $this->table->table_number,
            ],
        ];
    }
}