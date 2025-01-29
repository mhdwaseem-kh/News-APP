<?php

namespace App\Services;

use App\Repositories\Contracts\RepositoryInterface;
use App\Services\Contracts\ServiceInterface;
use Exception;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

abstract class BaseService implements ServiceInterface
{
    /**
     * @var RepositoryInterface $primaryRepository
     */
    protected RepositoryInterface $primaryRepository;

    /**
     * BaseService constructor.
     * @param RepositoryInterface $primaryRepository Model's Primary Repository
     * @throws Exception
     */
    public function __construct(RepositoryInterface $primaryRepository)
    {
        $this->primaryRepository = $primaryRepository;
    }

    /**
     * @param array $attributes
     * @return Model|null
     */
    public function create(array $attributes): ?Model
    {
        return $this->primaryRepository->create(attributes: $attributes);
    }

    /**
     * @return Collection
     * @throws Exception
     */
    public function get(): Collection
    {
        return $this->primaryRepository->get();
    }

    /**
     * @param $id
     * @param array $columns
     * @return mixed|null
     * @throws Exception
     */
    public function find($id, array $columns = ['*']): mixed
    {
        return $this->primaryRepository->find(id: $id, columns: $columns);
    }

    /**
     * @param $conditions
     * @param array $columns
     * @return mixed|null
     * @throws Exception
     */
    public function first($conditions, array $columns = ['*']): mixed
    {
        return $this->primaryRepository->first(conditions: $conditions, columns: $columns);
    }


    /**
     * @param $querySet
     * @param int $perPage
     * @param array $columns
     * @return LengthAwarePaginator
     * @throws Exception
     */
    public function paginate($querySet, int $perPage = 15, array $columns = ['*']): LengthAwarePaginator
    {
        return $this->primaryRepository->paginate(querySet: $querySet, perPage: $perPage, columns: $columns);
    }
}
