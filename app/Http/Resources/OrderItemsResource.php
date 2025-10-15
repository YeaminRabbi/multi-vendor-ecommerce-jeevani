<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderItemsResource extends JsonResource
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
            'order_id' => $this->order_id,
            'product_id' => $this->product_id,
            'item' => $this->item,
            'image' => asset($this->product->featured_image_url) ?? null,
            'price' => $this->price,
            'discount' => $this->discount,
            'vat' => $this->vat,
            'returned' => $this->returned,
            'total' => $this->total,
            'qty' => $this->qty,
        ];
    }
}
