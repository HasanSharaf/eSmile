<?php

namespace App\Repositories;

use App\Repositories\BaseRepository;
use App\useCases\BaseUseCase;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;
use Modules\Auth\Entities\Auth;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * Class EloquentBaseRepository
 *
 * @package App\Repositories\Eloquent
 */
abstract class EloquentBaseRepository implements BaseRepository
{

    /**
     * @var Model An instance of the Eloquent Model
     */
    protected $model;

    /**
     * @param Model $model
     */
    public function __construct($model = null)
    {
        $this->model = $model;
    }

    /**
     * @param $function
     * @param $args
     * @return mixed
     */
    public function __call($function, $args){
        $functionType = strtolower(substr($function, 0, 3));
        $propName = lcfirst(substr($function, 3));
        switch ($functionType) {
            case 'get':
                if (property_exists($this, $propName)) {
                    return $this->$propName;
                }
                break;
            case 'set':
                if (property_exists($this, $propName)) {
                    $this->$propName = $args[0];
                }
                break;
        }
    }

    public function findOrFail(int $id, ?array $with = null, ?array $order = null)
    {
        $model = $this->find($id, $with, $order);

        BaseUseCase::isObject(Model::class , $model , NotFoundHttpException::class , 'model not found');

        return $model ?? abort(404);

    }

    /**
     * @param int $id
     * @param array|null $with
     * @param array|null $order
     * @param array $columns
     * @return mixed
     */
    public function find(int $id, ?array $with = null, ?array $order = null, $columns = ['*']): ?Model
    {

        $query = $this->model->newQuery();

        $this->processQuery($query,$with,$order);

        $result = $query->find($id, $columns);

        BaseUseCase::isObject( $result , NotFoundHttpException::class , 'model not found');

        return $result;

    }

    /**
     * @param array|string[] $columns
     * @param array|null $with
     * @param array $columns
     * @return Collection
     */
    public function all($columns = ['*'], ?array $with = null): Collection
    {
        $query = $this->model->newQuery();

        $this->processQuery($query,$with);

        return $query->orderBy('id', 'DESC')->get($columns);
    }

    /**
     * @param int $perPage
     * @param array|null $conditions
     * @param array|null $with
     * @param array $columns
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator|LengthAwarePaginator
     */
    public function paginate(int $perPage = 15, ?array $conditions = null, ?array $with = null, $columns = ['*'],$order = null)
    {
        $query = $this->model->newQuery();

        $this->processQuery($query,$with);

        if (!is_null($conditions)) {
            $query = $query->where($conditions);
        }

        if ($order && is_array($order)) {
            foreach ($order as $key => $sort) {
                $query->orderBy($key, $sort);
            }
        }

        return $query->paginate($perPage, $columns);
    }

    /**
     * @param array $data
     * @return Model
     */
    public function create(array $data): Model
    {
        return $this->model->create($data);
    }


    /**
     * @param array $data
     * @return Model
     */
    public function insert(array $data): bool
    {
        return $this->model->insert($data);
    }

    /**
     * @param array $data
     * @return Model
     */
    public function upsert(array $data , array $uniqueColumns = [] , array $updatedColumns = [] ): bool
    {
        return $this->model->upsert($data,$uniqueColumns, $updatedColumns);
    }

 

    /**
     * @param array $data
     * @param array $conditions
     * @return bool
     */
    public function update(array $data, array $conditions): bool
    {
        return $this->model->where($conditions)->update($data);
    }


    /**
     * @param array $data
     * @param array $conditions
     * @return mixed
     */
    public function updateWithModel(array $data, array $conditions )
    {
        return tap($this->model->where($conditions))->update($data)->first();



    }


    /**
     * @param array $data
     * @param array $conditions
     * @return mixed
     */
    public function updateByModel(array $data,Model $model)
    {
        return tap($model)->update($data);
    }

