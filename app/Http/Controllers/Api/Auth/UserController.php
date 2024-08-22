<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Users\CreateUserRequest;
use App\Http\Requests\Users\LoginUserRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use App\Http\Services\Auth\UserServices;
use App\Http\Traits\ApiResponseTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class UserController extends Controller
{
    use ApiResponseTrait;
    public UserServices $userService;

    public function __construct(UserServices $userService)
    {
        $this->userService = $userService;
    }

    public function register(CreateUserRequest $request)
    {
        try {
            $credentials = $request->only(
                'login_name',
                'password',
                'name',
                'phone_number',
                'business',
                'address',
                'balance',
                'url_image',
            );
            $user = $this->userService->createUser($credentials);
            $token = $user->createToken('MyApp')->plainTextToken;
            return   $this->apiResponse(['token' => $token], 'تم التسجيل بنجاح', Response::HTTP_OK);
        } catch (\Exception $e) {
            return $this->apiResponse(null, $e->getMessage(),  Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
    public function login(LoginUserRequest $request)
    {
        try {
            $credentials = $request->only('login_name', 'password');


            if (Auth::guard()->attempt(['login_name' => $credentials['login_name'], 'password' => $credentials['password']])) {

                $token = Auth::guard()->user()->createToken('user-token')->plainTextToken;
                return $this->apiResponse(['token' => $token], 'تم تسجيل الدخول بنجاح', Response::HTTP_OK);
            } else {
                return $this->apiResponse(null, 'اسم المستخدم او كلمة المرور غير صحيحة', Response::HTTP_NOT_FOUND);
            }
        } catch (\Exception $e) {
            return $this->apiResponse(null, $e->getMessage(),  Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function getBalance()
    {
        if (!Auth::check()) {
            return $this->apiResponse(null, 'Un authorised', Response::HTTP_UNAUTHORIZED);
        }

        return $this->apiResponse($this->userService->getBalance());
    }
    public function userInfo()
    {
        // $user = auth()->user();
        $response = UserResource::collection(auth()->user());
        return $this->apiResponse($response, 'تم عرض المستخدم بنجاح', Response::HTTP_OK);
    }
}
