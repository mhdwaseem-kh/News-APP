<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BaseModel extends Model {

    public static function create(array $attributes = [])
    {
        return static::query()->create($attributes);
    }

    public static function find($id, $columns = ['*'])
    {
        return static::query()->find($id, $columns = ['*']);
    }


}
