<?php

namespace App\Repositories;

use App\Models\Offer;
use App\Models\Operation;

class OperationRepository implements RepositoryInterface
{
    public function all()
    {
        return Operation::all();
    }
    public function find($id)
    {
        return Operation::findOrFail($id);
    }
    public function create(array $data)
    {
        return  Operation::create($data);
    }
    public function update($id, array $data)
    {
        $operation = Operation::findOrFail($id);
        $operation->update($data);
        return $operation;
    }
    public function delete($id)
    {
        return Operation::destroy($id);
    }
    public function count()
    {
        $operations = $this->all();
        return $operations->count();
    }
}
