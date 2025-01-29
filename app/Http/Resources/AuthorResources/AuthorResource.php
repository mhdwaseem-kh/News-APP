<?php

namespace App\Http\Resources\AuthorResources;

use App\Constants\Models\AuthorColumns;
use App\Http\Resources\BaseResource;
use Illuminate\Http\Request;

class AuthorResource extends BaseResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return array_merge(parent::toArray($request), [
            'name' => $this[AuthorColumns::NAME],
        ]);
    }
}
