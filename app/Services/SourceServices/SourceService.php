<?php

namespace App\Services\SourceServices;

use App\Repositories\SourceRepositories\SourceRepository;
use App\Services\BaseService;
use Exception;

class SourceService extends BaseService
{


    /**
     * SourceService constructor.
     * @param SourceRepository $repository
     * @throws Exception
     */
    public function __construct(protected SourceRepository $repository)
    {
        parent::__construct($repository);
    }




}
