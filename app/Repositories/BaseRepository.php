<?php

namespace App\Repositories;

use App\Interfaces\BaseInterface;
use Illuminate\Database\Eloquent\Model;

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

    public function store(array $data)
    {
        
    }

    public function update(array $data, $id)
    {
    }

    public function delete($id)
    {
    }

    public function show($id)
    {
    }
}
