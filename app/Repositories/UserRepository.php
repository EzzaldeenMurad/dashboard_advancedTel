<?php

namespace App\Repositories;

use App\Models\User;
use PhpParser\Node\Expr\Cast\Double;

class UserRepository implements UserRepositoryInterface
{
    public function all()
    {
        return User::all();
    }
    public function find($id)
    {
        return User::findOrFail($id);
    }
    public function create(array $credentials)
    {
        return User::create($credentials);
    }
    public function update($id, array $data)
    {
        $user = User::findOrFail($id);
        $user->update($data);
        return $user;
    }
    public function delete($id)
    {
        return User::destroy($id);
    }
    public function updateBalance(float $newBalance, $user)
    {
        $user->balance = $newBalance;
        $user->save();
        return $user;
    }
}
