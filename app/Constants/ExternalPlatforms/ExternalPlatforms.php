<?php

namespace App\Constants\ExternalPlatforms;

class ExternalPlatforms
{
    public const NEWS_API = 'NEWS_API';
    public const GUARDIAN_NEWS = 'GUARDIAN_NEWS';

    public const SET = [
        self::NEWS_API,
        self::GUARDIAN_NEWS,
    ];

    public const DISPLAY_VALUE = [
        self::NEWS_API => 'News API',
        self::GUARDIAN_NEWS => 'Guardian News',
    ];
}
