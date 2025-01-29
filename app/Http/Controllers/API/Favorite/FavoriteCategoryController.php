<?php

namespace App\Http\Controllers\API\Favorite;

use App\Http\Controllers\BaseController;
use App\Http\Requests\FavoriteRequests\FavoriteCategoryRequest;
use App\Http\Resources\CategoryResources\CategoryResource;
use App\Services\UserServices\UserService;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class FavoriteCategoryController extends BaseController
{

    /** @var UserService */
    private UserService $service;

    /**
     * Create a new UserService instance.
     *
     * @param UserService $service
     */
    public function __construct(UserService $service)
    {
        $this->service = $service;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        return $this->ok(CategoryResource::collection($this->service->listFavouriteCategories(user: $user)));
    }

    /**
     * Store a newly created resource in storage.
     * @return JsonResponse
     * @var FavoriteCategoryRequest $request
     */
    public function store(FavoriteCategoryRequest $request)
    {
        $user = Auth::user();
        $categoryId = $request->get('category_id');

        $this->service->addFavouriteCategory(user: $user, categoryId: $categoryId);

        return $this->created($categoryId);
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        $user = Auth::user();

        $this->service->removeFavouriteCategory(user: $user, categoryId: $id);

        return $this->deleted();
    }
}
