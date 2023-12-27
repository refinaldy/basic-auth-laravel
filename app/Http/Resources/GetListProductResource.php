<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class GetListProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return array(
            'id' => $this->id,
            'product_name' => $this->name,
            'product_desc' => $this->description,
            'product_price' => $this->price,
            'published_at' => \Carbon\Carbon::parse($this->published_at)->format('d M Y H:i'),
        );
    }
}
