<?php

namespace App\Http\Controllers\API\Article;

use App\Http\Controllers\BaseController;

use App\Http\Requests\ArticleRequests\ArticleListRequest;
use App\Http\Requests\PaginateRequest;
use App\Http\Resources\ArticleResources\ArticleResource;
use App\Http\Resources\PaginationResource;
use App\Models\Article;
use App\Services\ArticleServices\ArticleService;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Exception;

class ArticleController extends BaseController
{

    /** @var ArticleService */
    private ArticleService $service;

    /**
     * Create a new ArticleService instance.
     *
     * @param ArticleService $service
     */
    public function __construct(ArticleService $service)
    {
        $this->service = $service;
    }

    /**
     * Display a listing of the resource.
     * @throws Exception
     */
    public function index(ArticleListRequest $request)
    {
        $perPage = $request->query('perPage', 10);
        $categoryId = $request->query('category_id');
        $authorId = $request->query('author_id');
        $fromDate = $request->query('from_date');
        $toDate = $request->query('to_date');

        $articles = $this->service->fetchArticles(perPage: $perPage, categoryId: $categoryId, authorId: $authorId,
            fromDate: $fromDate, toDate: $toDate );
        return new PaginationResource(resourceClass:  ArticleResource::class, resource: $articles);
    }

    /**
     * Store a newly created resource in storage.
     * @return JsonResponse
     * @var Article $article
     */
    public function show(Article $article)
    {
        return $this->ok(new ArticleResource($article));
    }

    /**
     * @param PaginateRequest $request
     * @return PaginationResource
     * @throws Exception
     */
    public function relatedArticleByUser(PaginateRequest $request)
    {
        $user = Auth::user();
        $perPage = $request->query('perPage', 10);
        $articles = $this->service->articlesByCategoriesAndAuthors(user: $user, perPage: $perPage);
        return new PaginationResource(resourceClass:  ArticleResource::class, resource: $articles);
    }

}
