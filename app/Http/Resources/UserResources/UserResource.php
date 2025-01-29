<?php

namespace App\Http\Resources\UserResources;

use App\Constants\Models\UserColumns;
use App\Http\Resources\BaseResource;
use Illuminate\Http\Request;

class UserResource extends BaseResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return array_merge(parent::toArray($request), [
            'name' => $this[UserColumns::NAME],
            'email' => $this[UserColumns::EMAIL],
        ]);
    }
}
