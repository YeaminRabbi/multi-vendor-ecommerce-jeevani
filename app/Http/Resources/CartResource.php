<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CartResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'item' => $this->item,
            'qty' => $this->qty,
            'price' => $this->price,
            'total' => $this->total,
            'image' => $this->product->featured_image_url ? asset($this->product->featured_image_url) : 'https://placehold.co/600x400',
        ];
    }
}
