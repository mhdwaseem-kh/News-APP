<?php

namespace App\Constants\Models;

class SourceColumns extends BaseColumns
{
    public const TABLE = 'sources';
    public const NAME = 'name';
    public const EXTERNAL_ID = 'external_id';

    public const CATEGORY_ID = 'category_id';

    public const FILLABLE = [
        self::NAME,
        self::EXTERNAL_ID,
        self::CATEGORY_ID,
    ];
}
