<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class NotificationResource extends JsonResource
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
            'type' => $this->type,
            'notifiable_id' => $this->notifiable_id,
            'notifiable_type' => $this->notifiable_type,
            'data' => [
                'order_id' => $this->data['order_id'],
                'order_total' => $this->data['order_total'],
                'order_date' => date('d M, Y', strtotime($this->data['order_date'])),
            ],
            'read_at' => $this->read_at,
            'created_at' => date('d M, Y', strtotime($this->created_at)),
            'updated_at' => date('d M, Y', strtotime($this->updated_at)),
        ];
    }
}
