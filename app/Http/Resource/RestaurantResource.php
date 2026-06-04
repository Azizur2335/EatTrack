<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class RestaurantResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id'          => $this->id,
            'name'        => $this->name,
            'description' => $this->description,
            'address'     => $this->address,
            'city'        => $this->city,
            'phone'       => $this->phone,
            'category'    => $this->category,
            'open_time'   => $this->open_time,
            'close_time'  => $this->close_time,
            'maps_link'   => $this->maps_link,
            'image'       => $this->image,
            'status'      => $this->status,
            'menus'       => $this->whenLoaded('menus'),
            'tables'      => $this->whenLoaded('tables'),
        ];
    }
}