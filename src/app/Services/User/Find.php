<?php

namespace App\Services\User;

use App\Exceptions\User\InvalidPasswordException;
use App\Exceptions\User\UserNotFoundException;
use App\Models\User;

class Find
{
    public function get(string $username, string $password): User
    {
        $user = User::where('username', $username)->first();
        if (!$user) {
            throw new UserNotFoundException();
        }

        if (password_verify($password, $user->password)) {
            return $user;
        }

        throw new InvalidPasswordException();
    }
}
