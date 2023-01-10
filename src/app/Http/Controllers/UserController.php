<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Services\User\Find;
use App\Http\Requests\User\Filter;
use App\Jobs\User\Remove;

class UserController extends Controller
{
    public function getUsers(Find $find, Filter $filter)
    {
        $users = $find->all($filter->all());

        return response()->json($users);
    }

    public function remove(User $user)
    {
        Remove::dispatch($user);

        return response()->json([
            'status' => true
        ]);
    }
}
