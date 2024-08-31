<?php

namespace App\Http\Services;

use App\Http\Resources\OperationResource;
use App\Models\Operation;
use Illuminate\Support\Facades\Auth;

class OperationsServices
{
    public function getOperations()
    {
        $user_id = Auth::id();
        return  Operation::where('user_id', $user_id)->get();
    }

    // public function getOperation(int $id)
    // {
    //     return Operation::find($id);
    // }

    public function createOperation($data)
    {
        return Operation::create($data);
    }

    public function deleteOperations()
    {
        $operations = Operation::all();

        if ($operations->count() > 0) {
            return $operations->each->delete();
        }

        return false;
    }
    public function countOperations()
    {
        $operations = Operation::all();
        return $operations->count();
    }
}
