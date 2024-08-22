<?php

namespace App\Http\Services\Auth;

use App\Models\Admin;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Response;

class AdminServices
{

    public function createAdmin(array $credentials): Admin
    {
        $credentials['password'] = Hash::make($credentials['password']);
        return Admin::create([
            'name' => $credentials['name'],
            'login_name' => $credentials['login_name'],
            'password' => $credentials['password'],
            'phone_number' => $credentials['phone_number'],
            'url_image' => $credentials['url_image'],
            'balance' => $credentials['balance'],
            'role' => $credentials['role'],
            'status' => $credentials['status'],
        ]);
    }
    public function getBalance()
    {
        $user = Auth::user();
        return $user->balance;
    }
   
}

