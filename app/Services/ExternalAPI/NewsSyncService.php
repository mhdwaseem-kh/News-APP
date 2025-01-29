<?php

namespace App\Services\ExternalAPI;

use App\Constants\ExternalPlatforms\ExternalPlatforms;
use App\Constants\Models\ArticleColumns;
use App\Constants\Models\AuthorColumns;
use App\Constants\Models\CategoryColumns;
use App\Constants\Models\SourceColumns;
use App\Mappers\GuardianAPIMapper;
use App\Mappers\NewsAPIMapper;
use App\Services\ArticleServices\ArticleService;
use App\Services\ServiceHelper;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Support\Carbon;

class NewsSyncService
{

    public function __construct(
        protected ArticleService $articleService,
        protected NewsAPIService $newsAPIService,
        protected GuardianAPIService $guardianAPIService,
        protected NewsAPIMapper $newsAPIMapper,
        protected GuardianAPIMapper $guardianAPIMapper
    ) {

    }

    /**
     * @return void
     * @throws ConnectionException
     * @throws \Exception
     * @throws BindingResolutionException
     */
    public function sync(): void
    {
        $lastHourDateAndTime = Carbon::now('UTC')->subHour()->format('Y-m-d\TH:i:s');
        $newsArticles = $this->newsAPIService->fetchNews(fromDate: $lastHourDateAndTime);
        $guardianArticles = $this->guardianAPIService->fetchNews(fromDate: $lastHourDateAndTime);

        $sourceService = ServiceHelper::sourceService();
        $categoryService = ServiceHelper::categoryService();
        $authorService = ServiceHelper::authorService();

        foreach ($newsArticles['articles'] as $article) {

            $source = $sourceService->first([SourceColumns::EXTERNAL_ID => $article['source']['id']]);
            if (!$source) {
                $source = $sourceService->first([SourceColumns::EXTERNAL_ID => ExternalPlatforms::NEWS_API]);
            }
            $author = $authorService->first([AuthorColumns::NAME => $article['author'] ?? 'unknown']);

            if (!$author) {
                $author = $authorService->create([
                    AuthorColumns::NAME => $article['author'] ?? 'unknown',
                ]);
            }

            $article['source_id'] = $source[SourceColumns::ID];
            $article['category_id'] = $source[SourceColumns::CATEGORY_ID];
            $article['author_id'] = $author[AuthorColumns::ID];

            $mappedArticle = $this->newsAPIMapper->map($article);
            $oldArticle = $this->articleService->first([ArticleColumns::TITLE => $mappedArticle[ArticleColumns::TITLE]]);
            if (!$oldArticle) {
                $this->articleService->create($mappedArticle);
            }
        }

        foreach ($guardianArticles['response']['results'] as $article) {
            $source = $sourceService->first([SourceColumns::EXTERNAL_ID => ExternalPlatforms::GUARDIAN_NEWS]);
            $category = $categoryService->first([CategoryColumns::EXTERNAL_ID => $article['sectionId']]) ?? $source->category;
            $author = $authorService->first([AuthorColumns::NAME => $article['fields']['byline'] ?? 'unknown']);

            if (!$author) {
                $author = $authorService->create([
                    AuthorColumns::NAME => $article['fields']['byline'] ?? 'unknown',
                ]);
            }

            $article['source_id'] = $source[SourceColumns::ID];
            $article['category_id'] = $category[CategoryColumns::ID];
            $article['author_id'] = $author[AuthorColumns::ID];

            $mappedArticle = $this->guardianAPIMapper->map($article);

            $oldArticle = $this->articleService->first([ArticleColumns::TITLE => $mappedArticle[ArticleColumns::TITLE]]);
            if (!$oldArticle) {
                $this->articleService->create($mappedArticle);
            }

        }
    }

}
