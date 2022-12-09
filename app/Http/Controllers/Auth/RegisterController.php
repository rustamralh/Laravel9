<?php

namespace App\Http\Controllers\Auth;

use App\Http\Requests\Auth\RegisterRequest;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class RegisterController extends AuthController
{
    /**
     * Display register page.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Inertia::render('Auth/Register');
    }

    /**
     * Handle account registration request
     *
     * @param RegisterRequest $request
     *
     * @return \Illuminate\Http\Response
     */
    public function register(RegisterRequest $request)
    {
        //Create user
        $userDetails             = $request->validated();
        $userDetails['password'] = Hash::make($request->password);
        $user                    = $this->userService->create($userDetails);

        //Login user
        $this->authService->loginUser($user);

        //Registered event
        event(new Registered($user));

        //Redirect to login
        return Redirect::route('dashboard.index')->with('success', 'Account successfully registered.');
    }
}
