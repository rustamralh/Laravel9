<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Repositories\UserRepository;
use App\Services\AuthService;
use App\Services\UserService;

class AuthController extends Controller
{
    public AuthService $authService;

    public UserService $userService;

    public function __construct()
    {
        $this->authService    = new AuthService();
        $this->userRepository = new UserService();
    }
}
