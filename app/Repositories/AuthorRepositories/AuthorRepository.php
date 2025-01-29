<?php

namespace App\Repositories\AuthorRepositories;

use App\Repositories\BaseRepository;

class AuthorRepository extends BaseRepository
{
    /**
     * AuthorRepository constructor.
     * @param $persistentClass
     * @param string[] $defaultOrder
     */
    public function __construct($persistentClass, array $defaultOrder = ['id' => 'desc'])
    {
        parent::__construct($persistentClass, $defaultOrder);
    }




}
