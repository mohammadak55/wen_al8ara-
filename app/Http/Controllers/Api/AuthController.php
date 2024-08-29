<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRquest;
use App\Http\Requests\Sign_inRequest;
use App\Services\AuthService;


class AuthController extends Controller
{
    protected $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }
    public function createUser(RegisterRquest $request)
    {
        $result = $this->authService->Register($request);
        return $result;
    }

    public function loginUser(Sign_inRequest $request)
    {
        $result = $this->authService->SignIn($request);
        return $result;
    }
}