    /**
     * @param array $conditions
     * @param array $data
     */
    public function updateOrCreate(array $conditions, array $data):Model
    {
        return $this->model->updateOrCreate($conditions, $data);
    }

    public function testCre(array $conditions, array $data)
    {
//        return $this->model->updateOrCreate($conditions, $data);

        $this->model->updateOrInsert($conditions, $data);
        return true;
    }


    /**
     * @param array $conditions
     * @return bool|null
     */
    public function destroy(array $conditions): ?bool
    {
        return $this->model->where($conditions)->delete();
    }

    /**
     * @param array $values
     * @param string $column
     * @return bool|null
     */
    public function destroyMany(array $values,$column='id'): ?bool
    {
        return $this->model->whereIn($column,$values)->delete();
    }

    /**
     * @param string $slug
     * @param array|null $with
     * @param array $columns
     * @return Model|null
     */
    public function findBySlug(string $slug, ?array $with = null, $columns = ['*']): ?Model
    {
        $query = $this->model->newQuery();

        $this->processQuery($query,$with);

        $result = $query->where('slug', $slug)->first($columns);

        BaseUseCase::isObject(Model::class , $result , NotFoundHttpException::class , 'model not found');

        return $result;
    }

    /**
     * @param array $attributes
     * @param array|null $with
     * @param array|null $order
     * @param array $columns
     * @return Model|null
     */
    public function findByAttributes(array $attributes, ?array $with = null, ?array $order = null, $columns = ['*']): ?Model
    {

        $query = $this->buildQueryByAttributes($attributes);

        $this->processQuery($query,$with,$order);

        $result = $query->first($columns);

        BaseUseCase::isObject( $result , NotFoundHttpException::class , 'model not found');

        return $result;
    }

    /**
     * Build Query to catch resources by an array of attributes and params
     * @param array $attributes
     * @param null|string $orderBy
     * @param string $sortOrder
     * @return Builder
     */
    private function buildQueryByAttributes(array $attributes, ?string $orderBy = null, string $sortOrder = 'asc')
    {
        $query = $this->model->query();

        foreach ($attributes as $field => $value) {
            $query = $query->where($field, $value);
        }

        if (null !== $orderBy) {
            $query->orderBy($orderBy, $sortOrder);
        }

        return $query;
    }

    /**
     * @param array $attributes
     * @param array|null $with
     * @param array $columns
     * @param string|null $orderBy
     * @param string $sortOrder
     * @return Collection
     */
    public function getByAttributes(array $attributes, ?array $with = null, array $columns = ['*'], ?string $orderBy = null, string $sortOrder = 'asc'): Collection
    {
        $query = $this->buildQueryByAttributes($attributes, $orderBy, $sortOrder);

        $this->processQuery($query,$with);

        return $query->get($columns);
    }

    /**
     * @param $conditions
     * @param $column
     * @return mixed
     */
    public function getValueByAttribute($conditions, $column)
    {
        return $this->model->where($conditions)->value($column);
    }

    /**
     * @param array $ids
     * @param array|null $with
     * @param array $columns
     * @return Collection
     */
    public function findByMany(array $ids, ?array $with = null, $columns = ['*']): Collection
    {
        $query = $this->model->query();

        $query->whereIn("id", $ids);

        $this->processQuery($query,$with);

        $result = $query->get($columns);

        BaseUseCase::isObject(Model::class , $result , NotFoundHttpException::class , 'model not found');

        return $result;
    }

    protected function processQuery(&$query,$with=null,$order=null){
        if ($with) {
            $query->with($with);
        }

        if (method_exists($this->model, 'locales')) {
            $query->withLocale();
        }

        if ($order && is_array($order)) {
            foreach ($order as $key => $sort) {
                $query->orderBy($key, $sort);
            }
        }
    }

    /**
     * @return bool
     */
    public function clearCache(): bool
    {
        return true;
    }


    /**
     * @
     */
    public function findByQuery($query,$data)
    {
        return $query->paginate($data['per_page']);
    }


}
