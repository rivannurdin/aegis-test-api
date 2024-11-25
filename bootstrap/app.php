<?php

use App\Http\Middleware\AccessRole;
use App\Http\Middleware\ApiMiddleware;
use App\Http\Middleware\JsonMiddleware;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Laravel\Sanctum\Http\Middleware\CheckAbilities;
use Laravel\Sanctum\Http\Middleware\CheckForAnyAbility;
use Illuminate\Support\Facades\Route;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Exception\MethodNotAllowedException;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        commands: __DIR__.'/../routes/console.php',
        using: function () {
            Route::middleware('api')
                ->prefix('api')
                ->namespace('App\\Http\\Controllers')
                ->group(base_path('routes/api.php'));
            Route::middleware('web')
                ->group(base_path('routes/web.php'));
        },
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware
            ->use([
                \Illuminate\Http\Middleware\TrustProxies::class,
                \Illuminate\Http\Middleware\HandleCors::class,
                \Illuminate\Foundation\Http\Middleware\PreventRequestsDuringMaintenance::class,
                \Illuminate\Http\Middleware\ValidatePostSize::class,
                \Illuminate\Foundation\Http\Middleware\TrimStrings::class,
                \Illuminate\Foundation\Http\Middleware\ConvertEmptyStringsToNull::class,
                ApiMiddleware::class
            ])
            ->statefulApi()
            ->alias([
                'abilities' => CheckAbilities::class,
                'ability' => CheckForAnyAbility::class,
                'role' => AccessRole::class
            ]);

    })
    ->withExceptions(function (Exceptions $exceptions) {
        $exceptions->render(function (Throwable $e, Request $request) {
            if ($e instanceof AuthenticationException) {
                return response()->json(['message' => 'Authentication failed'], Response::HTTP_UNAUTHORIZED);
            } elseif ($e instanceof AccessDeniedHttpException) {
                return response()->json(['message' => 'Access denied'], Response::HTTP_FORBIDDEN);
            } elseif ($e instanceof ModelNotFoundException) {
                return response()->json(['message' => 'Resource not found'], Response::HTTP_NOT_FOUND);
            } elseif ($e instanceof MethodNotAllowedException) {
                return response()->json(['message' => 'Method not allowed'], Response::HTTP_METHOD_NOT_ALLOWED);
            } elseif ($e instanceof NotFoundHttpException) {
                return response()->json(['message' => 'Resource not found'], Response::HTTP_NOT_FOUND);
            } else {
                return response()->json(['message' => 'An error occurred'], Response::HTTP_INTERNAL_SERVER_ERROR);
            }
        });
    })->create();
