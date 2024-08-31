<?php

namespace App\Http\Services;

use App\Models\Admin;
use App\Models\User;

class ControlPanelServices
{

    public function getUsers()
    {
        return User::all();
    }
    public function getAdmins()
    {
        return  Admin::all();
    }

    public function updateBalanceOfUser($newBalance, $user)
    {
        // optional($user)->update([
        //     'balance' => $requestBalance
        // ]);
        $user->update([
            'balance' => $newBalance
        ]);
        $user->save();
        return $user;
    }

}
