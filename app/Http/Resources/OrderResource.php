<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
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
            'uuid' => $this->uuid,
            'type' => $this->type,
            'account_id' => $this->account_id,
            'user' => new UserResource($this->user),
            'total' => $this->total,
            'discount' => $this->discount,
            'shipping' => $this->shipping,
            'vat' => $this->vat,
            'status' => $this->status,
            'payment_method' => $this->payment_method,
            'order_placed' => date('d M, Y', strtotime($this->created_at)),
            'delivery_details' => [
                'name' => $this->name,
                'phone' => $this->phone,
                'address' => $this->address,
            ],
            'items' => OrderItemsResource::collection($this->items),
        ];
    }
}
