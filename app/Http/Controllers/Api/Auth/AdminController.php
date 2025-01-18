<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admins\CreateAdminRequest;
use App\Http\Requests\Admins\LoginAdminRequest;
use App\Http\Traits\ApiResponseTrait;
use App\Services\AdminService;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AdminController extends Controller
{
    use ApiResponseTrait;
    public  $adminService;

    public function __construct(AdminService $adminService)
    {
        $this->adminService = $adminService;
    }

    public function register(CreateAdminRequest $request)
    {
        try {
            $credentials = $request->only(
                'name',
                'phone_number',
                'login_name',
                'password',
                'url_image',
                'balance',
                'role',
                'status',
            );
            $user = $this->adminService->createAdmin($credentials);
            $token = $user->createToken('MyApp')->plainTextToken;
            return   $this->apiResponse(['token' => $token], 'تم التسجيل بنجاح', Response::HTTP_OK);
        } catch (\Exception $e) {
            return $this->apiResponse(null, $e->getMessage(),  Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
    public function login(LoginAdminRequest $request)
    {
        try {
            $credentials = $request->only('login_name', 'password');
            config(['auth.guards.api.provider' => 'admin']);
            // dd( $credentials['login_name']);
            if (Auth::guard('admin')->attempt(['login_name' =>  $credentials['login_name'], 'password' =>  $credentials['password']])) {
                $token = Auth::guard('admin')->user()->createToken('admin-token')->plainTextToken;
                return $this->apiResponse(['token' => $token], 'تم تسجيل الدخول بنجاح', Response::HTTP_OK);
            } else {
                return $this->apiResponse(null, 'اسم المستخدم او كلمة المرور غير صحيحة', Response::HTTP_NOT_FOUND);
            }
        } catch (\Exception  $e) {
            return $this->apiResponse(null, $e->getMessage(),  Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

}
