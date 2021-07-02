<?php

namespace App\Repositories;

use App\Interfaces\BaseInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class BaseRepository implements BaseInterface
{

    protected $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    public function all()
    {
        return $this->model->all();
    }

    public function create($data)
    {
        $model = $this->model->create($data);
        return $model;
    }

    public function update($data, $id)
    {
        $model = $this->model->findOrFail($id);
        $model->fill($data)->save();
        return $model;
    }

    public function delete($id)
    {
        $model = $this->model->findOrFail($id);
        return $model->delete();
    }

    public function find($id)
    {
        $model = $this->model->findOrFail($id);
        return $model;
    }
}
