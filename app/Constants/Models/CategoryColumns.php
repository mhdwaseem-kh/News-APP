<?php

namespace App\Constants\Models;

class CategoryColumns extends BaseColumns
{
    public const TABLE = 'categories';
    public const EXTERNAL_ID = 'external_id';
    public const NAME = 'name';

    public const FILLABLE = [
        self::NAME,
        self::EXTERNAL_ID,
    ];
}
