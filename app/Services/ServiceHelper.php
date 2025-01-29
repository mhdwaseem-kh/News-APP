<?php


namespace App\Services;


use App\Services\ArticleServices\ArticleService;
use App\Services\AuthorServices\AuthorService;
use App\Services\CategoryServices\CategoryService;
use App\Services\ExternalAPI\GuardianAPIService;
use App\Services\ExternalAPI\NewsAPIService;
use App\Services\SourceServices\SourceService;
use App\Services\UserServices\UserService;
use Illuminate\Contracts\Container\BindingResolutionException;

class ServiceHelper
{
    /**
     * @throws BindingResolutionException
     */
    static function userService(): UserService
    {
        return app()->make(UserService::class);
    }

    /**
     * @throws BindingResolutionException
     */
    static function articleService(): ArticleService
    {
        return app()->make(ArticleService::class);
    }

    /**
     * @throws BindingResolutionException
     */
    static function authorService(): AuthorService
    {
        return app()->make(AuthorService::class);
    }

    /**
     * @throws BindingResolutionException
     */
    static function categoryService(): CategoryService
    {
        return app()->make(CategoryService::class);
    }

    /**
     * @throws BindingResolutionException
     */
    static function sourceService(): SourceService
    {
        return app()->make(SourceService::class);
    }

    /**
     * @throws BindingResolutionException
     */
    static function newsApiService(): NewsAPIService
    {
        return app()->make(NewsAPIService::class);
    }

    /**
     * @throws BindingResolutionException
     */
    static function guardianApiService(): GuardianAPIService
    {
        return app()->make(GuardianAPIService::class);
    }

}
