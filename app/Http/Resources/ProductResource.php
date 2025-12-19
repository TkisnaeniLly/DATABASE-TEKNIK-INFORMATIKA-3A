<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id'       => $this['id'],
            'name'     => $this['product_name'],
            'slug'     => $this['slug'],
            'category' => $this['Category']['category_name'] ?? null,
            'brand'    => $this['Brand']['brand_name'] ?? null,
            'image'    => $this['Media'][0]['media_url'] ?? null,
            'variants' => $this['Variants'] ?? [],
        ];
    }
}