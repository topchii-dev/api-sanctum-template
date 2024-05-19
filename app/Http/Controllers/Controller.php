<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\Http\Response;

abstract class Controller
{
    public function successResponse(mixed $data): Response
    {
        return response(['data' => $data])
            ->setStatusCode(Response::HTTP_OK);
    }

    public function resourceCreatedResponse(mixed $data): Response
    {
        return response(['data' => $data])
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function clientErrorResponse(string $errorMessage): Response
    {
        return response(['error' => $errorMessage])
            ->setStatusCode(Response::HTTP_UNPROCESSABLE_ENTITY);
    }

    public function forbiddenResponse(string $message): Response
    {
        return response(['error' => $message])
            ->setStatusCode(Response::HTTP_FORBIDDEN);
    }
}
