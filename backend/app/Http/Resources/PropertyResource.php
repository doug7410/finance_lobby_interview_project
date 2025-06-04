<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PropertyResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'address' => $this->address,
            'property_type' => $this->property_type,
            'purchase_price' => $this->purchase_price,
            'current_value' => $this->current_value,
            'bedrooms' => $this->bedrooms,
            'bathrooms' => $this->bathrooms,
            'square_feet' => $this->square_feet,
            'description' => $this->description,
            'latest_metric' => $this->whenLoaded('latestMetric'),
            'metrics' => $this->whenLoaded('metrics'),
            'images' => $this->whenLoaded('images'),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
