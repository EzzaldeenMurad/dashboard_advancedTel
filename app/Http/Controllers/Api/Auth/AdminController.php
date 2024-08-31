<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admins\CreateAdminRequest;
use App\Http\Requests\Admins\LoginAdminRequest;
use App\Http\Services\Auth\AdminServices;
use App\Http\Traits\ApiResponseTrait;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AdminController extends Controller
{
    use ApiResponseTrait;
    public AdminServices $adminService;

    public function __construct(AdminServices $adminService)
    {
        $this->adminService = $adminService;
    }

    // public function admin()
    // {
    //     $admin = Auth::guard('admin')->user();
    //     $response = AdminResource::collection(User::where('id', $admin->id)->get());
    //     return $this->apiResponse($response, 'تم عرض  المشرف   بنجاح', Response::HTTP_OK);
    // }

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

    public function getBalance()
    {
        if (!Auth::check()) {
            return $this->apiResponse(null, 'Un authorised', Response::HTTP_UNAUTHORIZED);
        }
        return $this->apiResponse($this->adminService->getBalance());
    }

    public function adminInfo()
    {
        $admin = auth()->user();
        return $this->apiResponse($admin, 'تم عرض المشرف بنجاح', Response::HTTP_OK);
    }
}
