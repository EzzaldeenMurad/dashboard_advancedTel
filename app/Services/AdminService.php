<?php

namespace App\Services;

use App\Models\User;
use App\Repositories\RepositoryInterface;

use Illuminate\Support\Facades\Hash;

class AdminService
{

    protected  $adminRepository;
    public function __construct(RepositoryInterface $adminRepository)
    {
        $this->adminRepository = $adminRepository;
    }



    public function createAdmin(array $credentials): User
    {
        $credentials['password'] = Hash::make($credentials['password']);
        return $this->adminRepository->create($credentials);
    }

    public function getAdmins()
    {
        return $this->adminRepository->all();
    }
}
