<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;

interface BaseRepository
{

    /**
     * @param int $id
     * @param array|null $with
     * @param array|null $order
     * @param array $columns
     * @return Model|null
     */
    public function find(int $id, ?array $with = null, ?array $order = null, $columns = ['*']): ?Model;


    /**
     * @param int $id
     * @param array|null $with
     * @param array|null $order
     * @return Model|null
     */
    public function findOrFail(int $id, ?array $with = null, ?array $order = null);

    /**
     * @param array|string[] $columns
     * @param array|null $with
     * @param array $columns
     * @return Collection
     */
    public function all($columns = ['*'], ?array $with = null): Collection;

    /**
     * @param int $perPage
     * @param array|null $conditions
     * @param array|null $with
     * @param array $columns
     * @param null $order
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator|LengthAwarePaginator
     */
    public function paginate(int $perPage = 15, ?array $conditions = null, ?array $with = null, $columns = ['*'], $order = null);

    /**
     * @param array $data
     * @return Model
     */
    public function create(array $data): Model;

    /**
     * @param array $data
     * @param array $conditions
     * @return bool
     */
    public function update(array $data, array $conditions): bool;

    /**
     * @param array $data
     * @param array $conditions
     * @return Model
     */
    public function updateOrCreate(array $conditions, array $data): Model;

    /**
     * @param array $conditions
     * @return bool|null
     */
    public function destroy(array $conditions): ?bool;

    /**
     * @param array $values
     * @param string $column
     * @return bool|null
     */
    public function destroyMany(array $values,$column='id'): ?bool;

    /**
     * @param string $slug
     * @param array|null $with
     * @param array $columns
     * @return Model|null
     */
    public function findBySlug(string $slug, ?array $with = null, $columns = ['*']): ?Model;

    /**
     * @param array $attributes
     * @param array|null $with
     * @param array|null $order
     * @param array $columns
     * @return Model|null
     */
    public function findByAttributes(array $attributes, ?array $with = null, ?array $order = null, $columns = ['*']): ?Model;

    /**
     * @param array $ids
     * @param array|null $with
     * @param array $columns
     * @return Collection
     */
    public function findByMany(array $ids, ?array $with = null, $columns = ['*']): Collection;

    /**
     * @param array $attributes
     * @param array|null $with
     * @param array $columns
     * @param string|null $orderBy
     * @param string $sortOrder
     * @return Collection
     */
    public function getByAttributes(array $attributes, ?array $with = null, array $columns = ['*'], ?string $orderBy = null, string $sortOrder = 'asc'): Collection;

    /**
     * @param $conditions
     * @param $column
     * @return mixed
     */
    public function getValueByAttribute($conditions, $column);

    /**
     * Clear the cache for this Repositories' Entity
     * @return bool
     */
    public function clearCache();
}
