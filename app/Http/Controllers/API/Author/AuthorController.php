<?php

namespace App\Http\Controllers\API\Author;

use App\Http\Controllers\BaseController;

use App\Http\Resources\AuthorResources\AuthorResource;
use App\Services\AuthorServices\AuthorService;
use Exception;

class AuthorController extends BaseController
{

    /** @var AuthorService */
    private AuthorService $service;

    /**
     * Create a new AuthorService instance.
     *
     * @param AuthorService $service
     */
    public function __construct(AuthorService $service)
    {
        $this->service = $service;
    }

    /**
     * Display a listing of the resource.
     * @throws Exception
     */
    public function index()
    {
        return $this->ok(AuthorResource::collection($this->service->get()));
    }

}
