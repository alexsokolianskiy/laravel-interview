<?php

namespace App\Http\Controllers\Auth;

use App\Exceptions\User\InvalidPasswordException;
use App\Exceptions\User\UserNotFoundException;
use App\Services\User\Find;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Contracts\Support\Renderable;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    */

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function index(): Renderable
    {
        return view('auth/login');
    }

    public function login(Find $find, LoginRequest $request): RedirectResponse
    {
        try {
            $user = $find->get($request->get('username'), $request->get('password'));
        } catch (UserNotFoundException) {
            return Redirect::back()
                ->withInput($request->input())
                ->withErrors(['username' => 'User was not found']);
        } catch (InvalidPasswordException $e) {
            return Redirect::back()
                ->withInput($request->input())
                ->withErrors(['password' => 'Incorrect password']);
        }
        Auth::login($user);

        return redirect('home');
    }

    public function logout(): RedirectResponse
    {
        Auth::logout();

        return redirect('login');
    }
}
