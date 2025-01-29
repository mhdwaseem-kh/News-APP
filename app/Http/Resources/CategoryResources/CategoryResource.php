<?php

namespace App\Http\Resources\CategoryResources;

use App\Constants\Models\CategoryColumns;
use App\Http\Resources\BaseResource;
use Illuminate\Http\Request;

class CategoryResource extends BaseResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return array_merge(parent::toArray($request), [
            'name' => $this[CategoryColumns::NAME],
        ]);
    }
}
