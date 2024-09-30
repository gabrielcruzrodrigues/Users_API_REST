<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;
use Illuminate\Http\JsonResponse;

class Handler extends ExceptionHandler
{
     public function render($request, Throwable $exception) : JsonResponse
     {
          if ($exception instanceof UserNotFound) {
               return response()->json([
                    'success' => false,
                    'message' => 'User not found'
               ], 404);
          }

          if ($exception instanceof UserAlreadyExistsException) {
               return response()->json([
                    'success' => false,
                    'message' => 'User already exists'
               ], 409);
          }
     }
}