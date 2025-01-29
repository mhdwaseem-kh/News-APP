<?php

namespace App\Http\Controllers\API\Category;

use App\Http\Controllers\BaseController;


use App\Http\Resources\CategoryResources\CategoryResource;
use App\Services\CategoryServices\CategoryService;
use Exception;

class CategoryController extends BaseController
{

    /** @var CategoryService */
    private CategoryService $service;

    /**
     * Create a new CategoryService instance.
     *
     * @param CategoryService $service
     */
    public function __construct(CategoryService $service)
    {
        $this->service = $service;
    }

    /**
     * Display a listing of the resource.
     * @throws Exception
     */
    public function index()
    {
        return $this->ok(CategoryResource::collection($this->service->get()));
    }


}
