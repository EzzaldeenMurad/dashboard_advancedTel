<?php

namespace App\Services;

use App\Repositories\OperationRepository;
use App\Repositories\RepositoryInterface;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Auth;

class OperationService
{

    protected  $operationRepository;
    protected  $balanceService;
    public function __construct(OperationRepository $operationRepository, BalanceService $balanceService)
    {
        $this->operationRepository = $operationRepository;
        $this->balanceService = $balanceService;
    }

    public function getAllOperations()
    {
        return $this->operationRepository->all();
    }

    public function getOperation($id)
    {
        try {
            return $this->operationRepository->find($id);
        } catch (ModelNotFoundException $e) {
            throw new \Exception("Operation not found", 404);
        }
    }

    public function createOperation($data)
    {

        $userId = Auth::id();
        $data['user_id'] = $userId;
        if ($data['readiness'] === 'جاهز') {
            $price = $data['price'];
            if (!$this->balanceService->hasSufficientBalance($userId, $price)) {
                return 'لا يوجد لديك رصيد كافي';
            }
            $this->balanceService->deductBalance($userId, $price);
            return $this->operationRepository->update($userId, $data);
        }

        return $this->operationRepository->create($data);
    }

    public function updateOperation($id, $data)
    {

        try {
            return $this->operationRepository->update($id, $data);
        } catch (ModelNotFoundException $e) {
            throw new \Exception("Operation not found", 404);
        }
    }

    public function deleteOperation($id)
    {
        try {
            return $this->operationRepository->delete($id);
        } catch (ModelNotFoundException $e) {
            throw new \Exception("Operations not found", 404);
        }
    }
    public function deleteOperations()
    {
        try {
            // return $this->operationRepository->deleteAll();
        } catch (ModelNotFoundException $e) {
            throw new \Exception("Operations not found", 404);
        }
    }
    public function countOperations()
    {
        return $this->operationRepository->count();
    }
}
