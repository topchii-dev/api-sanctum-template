<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\User;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Auth;
use Exception;

class AuthService
{
    public function login(array $credentials): ?User
    {
        if (!Auth::attempt($credentials)) {
            return null;
        }

        /** @var User $user */
        $user = Auth::user();
        $user->token = $this->issueToken($user);

        return $user;
    }

    public function register(array $data): User
    {
        try {
            $user = User::create($data);
            $user['token'] = $this->issueToken($user);
            return $user;

        } catch (QueryException $dbException) {
            report($dbException);
            throw new Exception('Invalid parameters');
        }
    }

    public function logout(User $user)
    {
        return $user->tokens()->delete();
    }

    public function issueToken(User $user): string
    {
        return $user->createToken(config('auth.api_token_name'))->plainTextToken;
    }
}
