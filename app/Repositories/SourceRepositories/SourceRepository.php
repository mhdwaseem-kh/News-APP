<?php

namespace App\Repositories\SourceRepositories;

use App\Repositories\BaseRepository;

class SourceRepository extends BaseRepository
{
    /**
     * SourceRepository constructor.
     * @param $persistentClass
     * @param string[] $defaultOrder
     */
    public function __construct($persistentClass, array $defaultOrder = ['id' => 'desc'])
    {
        parent::__construct($persistentClass, $defaultOrder);
    }




}
