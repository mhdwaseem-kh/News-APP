<?php

namespace App\Mappers;

use App\Constants\ExternalPlatforms\ExternalPlatforms;
use App\Constants\Models\ArticleColumns;
use App\Mappers\Contracts\ArticleMapperInterface;
use Carbon\Carbon;

class GuardianAPIMapper implements ArticleMapperInterface
{
    public function map(array $data): array
    {
        return [
            ArticleColumns::EXTERNAL_ID       => $data['id'] ?? null,
            ArticleColumns::TITLE             => $data['webTitle'] ?? 'Untitled',
            ArticleColumns::CONTENT           => $data['webTitle'] ?? 'No content available',
            ArticleColumns::AUTHOR_ID         => $data['author_id']['byline'] ?? 1,
            ArticleColumns::CATEGORY_ID       => $data['category_id'] ?? 1,
            ArticleColumns::SOURCE_ID         => $data['source_id'] ?? 1,
            ArticleColumns::PUBLISHED_AT      => Carbon::parse($data['webPublicationDate']) ?? now(),
            ArticleColumns::EXTERNAL_URL      => $data['webUrl'] ?? '',
            ArticleColumns::IMAGE             => $data['fields']['thumbnail'] ?? null,
            ArticleColumns::EXTERNAL_PLATFORM => ExternalPlatforms::GUARDIAN_NEWS,
        ];
    }
}
