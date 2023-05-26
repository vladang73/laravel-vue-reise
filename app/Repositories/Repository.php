<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Container\Container as App;

/**
 * Class Repository
 * @package App\Repositories
 */
abstract class Repository
{
    /**
     * @var App
     */
    private $app;

    /**
     * @var Model
     */
    public $model;


    /**
     * Repository constructor.
     * @param App $app
     * @throws \Exception
     */
    public function __construct(
        App $app
    )
    {
        $this->app = $app;
        $this->makeModel();
    }

    /**
     * @return mixed
     */
    abstract function model();

    /**
     * @return mixed
     * @throws \Exception
     */
    public function makeModel()
    {
        $model = $this->app->make($this->model());

        if (!$model instanceof Model)
            throw new \Exception("Class {$this->model()} must be an instance of Illuminate\\Database\\Eloquent\\Model");

        return $this->model = new $model;
    }

    /**
     * @param array $columns
     * @return mixed
     */
    public function all($columns = array('*'))
    {
        return $this->model->get($columns);
    }

    /**
     * @param int $perPage
     * @param array $columns
     * @return mixed
     */
    public function paginate($perPage = 15, $columns = array('*'))
    {
        return $this->model->paginate($perPage, $columns);
    }

    /**
     * @param array $data
     * @return mixed
     */
    public function create(array $data)
    {
        return $this->model->create($data);
    }

    /**
     * @param array $data
     * @param $id
     * @param string $attribute
     * @return mixed
     */
    public function update(array $data, $id, $attribute = "id")
    {
        return $this->model->where($attribute, '=', $id)->first()->update($data);
    }

    /**
     * @param $id
     * @return mixed
     */
    public function delete($id)
    {
        return $this->model->destroy($id);
    }

    /**
     * @param $id
     * @param array $columns
     * @return mixed
     */
    public function find($id, $columns = array('*'))
    {
        return $this->model->findOrFail($id, $columns);
    }

    /**
     * @param $attribute
     * @param $value
     * @param array $columns
     * @return mixed
     */
    public function findBy($attribute, $value, $columns = array('*'))
    {
        return $this->model->where($attribute, '=', $value)->first($columns);
    }

    /**
     * @param $attribute
     * @param $conclusion
     * @param $value
     * @return mixed
     */
    public function where($attribute, $conclusion, $value)
    {
        return $this->model->where($attribute, $conclusion, $value);
    }

    /**
     * @param $attribute
     * @param $value
     * @return mixed
     */
    public function whereLike($attribute, $value)
    {
        return $this->model->where($attribute, 'LIKE', $value);
    }

    /**
     * @param $attribute
     * @param $value
     * @return mixed
     */
    public function whereILike($attribute, $value)
    {
        return $this->model->where($attribute, 'ILIKE', $value);
    }

    /**
     * @param array $columns
     * @return mixed
     */
    public function get($columns = array('*'))
    {
        return $this->model->get($columns);
    }

    /**
     * @return mixed
     */
    public function first()
    {
        return $this->model()->first();
    }

    /**
     * @param array $relations
     * @return mixed
     */
    public function with($relations = [])
    {
        return $this->model->with($relations);
    }


    /**
     * @param string $field
     * @param string $type
     * @return mixed
     */
    public function orderBy($field, $type = 'ASC')
    {
        return $this->model->orderBy($field, $type);
    }
}