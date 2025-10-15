<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CategoryResource extends JsonResource
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
            'type' => $this->type,  
            'color' => $this->color,  
            'is_active' => $this->is_active,  
            'show_in_menu' => $this->show_in_menu, 
            'has_parent_category' => $this->parent_id != null ? true : false, 
            'parent' => [
                'id' => $this->parent?->id,
                'name' => $this->parent?->name,
            ]
            
        ];
    }
}
