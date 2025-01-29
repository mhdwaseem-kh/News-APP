<?php

namespace App\Repositories;

use App\Models\BaseModel;
use App\Repositories\Contracts\RepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Exception;

abstract class BaseRepository implements RepositoryInterface
{
    /**
     * @var string[] order for queries
     */
    protected array $defaultOrder;

    /**
     * @var BaseModel $persistentClass
     */
    protected $persistentClass;

    /**
     * Repository constructor.
     * @param $persistentClass
     * @param string[] $defaultOrder
     */
    protected function __construct($persistentClass, array $defaultOrder = ['id' => 'desc'])
    {
        $this->persistentClass = $persistentClass;
        $this->defaultOrder = $defaultOrder;
    }

    /**
     * @param array $attributes
     * @return Model|null
     * @throws Exception
     */
    public function create(array $attributes): ?Model
    {
        try {
            return $this->persistentClass::create(attributes: $attributes);
        } catch (Exception $e) {
            report($e);
            throw $e;
        }
    }

    /**
     * @return Collection
     * @throws Exception
     */
    public function get(): Collection
    {
        try {
            return $this->persistentClass::query()->get();
        } catch (Exception $e) {
            report($e);
            throw $e;
        }
    }

    /**
     * @param $id
     * @param array $columns
     * @return mixed|null
     * @throws Exception
     */
    public function find($id, array $columns = ['*']): mixed
    {
        try {
            $data = $this->persistentClass::find(id: $id, columns: $columns);
        } catch (Exception $e) {
            report($e);
            throw $e;
        }
        return $data;
    }

    /**
     * @param $conditions
     * @param array $columns
     * @return mixed|null
     * @throws Exception
     */
    public function first($conditions, array $columns = ['*']): mixed
    {
        try {
            $data = $this->persistentClass::query()->where($conditions)->first($columns);
        } catch (Exception $e) {
            report($e);
            throw $e;
        }
        return $data;
    }

    /**
     * @param Builder $querySet
     * @param int $perPage
     * @param array $columns
     * @return LengthAwarePaginator
     */
    public function paginate(Builder $querySet, int $perPage = 15, array $columns = ['*']): LengthAwarePaginator
    {
        try {
            $data = $querySet->paginate(perPage: $perPage, columns: $columns);
        } catch (Exception $e) {
            error_log($e);
            throw $e;
        }
        return $data;
    }

}
