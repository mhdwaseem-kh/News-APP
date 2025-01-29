<?php


namespace App\Repositories\Contracts;


use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Exception;

interface RepositoryInterface
{
    /**
     * @param array $attributes
     * @return Model|null
     */
    public function create(array $attributes): ?Model;

    /**
     * @return Collection
     * @throws Exception
     */
    public function get(): Collection;

    /**
     * @param $id
     * @param array $columns
     * @return mixed|null
     * @throws Exception
     */
    public function find($id, array $columns = ['*']): mixed;

    /**
     * @param $conditions
     * @param array $columns
     * @return mixed|null
     * @throws Exception
     */
    public function first($conditions, array $columns = ['*']): mixed;

    /**
     * @param Builder $querySet
     * @param int $perPage
     * @param array $columns
     * @return LengthAwarePaginator
     * @throws Exception
     */
    public function paginate(Builder $querySet, int $perPage = 15, array $columns = ['*']): LengthAwarePaginator;

}
