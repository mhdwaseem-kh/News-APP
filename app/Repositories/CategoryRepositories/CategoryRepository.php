<?php

namespace App\Repositories\CategoryRepositories;

use App\Repositories\BaseRepository;

class CategoryRepository extends BaseRepository
{
    /**
     * CategoryRepository constructor.
     * @param $persistentClass
     * @param string[] $defaultOrder
     */
    public function __construct($persistentClass, array $defaultOrder = ['id' => 'desc'])
    {
        parent::__construct($persistentClass, $defaultOrder);
    }




}
