<?php

namespace App\Interfaces;

use Illuminate\Http\Request;

interface BaseInterface
{
    public function all();

    // public function store(Request $request);
    public function create($data);

    public function update($data, $id);

    public function delete($id);

    public function find($id);
}
