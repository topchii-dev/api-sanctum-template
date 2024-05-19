<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Response;

class UserController extends Controller
{
    public function me()
    {
        return $this->successResponse(new UserResource(Auth::user()));
    }
}
