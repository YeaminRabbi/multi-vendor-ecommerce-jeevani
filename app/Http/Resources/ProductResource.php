<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
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
            'name' => $this->name,
            'slug' => $this->slug,
            'sku' => $this->sku,
            'parent_category' => $this->category->parent?->name ?? null,
            'image' => asset($this->featured_image_url),
            'about' => $this->about,
            'details' => $this->details,
            'description' => $this->description,
            'has_discount' => $this->checkDiscountValidity() == 0 ? false : true,
            'has_store' => $this->shop_id == null ? false : true,
            'price' => $this->getDiscountPriceAttribute(),
            'discount_price' => $this->getDiscountPriceAttribute(),
            'original_price' => $this->price,
            'category' => [
                'id' => $this->category->id,
                'name' => $this->category->name,
                'parent_category' => $this->category->parent?->name,
            ],
            'store' => [
                'id' => $this->shop_id,
                'name' => $this->store?->name,
            ],
            'patient_type' => $this->patient_type
        ];
    }
}
