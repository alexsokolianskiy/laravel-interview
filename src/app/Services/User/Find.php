<?php

namespace App\Services\User;

use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use App\Exceptions\User\UserNotFoundException;
use App\Exceptions\User\InvalidPasswordException;

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

    public function all(array $filters = []): Collection
    {
        $user = User::query();
        foreach ($filters as $key => $value) {
            if ($value) {
                $user->where($key, 'like', $value . '%');
            }
        }

        return $user->get();
    }
}
