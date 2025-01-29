<?php

namespace App\Http\Controllers\API\Favorite;

use App\Http\Controllers\BaseController;

use App\Http\Requests\FavoriteRequests\FavoriteAuthorRequest;
use App\Http\Resources\AuthorResources\AuthorResource;
use App\Services\UserServices\UserService;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class FavoriteAuthorController extends BaseController
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
        return $this->ok(AuthorResource::collection($this->service->listFavouriteAuthors(user: $user)));
    }

    /**
     * Store a newly created resource in storage.
     * @return JsonResponse
     * @var FavoriteAuthorRequest $request
     */
    public function store(FavoriteAuthorRequest $request)
    {
        $user = Auth::user();
        $authorId = $request->get('author_id');

        $this->service->addFavouriteAuthor(user: $user, authorId: $authorId);

        return $this->created($authorId);
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        $user = Auth::user();

        $this->service->removeFavouriteAuthor(user: $user, authorId: $id);

        return $this->deleted();
    }

}
