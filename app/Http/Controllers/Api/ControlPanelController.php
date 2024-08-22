<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ControlPanel\UpdateBalanceRequest;
use App\Http\Services\ControlPanelServices;
use App\Http\Traits\ApiResponseTrait;
use App\Models\User;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ControlPanelController extends Controller
{
    use ApiResponseTrait;
    private ControlPanelServices $controlPanelServices;

    public function __construct(ControlPanelServices $controlPanelServices)
    {
        $this->controlPanelServices = $controlPanelServices;
    }

    public function getUsers()
    {
        try {
            $users = $this->controlPanelServices->getUsers();
            if ($users) {
                return $this->apiResponse($users, 'تم عرض المستخدمين بنجاح', Response::HTTP_OK);
            }
            return $this->apiResponse(null, 'لا يوجد مستخدمين', Response::HTTP_NOT_FOUND);
        } catch (\Exception $e) {
            return $this->apiResponse(null, $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
    public function getAdmins()
    {
        try {
            $admins = $this->controlPanelServices->getAdmins();
            if ($admins) {
                return $this->apiResponse($admins, 'تم عرض المشرفين بنجاح', Response::HTTP_OK);
            }
            return $this->apiResponse(null, 'لا يوجد مشرفين', Response::HTTP_NOT_FOUND);
        } catch (\Exception $e) {
            return $this->apiResponse(null, $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function updateBalanceOfUser(UpdateBalanceRequest $request)
    {
        try {
            $user = User::findorFail($request->user_id);
            $newBalance = $user->balance + $request->balance;

            $response =  $this->controlPanelServices->updateBalanceOfUser($newBalance, $user);
            if ($response) {
                return $this->apiResponse($response, 'تم اضافة مبلغ الرصيد بنجاح', Response::HTTP_OK);
            }
            return $this->apiResponse(null, 'فشل ', Response::HTTP_NOT_FOUND);
        } catch (\Exception $e) {
            return $this->apiResponse(null, $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
