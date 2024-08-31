<?php

namespace App\Http\Services\Auth;


use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserServices
{

    public function createUser(array $credentials): User
    {
        $credentials['password'] = Hash::make($credentials['password']);
        return User::create([
            'login_name' => $credentials['login_name'],
            'password' => $credentials['password'],
            'name' => $credentials['name'],
            'phone_number' => $credentials['phone_number'],
            'url_image' => $credentials['url_image'],
            'balance' => $credentials['balance'],
            'address' => $credentials['address'],
            'business' => $credentials['business'],
        ]);
    }
    public function getBalance()
    {
        $user = Auth::user();
        return $user->balance;
    }

    
}
