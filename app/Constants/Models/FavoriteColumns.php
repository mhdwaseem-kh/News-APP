<?php

namespace App\Constants\Models;

class FavoriteColumns extends BaseColumns
{
    public const TABLE = 'favorites';
    public const USER_ID = 'user_id';
    public const FAVORITABLE_ID = 'favoritable_id';
    public const FAVORITABLE_TYPE = 'favoritable_type';


    public const FILLABLE = [
        self::USER_ID,
        self::FAVORITABLE_ID,
        self::FAVORITABLE_TYPE,
    ];
}
