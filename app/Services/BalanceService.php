<?php

namespace App\Services;

use App\Http\Requests\ControlPanel\UpdateBalanceRequest;
use App\Models\User;
use App\Repositories\UserRepository;

class BalanceService
{
    protected  $userRepository;
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function hasSufficientBalance(int $userId, float $amount): bool
    {
        $user = $this->userRepository->find($userId);
        return $user && $user->balance >= $amount;
    }

    public function deductBalance(int $userId, float $amount)
    {
        try {
            $user = $this->userRepository->find($userId);
            $newBalance = $user->balance - $amount;
            return   $this->userRepository->updateBalance($newBalance, $user);
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }

    public function updateBalanceOfUser(int $userId, float $amount)
    {
        try {
            $user = $this->userRepository->find($userId);
            $newBalance = $user->balance + $amount;
            return  $this->userRepository->updateBalance($newBalance, $user);
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }
}
