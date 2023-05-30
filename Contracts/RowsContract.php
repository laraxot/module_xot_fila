<?php

declare(strict_types=1);

namespace Modules\Xot\Contracts;

/**
 * Modules\Xot\Contracts\RowsContract.
 */
interface RowsContract
{
    /**
     * Paginate the given query.
     *
     * @param int|null $perPage
     * @param array    $columns
     * @param string   $pageName
     * @param int|null $page
     *
     * @throws \InvalidArgumentException
     *
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function paginate($perPage = null, $columns = ['*'], $pageName = 'page', $page = null);

    /**
     * Add a relationship count / exists condition to the query with where clauses.
     *
     * @param string $relation
     * @param string $operator
     * @param int    $count
     *
     * @return \Illuminate\Database\Eloquent\Builder|static
     */
    public function whereHas($relation, \Closure $callback = null, $operator = '>=', $count = 1);

    /**
     * Add a basic where clause to the query.
     *
     * @param \Closure|string|array|\Illuminate\Database\Query\Expression $column
     * @param string                                                      $boolean
     *
     * @return $this
     */
    public function where($column, $operator = null, $value = null, $boolean = 'and');

    /**
     * Get the related model of the relation.
     *
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function getRelated();

    /**
     * Add a "where null" clause to the query.
     *
     * @param string|array $columns
     * @param string       $boolean
     * @param bool         $not
     *
     * @return $this
     */
    public function whereNull($columns, $boolean = 'and', $not = false);

    /**
     * Add an "order by" clause to the query.
     *
     * @param \Closure|\Illuminate\Database\Query\Builder|\Illuminate\Database\Query\Expression|string $column
     * @param string                                                                                   $direction
     *
     * @throws \InvalidArgumentException
     *
     * @return $this
     */
    public function orderBy($column, $direction = 'asc');

    /**
     * Set the relationships that should be eager loaded.
     *
     * @param string|array         $relations
     * @param string|\Closure|null $callback
     *
     * @return $this
     */
    public function with($relations, $callback = null);

    /**
     * Detach models from the relationship.
     *
     * @param bool $touch
     *
     * @return int
     */
    public function detach($ids = null, $touch = true);

    /**
     * Attach a model to the parent.
     *
     * @param bool $touch
     *
     * @return void
     */
    public function attach($id, array $attributes = [], $touch = true);

    /**
     * Get the results of the search.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function get();

    /**
     * Get the first result from the search.
     *
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function first();

    /**
     * Get the model instance being queried.
     *  il return era con |static.
     *
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function getModel();

    /**
     * Get the primary key for the model.
     *
     * @return string
     */
    public function getKeyName();

    /**
     * Count the number of items in the collection.
     *
     * @return int
     */
    // [\ReturnTypeWillChange]
    public function count();

    /**
     * Set the "offset" value of the query.
     *
     * @param int $value
     *
     * @return $this
     */
    public function offset($value);

    /**
     * Set the "limit" value of the query.
     *
     * @param int $value
     *
     * @return $this
     */
    public function limit($value);

    /**
     * Convert the model instance to an array.
     *
     * @return array
     */
    public function toArray();

    /**
     * Add a "where in" clause to the query.
     *
     * @param string $column
     * @param string $boolean
     * @param bool   $not
     *
     * @return $this
     */
    public function whereIn($column, $values, $boolean = 'and', $not = false);
}
