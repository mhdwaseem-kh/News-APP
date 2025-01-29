<?php

namespace App\Constants\Models;

class AuthorColumns extends BaseColumns
{
    public const TABLE = 'authors';
    public const NAME = 'name';

    public const FILLABLE = [
        self::NAME,
    ];
}
