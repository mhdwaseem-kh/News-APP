<?php

namespace App\Http\Resources;

use App\Constants\Models\BaseColumns;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BaseResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $data = [];

        if ($this->resource instanceof Model) {
            if (array_key_exists(BaseColumns::ID, $this->resource->getAttributes()))
                $data['id'] = $this->resource[BaseColumns::ID];


        }

        return $data;
    }
}
