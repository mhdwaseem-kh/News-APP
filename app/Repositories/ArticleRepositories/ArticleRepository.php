<?php

namespace App\Repositories\ArticleRepositories;

use App\Constants\Models\ArticleColumns;
use App\Repositories\BaseRepository;
use Illuminate\Database\Eloquent\Builder;

class ArticleRepository extends BaseRepository
{
    /**
     * ArticleRepository constructor.
     * @param $persistentClass
     * @param string[] $defaultOrder
     */
    public function __construct($persistentClass, array $defaultOrder = ['id' => 'desc'])
    {
        parent::__construct($persistentClass, $defaultOrder);
    }

    /**
     * @param int|null $categoryId
     * @param int|null $authorId
     * @param string|null $fromDate
     * @param string|null $toDate
     * @return Builder
     */
    public function query(int $categoryId = null, int $authorId = null, string $fromDate = null, string $toDate = null): Builder
    {
        $articles = $this->persistentClass::query();
        if ($categoryId) {
            $articles->where(ArticleColumns::CATEGORY_ID, $categoryId);
        }
        if ($authorId) {
            $articles->where(ArticleColumns::AUTHOR_ID, $authorId);
        }
        if ($fromDate) {
            $articles->where(ArticleColumns::PUBLISHED_AT, '>=', $fromDate);
        }
        if ($toDate) {
            $articles->where(ArticleColumns::PUBLISHED_AT, '<=', $toDate);
        }

        return $articles;
    }

    /**
     * @param array $categoryIds
     * @param array $authorIds
     * @return Builder
     */
    public function articlesByCategoriesAndAuthors(array $categoryIds = [], array $authorIds = []): Builder
    {
        $articles = $this->persistentClass::query();

        if (count($categoryIds)) {
            $articles->whereIn(ArticleColumns::CATEGORY_ID, $categoryIds);
        }

        if (count($authorIds)) {
            $articles->orWhereIn(ArticleColumns::AUTHOR_ID, $authorIds);
        }

        return $articles;
    }


}
