<?php

namespace App\Services\ArticleServices;

use App\Models\User;
use App\Repositories\ArticleRepositories\ArticleRepository;
use App\Services\BaseService;
use Exception;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;


class ArticleService extends BaseService
{


    /**
     * ArticleService constructor.
     * @param ArticleRepository $repository
     * @throws Exception
     */
    public function __construct(protected ArticleRepository $repository)
    {
        parent::__construct($repository);
    }


    /**
     * @param int $perPage
     * @param int|null $categoryId
     * @param int|null $authorId
     * @param string|null $fromDate
     * @param string|null $toDate
     * @return LengthAwarePaginator
     * @throws Exception
     */
    public function fetchArticles(int $perPage = 10, int $categoryId = null, int $authorId = null, string $fromDate = null, string $toDate = null): LengthAwarePaginator
    {
        $articles = $this->repository->query(categoryId: $categoryId, authorId: $authorId, fromDate: $fromDate, toDate: $toDate);
        return $this->repository->paginate(querySet: $articles, perPage: $perPage);
    }


    /**
     * @param User $user
     * @param int $perPage
     * @return LengthAwarePaginator
     * @throws Exception
     */
    public function articlesByCategoriesAndAuthors(User $user, int $perPage = 10): LengthAwarePaginator
    {
        $categoryIds = $user->favoriteCategories()->get()->pluck('id')->toArray();
        $authorIds = $user->favoriteAuthors()->get()->pluck('id')->toArray();
        $articles = $this->repository->articlesByCategoriesAndAuthors(categoryIds: $categoryIds, authorIds: $authorIds);
        return $this->repository->paginate(querySet: $articles, perPage: $perPage);
    }


}
