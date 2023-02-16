<?php

namespace App\Repositories\Contracts;

interface BaseRepositoryInterface
{
    /**
     * Gets the query builder for the repository.
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function getBuilder();

    /**
     * Find item by id.
     *
     * @param int $id
     * @param array $with
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function find($id, $with = []);

    /**
     * Lists the given fields.
     *
     * @param string $label
     * @param string $key
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function list($label = 'name', $key = 'id');

    /**
     * Get the filtered content.
     *
     * @param integer $perPage
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function filter($perPage = 30);

    /**
     * Gets the total count.
     *
     * @return int
     */
    public function count();

    /**
     * Gets the total sum.
     *
     * @return int
     */
    public function sum($field);

    /**
     * Find item by field.
     *
     * @param mixed $field
     * @param mixed $value
     * @param array $with
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function findBy($field, $value, $with = []);

    /**
     * Find items by field.
     *
     * @param mixed $field
     * @param mixed $value
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function findAllBy($field, $value);

    /**
     * Find all items.
     *
     * @param mixed $perPage
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function get($perPage = null);

    /**
     * Create the item.
     *
     * @param array $data
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function create($data);

    /**
     * Update the model.
     *
     * @param \Illuminate\Database\Eloquent\Model $model
     * @param array $data
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function update($model, $data);

    /**
     * Update the model by id.
     *
     * @param int $id
     * @return boolean
     */
    public function updateById($id, $data);

    /**
     * Delete the model by id.
     *
     * @param int $id
     * @return boolean
     */
    public function deleteById($id);

    /**
     * Create or update a related record matching the attributes, and fill it with values.
     *
     * @param  array  $attributes
     * @param  array  $values
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function updateOrCreate(array $attributes, array $values = []);

    /**
     * Find or create by the key.
     *
     * @param array $data
     * @param string $key
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function findOrNewByKey($data, $key = 'code');

    /**
     * Find or create by the key.
     *
     * @param array $data
     * @param string $key
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function findOrCreateByKey($data, $key = 'code');

    /**
     * Get the first record matching the attributes or instantiate it.
     *
     * @param  array  $attributes
     * @param  array  $values
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function firstOrNew(array $attributes = [], array $values = []);
}
