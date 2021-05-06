<?php

namespace App\Repositories\Eloquent;

use Illuminate\Database\Eloquent\Model;
use App\Traits\ResponseApi;

abstract class AbstractRepository
{
    use ResponseApi;

    protected $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    public function selectFilter($filters)
    {
        $this->model = $this->model->selectRaw($filters);
    }

    public function selectConditions($conditions)
    {
        $expressions = \explode(';', $conditions);
        foreach ($expressions as $e) {
            $exp = \explode(':', $e);

            $this->model = $this->model->where($exp[0], $exp[1], $exp[2]);
        }
    }

    public function all()
    {
        return $this->model->all();
    }

    public function getResult()
    {
        return $this->model;
    }
}
