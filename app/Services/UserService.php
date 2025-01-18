<?php

namespace App\Services;

use App\Models\User;
use App\Repositories\UserRepositoryInterface;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserService
{

    protected  $userRepository;
    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }



    public function createUser(array $credentials): User
    {
        $credentials['password'] = Hash::make($credentials['password']);
        return $this->userRepository->create($credentials);
    }

    public function getUsers()
    {
        return $this->userRepository->all();
    }
}
