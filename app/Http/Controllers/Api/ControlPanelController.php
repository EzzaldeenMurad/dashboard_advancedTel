<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ControlPanel\UpdateBalanceRequest;
use App\Http\Services\ControlPanelServices;
use App\Http\Traits\ApiResponseTrait;
use App\Models\Admin;
use App\Models\User;
use App\Services\AdminService;
use App\Services\BalanceService;
use App\Services\UserService;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ControlPanelController extends Controller
{
    use ApiResponseTrait;
    protected  $userService;
    protected  $adminService;
    protected  $balanceService;

    public function __construct(UserService $userService, AdminService $adminService, BalanceService $balanceService)
    {
        $this->userService = $userService;
        $this->adminService = $adminService;
        $this->balanceService = $balanceService;
    }
    public function getUsers()
    {
        try {
            $users = $this->userService->getUsers();
        } catch (\Exception $e) {
            return $this->apiResponse(null, $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
    public function getAdmins()
    {
        try {
            $admins = $this->adminService->getAdmins();
        } catch (\Exception $e) {
            return $this->apiResponse(null, $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function updateBalanceOfUser(UpdateBalanceRequest $request)
    {
        try {
            $data = $request->only('user_id', 'balance');
            $user = $this->balanceService->updateBalanceOfUser($data['user_id'], $data['balance']);
            return $this->apiResponse($user, 'تم تحديث الرصيد بنجاح', Response::HTTP_OK);
        } catch (\Exception $e) {
            return $this->apiResponse(null, $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        } catch (\Exception $e) {
            return $this->apiResponse(null, $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
