<?php

use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use App\Traits\ResponseApi;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        //
    })
    ->withExceptions(function (Exceptions $exceptions) {

        // Handle authentication exceptions
        $exceptions->report(function (AuthenticationException $e) {
            return response()->json([
                'status' => false,
                'message' => 'Unauthenticated',
            ], 401);
        });

        // Handle authorization exceptions
        $exceptions->render(function (AuthorizationException $e) {
            return response()->json([
                'status' => false,
                'message' => 'Unauthorized',
            ], 403);
        });

        // Handle Model Not Found exceptions
        $exceptions->render(function (ModelNotFoundException $e) {
            return response()->json([
                'status' => false,
                'message' => 'Resource not found',
            ], 404);
        });

        // Handle Route Not Found exceptions
        $exceptions->render(function (NotFoundHttpException $e) {
            return response()->json([
                'status' => false,
                'message' => 'not found',
            ], 404);
        });

        // Handle Validation exceptions
        $exceptions->render(function (ValidationException $e) {
            return response()->json([
                'status' => false,
                'message' => 'Validation error',
                'errors' => $e->validator->errors(),
            ], 422);
        });

        // Handle Query exceptions
        $exceptions->report(function (QueryException $e) {
            return response()->json([
                'status' => false,
                'message' => 'Database error',
                'error' => $e->getMessage(),
            ], 500);
        });

        // Handle other exceptions
        $exceptions->report(function (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Internal server error',
                'error' => $e->getMessage(),
            ], 500);
        });

    })->create();
