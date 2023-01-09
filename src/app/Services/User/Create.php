<?php

namespace App\Services\User;

use App\Models\User;

class Create
{
    public function create(CreateUserObject $userObject): User
    {
        return User::create([
            'first_name' => $userObject->firstName,
            'last_name' => $userObject->lastName,
            'password' => password_hash($userObject->password, PASSWORD_BCRYPT)
        ]);
    }
}
