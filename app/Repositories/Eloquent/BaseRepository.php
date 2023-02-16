<?php

namespace App\Repositories\Eloquent;

use App\Repositories\Contracts\BaseRepositoryInterface;

class BaseRepository implements BaseRepositoryInterface
{
    /**
     * Model for the repository.
     */
    protected $model;


    /**
     * Construct the repository.
     *
     * @param Model $model
     */
    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    /**
     * Gets the query builder for the repository.
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function getBuilder()
    {
        return $this->model->newQuery();
    }

    /**
     * Lists the given fields.
     *
     * @param string $label
     * @param string $key
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function list($label = 'name', $key = 'id')
    {
        return $this->model->pluck($label, $key);
    }

    /**
     * Get the filtered content.
     *
     * @param integer $perPage
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function filter($perPage = 30)
    {
        return $this->model->paginate($perPage);
    }

    /**
     * Gets the first item.
     *
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function first()
    {
        return $this->model->first();
    }

    /**
     * Gets the total count.
     *
     * @return int
     */
    public function count()
    {
        return $this->model->count();
    }

    /**
     * Gets the total sum.
     *
     * @return int
     */
    public function sum($field)
    {
        return $this->model->sum($field);
    }

    /**
     * Find item by id.
     *
     * @param int $id
     * @param array $with
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function find($id, $with = [])
    {
        return $this->model->with($with)->find($id);
    }

    /**
     * Find item by field.
     *
     * @param mixed $field
     * @param mixed $value
     * @param array $with
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function findBy($field, $value, $with = [])
    {
        return $this->model->with($with)->where($field, $value)->first();
    }

    /**
     * Find items by field.
     *
     * @param mixed $field
     * @param mixed $value
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function findAllBy($field, $value, $with = [])
    {
        if ( is_array($value) )
            return $this->model->with($with)->whereIn($field, $value)->get();

        return $this->model->with($with)->where($field, $value)->get();
    }

    /**
     * Find all items.
     *
     * @param mixed $perPage
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function get($perPage = null)
    {
        if ( $perPage )
            return $this->model->paginate($perPage);

        return $this->model->get();
    }

    /**
     * Create the item.
     *
     * @param array $data
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function create($data)
    {
        return $this->model->create($data);
    }

    /**
     * Update the model.
     *
     * @param \Illuminate\Database\Eloquent\Model $model
     * @param array $data
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function update($model, $data)
    {
        $model->update($data);

        return $model;
    }

    /**
     * Update the model by id.
     *
     * @param int $id
     * @return boolean
     */
    public function updateById($id, $data)
    {
        $model = $this->find($id);

        return $this->update($model, $data);
    }

    /**
     * Delete the model by id.
     *
     * @param int $id
     * @return boolean
     */
    public function deleteById($id)
    {
        return $this->find($id)->delete();
    }

    /**
     * Create or update a related record matching the attributes, and fill it with values.
     *
     * @param  array  $attributes
     * @param  array  $values
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function updateOrCreate(array $attributes, array $values = [])
    {
        return $this->model->updateOrCreate($attributes, $values);
    }

    /**
     * Find or create by the key.
     *
     * @param array $data
     * @param string $key
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function findOrNewByKey($data, $key = 'code')
    {
        // If already exists in the database lets return that.
        if ( $model = $this->model->where($key, $data[$key])->first() ) {
            return $model->fill($data);
        }

        // Else create a new model.
        return $this->model->newInstance($data);
    }

    /**
     * Find or create by the key.
     *
     * @param array $data
     * @param string $key
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function findOrCreateByKey($data, $key = 'code')
    {
        // If already exists in the database lets return that.
        if ( $model = $this->model->where($key, $data[$key])->first() ) {
            return $model;
        }

        // Else create a new model.
        return $this->create($data);
    }

    /**
     * Get the first record matching the attributes or instantiate it.
     *
     * @param  array  $attributes
     * @param  array  $values
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function firstOrNew(array $attributes = [], array $values = [])
    {
        return $this->model->firstOrNew($attributes, $values);
    }
}
