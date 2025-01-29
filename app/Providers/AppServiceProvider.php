<?php

namespace App\Providers;

use App\Models\Article;
use App\Models\Author;
use App\Models\Category;
use App\Models\Product;
use App\Models\Source;
use App\Models\User;
use App\Repositories\ArticleRepositories\ArticleRepository;
use App\Repositories\AuthorRepositories\AuthorRepository;
use App\Repositories\CategoryRepositories\CategoryRepository;
use App\Repositories\ProductRepositories\ProductRepository;
use App\Repositories\SourceRepositories\SourceRepository;
use App\Repositories\UserRepositories\UserRepository;
use App\Services\ArticleServices\ArticleService;
use App\Services\AuthorServices\AuthorService;
use App\Services\CategoryServices\CategoryService;
use App\Services\ProductServices\ProductService;
use App\Services\SourceServices\SourceService;
use App\Services\UserServices\UserService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(UserService::class, UserService::class);

        $this->app->singleton(UserRepository::class, function () {
            return new UserRepository(User::class);
        });

        $this->app->singleton(ArticleService::class, ArticleService::class);

        $this->app->singleton(ArticleRepository::class, function () {
            return new ArticleRepository(Article::class);
        });

        $this->app->singleton(AuthorService::class, AuthorService::class);

        $this->app->singleton(AuthorRepository::class, function () {
            return new AuthorRepository(Author::class);
        });

        $this->app->singleton(CategoryService::class, CategoryService::class);

        $this->app->singleton(CategoryRepository::class, function () {
            return new CategoryRepository(Category::class);
        });

        $this->app->singleton(SourceService::class, SourceService::class);

        $this->app->singleton(SourceRepository::class, function () {
            return new SourceRepository(Source::class);
        });

    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
