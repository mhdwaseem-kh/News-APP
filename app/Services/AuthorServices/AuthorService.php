<?php

namespace App\Services\AuthorServices;

use App\Repositories\AuthorRepositories\AuthorRepository;
use App\Services\BaseService;
use Exception;


class AuthorService extends BaseService
{


    /**
     * AuthorService constructor.
     * @param AuthorRepository $repository
     * @throws Exception
     */
    public function __construct(protected AuthorRepository $repository)
    {
        parent::__construct($repository);
    }




}
