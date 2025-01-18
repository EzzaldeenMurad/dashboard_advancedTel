<?php

namespace App\Repositories;

use PhpParser\Node\Expr\Cast\Double;

interface UserRepositoryInterface
{
    public function all();
    public function find($id);
    public function create(array $data);
    public function update($id, array $data);
    public function delete($id);
    public function updateBalance(float $newBalance,$user);
}
