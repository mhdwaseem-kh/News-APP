<?php

use App\Http\Controllers\API\Article\ArticleController;
use App\Http\Controllers\API\Auth\AuthController;
use App\Http\Controllers\API\Author\AuthorController;
use App\Http\Controllers\API\Category\CategoryController;
use App\Http\Controllers\API\Favorite\FavoriteAuthorController;
use App\Http\Controllers\API\Favorite\FavoriteCategoryController;
use Illuminate\Support\Facades\Route;

//Route::get('/user', function (Request $request) {
//    return $request->user();
//})->middleware('auth:api');

Route::group([], function () {

    Route::group(['prefix' => 'auth'], function () {
        Route::post('register', [AuthController::class,'register'])->name('register');
        Route::post('login', [AuthController::class,'login'])->name('login');
    });

    Route::resource('articles', ArticleController::class)->only(['index', 'show']);
    Route::get('categories', [CategoryController::class,'index']);
    Route::get('authors', [AuthorController::class,'index']);

});

Route::group(['middleware' => 'auth:api'], function () {

    Route::group(['prefix' => 'auth'], function () {
        Route::get('me', [AuthController::class,'me']);
        Route::post('logout', [AuthController::class,'logout'])->name('logout');

    });

    Route::group(['prefix' => 'favorites'], function () {
        Route::resource('categories', FavoriteCategoryController::class)->except(['show', 'update']);
        Route::resource('authors', FavoriteAuthorController::class)->except(['show', 'update']);;
    });

    Route::get('related-articles', [ArticleController::class, 'relatedArticleByUser'])->name('articles.related-articles');


});



Route::get('/test', function () {

    $array = ['D', 'H', 'S', 'C'];

    $data = [];

    foreach ($array as $value) {
        for ($i=1; $i <= 13; $i++) {
            array_push($data, "$value $i");
        }
    }

    $d = $data;
    foreach ($data as $key => $value) {
        $i = array_rand($d);
        $shuffle[] = $data[$i];

    }

    dd($data,$shuffle, array_rand($d));
});




