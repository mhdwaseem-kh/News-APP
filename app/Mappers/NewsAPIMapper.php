<?php

namespace App\Mappers;

use App\Constants\ExternalPlatforms\ExternalPlatforms;
use App\Constants\Models\ArticleColumns;
use App\Mappers\Contracts\ArticleMapperInterface;
use Carbon\Carbon;

class NewsAPIMapper implements ArticleMapperInterface
{
    public function map(array $data): array
    {
        return [
            ArticleColumns::EXTERNAL_ID       => $data['url'] ?? null,
            ArticleColumns::TITLE             => $data['title'] ?? 'Untitled',
            ArticleColumns::CONTENT           => $data['content'] ?? $data['description'] ?? 'No content available',
            ArticleColumns::AUTHOR_ID         => $data['author_id'] ?? 1,
            ArticleColumns::CATEGORY_ID       => $data['category_id'] ?? 1,
            ArticleColumns::SOURCE_ID         => $data['source_id'] ?? 1,
            ArticleColumns::PUBLISHED_AT      => Carbon::parse($data['publishedAt']) ?? now(),
            ArticleColumns::EXTERNAL_URL      => $data['url'] ?? '',
            ArticleColumns::IMAGE             => null,
            ArticleColumns::EXTERNAL_PLATFORM => ExternalPlatforms::NEWS_API,
        ];
    }
}
