<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\RedirectResponse;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\Auth\RegisterRequest;
use App\Services\User\Create;
use App\Services\User\CreateUserObject;
use Illuminate\Contracts\Support\Renderable;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function index(): Renderable
    {
        return view('auth/register');
    }

    public function register(RegisterRequest $request, Create $createService): RedirectResponse
    {
        $createUserObject = new CreateUserObject();
        $createUserObject->firstName = $request->get('first_name');
        $createUserObject->lastName = $request->get('last_name');
        $createUserObject->password = $request->get('password');
        $user = $createService->create($createUserObject);

        return redirect('/login')->with(
            'success',
            sprintf('User with username: %s was created!', $user->username)
        );
    }
}
