<?php

namespace App\Constants\Models;

class ArticleColumns extends BaseColumns
{
    public const TABLE = 'articles';
    public const EXTERNAL_ID = 'external_id';
    public const EXTERNAL_PLATFORM = 'external_platform';
    public const TITLE = 'title';
    public const CONTENT = 'content';
    public const AUTHOR_ID = 'author_id';
    public const SOURCE_ID = 'source_id';
    public const CATEGORY_ID = 'category_id';
    public const EXTERNAL_URL = 'external_url';
    public const IMAGE = 'image';
    public const PUBLISHED_AT = 'published_at';

    public const FILLABLE = [
        self::EXTERNAL_PLATFORM,
        self::TITLE,
        self::CONTENT,
        self::AUTHOR_ID,
        self::SOURCE_ID,
        self::CATEGORY_ID,
        self::PUBLISHED_AT,
    ];
}
