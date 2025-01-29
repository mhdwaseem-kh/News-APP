<?php

namespace App\Services\CategoryServices;

use App\Repositories\CategoryRepositories\CategoryRepository;
use App\Services\BaseService;
use Exception;


class CategoryService extends BaseService
{


    /**
     * CategoryService constructor.
     * @param CategoryRepository $repository
     * @throws Exception
     */
    public function __construct(protected CategoryRepository $repository)
    {
        parent::__construct($repository);
    }




}
