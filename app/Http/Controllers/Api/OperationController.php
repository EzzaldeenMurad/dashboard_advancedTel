<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\OperationRequst;
use App\Http\Resources\OperationResource;
use App\Models\User;
use App\Http\Traits\ApiResponseTrait;
use App\Services\OperationService;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class OperationController extends Controller
{
    use ApiResponseTrait;
    public $operationService;
    public function __construct(OperationService $operationServices)
    {
        $this->operationService = $operationServices;
    }

    public function index()
    {
        try {
            $offers = OperationResource::collection($this->operationService->getAllOperations());
            return $this->apiResponse($offers, 'تم عرض العمليات بنجاح', Response::HTTP_OK);
        } catch (\Exception $e) {
            return $this->apiResponse(null, $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
    public function store(OperationRequst $createOperationRequest)
    {

        try {
            $validatedData = $createOperationRequest->validated();

            $operation = $this->operationService->createOperation($validatedData);
            return $this->apiResponse($operation, 'تم إنشاء العملية بنجاح', Response::HTTP_CREATED);
        } catch (\Exception $e) {
            return $this->apiResponse(null, 'حدث خطأ أثناء تنفيذ العملية', Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    // public function deleteAll()
    // {
    //     $response =   $this->operationService->deleteOperations();
    //     if ($response) {
    //         return $this->apiResponse([], 'تم حذف العمليات بنجاح', Response::HTTP_OK);
    //     } else {
    //         return $this->apiResponse([], 'لا يوجد عمليات', Response::HTTP_NOT_FOUND);
    //     }
    // }
    public function countOperations()
    {
        // $response =   $this->operationServices->countOperations();
        // if ($response) {
        //     return $this->apiResponse($response, 'تم عرض  عدد العمليات بنجاح', Response::HTTP_OK);
        // } else {
        //     return $this->apiResponse([], 'لا يوجد عمليات', Response::HTTP_NOT_FOUND);
        // }
    }
}
