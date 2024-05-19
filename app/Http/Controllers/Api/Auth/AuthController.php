<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Http\Resources\UserResource;
use App\Services\AuthService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Response;
use Throwable;

class AuthController extends Controller
{
    public function __construct(
        private readonly AuthService $authService
    )
    {
    }

    public function login(LoginRequest $request): Response
    {
        try {
            $user = $this->authService->login($request->validated());
            return $this->successResponse(new UserResource($user));

        } catch (Throwable $er) {
            return $this->clientErrorResponse($er->getMessage());
        }

    }

    public function register(RegisterRequest $request): Response
    {
        try {
            $user = $this->authService->register($request->validated());
            return $this->resourceCreatedResponse(new UserResource($user));

        } catch (Throwable $er) {
            return $this->clientErrorResponse($er->getMessage());
        }
    }

    public function logout(): Response
    {
        try {
            $result = $this->authService->logout(Auth::user());
            return $this->successResponse($result);

        } catch (Throwable $er) {
            return $this->clientErrorResponse($er->getMessage());
        }
    }
}
