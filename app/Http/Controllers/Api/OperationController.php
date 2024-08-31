<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\OperationRequst;
use App\Http\Resources\OperationResource;
use App\Models\User;

use App\Http\Services\OperationsServices;
use App\Http\Traits\ApiResponseTrait;

use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class OperationController extends Controller
{
    use ApiResponseTrait;
    public $operationsServices;
    public function __construct(OperationsServices $operationsServices)
    {
        $this->operationsServices = $operationsServices;
    }

    public function index()
    {
        try {
            // return  $this->operationsServices->getOperations();
            $response =  OperationResource::collection($this->operationsServices->getOperations());
            if ($response) {
                return $this->apiResponse($response, 'تم عرض العمليات بنجاح', Response::HTTP_OK);
            } else {
                return $this->apiResponse([], 'لا يوجد عمليات', Response::HTTP_NOT_FOUND);
            }
        } catch (\Exception $e) {
            return $this->apiResponse([], $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
    public function store(OperationRequst $createOperationValidator)
    {
        try {
            // if (!empty($createOperationValidator->getError())) {
            //     return $this->apiResponse($createOperationValidator->getError(), 'fail', Response::HTTP_NOT_ACCEPTABLE);
            // }
            // $this->authorize('create',Operation::class);
            $data = $createOperationValidator->all();
            // if ( ) {

            // }

                $data['user_id'] = Auth::user()->id;
                if ($data['readiness'] == 'جاهز') {
                    $balance =  Auth::user()->balance;
                    if ($data['price'] > $balance) {
                        return $this->apiResponse($balance, 'لا يوجد لديك رصيد كافي', Response::HTTP_NOT_FOUND);
                    }
                    $balance -= $data['price'];
                    $user = User::find(Auth::user()->id);
                    $user->update(['balance' => $balance]);
                    // Auth::user()->id;
                }
                $response = $this->operationsServices->createOperation($data);

                return $this->apiResponse($response, Response::HTTP_CREATED);


        }catch (\Exception $e) {
            return $this->apiResponse(null, $e->getMessage(), Response::HTTP_NOT_ACCEPTABLE);
        }

    }

    public function deleteAll()
    {
        $response =   $this->operationsServices->deleteOperations();
        if ($response) {
            return $this->apiResponse([], 'تم حذف العمليات بنجاح', Response::HTTP_OK);
        } else {
            return $this->apiResponse([], 'لا يوجد عمليات', Response::HTTP_NOT_FOUND);
        }
    }
    public function countOperations()
    {
        $response =   $this->operationsServices->countOperations();
        if ($response) {
            return $this->apiResponse($response, 'تم عرض  عدد العمليات بنجاح', Response::HTTP_OK);
        } else {
            return $this->apiResponse([], 'لا يوجد عمليات', Response::HTTP_NOT_FOUND);
        }
    }
}
