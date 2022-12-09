<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class LoginController extends AuthController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        if (auth()->user()) {
            return Redirect::route('dashboard.index');
        }

        return Inertia::render('Auth/Login');
    }

    public function store(LoginRequest $request)
    {
        //Session
        $request->authenticate();
        $request->session()->regenerate();

        return Redirect::route('dashboard.index');
    }
}
