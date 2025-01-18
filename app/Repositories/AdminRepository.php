<?php

namespace App\Repositories;

use App\Models\User;

class AdminRepository implements RepositoryInterface
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
}
