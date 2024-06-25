<?php

use App\Http\Middleware\ApiMiddleware;
use App\Http\Middleware\JsonMiddleware;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Response;
use Laravel\Sanctum\Http\Middleware\CheckAbilities;
use Laravel\Sanctum\Http\Middleware\CheckForAnyAbility;
use Illuminate\Support\Facades\Route;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Exception\MethodNotAllowedException;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        commands: __DIR__.'/../routes/console.php',
        using: function () {
            Route::middleware('api')
                ->prefix('api')
                ->group(base_path('routes/api.php'));

            Route::middleware('api')
                ->prefix('api/user')
                ->namespace('App\\Http\\Controllers\\User')
                ->group(base_path('routes/user.php'));
     
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
            ]);

    })
    ->withExceptions(function (Exceptions $exceptions) {
        // $headers = [
        //     'Access-Control-Allow-Origin'      => '*',
        //     'Access-Control-Allow-Methods'     => 'POST, GET, OPTIONS, PUT, DELETE',
        //     'Access-Control-Allow-Credentials' => 'true',
        //     'Access-Control-Max-Age'           => '86400',
        //     'Access-Control-Allow-Headers'     => 'Content-Type, Content-Disposition, Cache-Control, Authorization, X-Requested-With, X-CSRF-TOKEN, Access-Control-Expose-Headers, X-Timezone, X-Localization, Access-Control-Request-Headers, Access-Control-Request-Method',
        // ];

        // $code = Response::HTTP_INTERNAL_SERVER_ERROR;
        
        // if ($exceptions instanceof HttpResponseException) {
        //     if (env('APP_DEBUG')) return response()->json([
        //         'message' => $exceptions->getMessage(),
        //         'file' => $exceptions->getFile(),
        //         'line' => $exceptions->getLine(),
        //         'code' => $exceptions->getCode(),
        //     ], $code, $headers);
        // } elseif ($exceptions instanceof MethodNotAllowedException) {
        //     $code = Response::HTTP_METHOD_NOT_ALLOWED;
        // } elseif ($exceptions instanceof NotFoundHttpException || $exceptions instanceof ModelNotFoundException) {
        //     $code = Response::HTTP_NOT_FOUND;
        // } elseif ($exceptions instanceof AuthorizationException) {
        //     $code = Response::HTTP_FORBIDDEN;
        // } elseif ($exceptions instanceof AuthenticationException) {
        //     $code = Response::HTTP_UNAUTHORIZED;
        // } elseif ($exceptions instanceof ValidationException) {
        //     $errorBag = [];
        //     $message  = $exceptions->getMessage();
        //     foreach ($exceptions->errors() as $key => $value) $errorBag[] = ['attribute' => $key, 'text' => $value[0]];
        //     if (!empty($errorBag)) {
        //         $message = $errorBag[0]['text'];
        //     }
        //     return response()->json([
        //         'status'  => false,
        //         'message' => $message,
        //         'data'    => (object)[],
        //         'meta'    => (object)[],
        //         'error'   => $errorBag
        //     ], Response::HTTP_OK);
        // } else {
        //     if($exceptions instanceof HttpResponseException) {
        //         if (env('APP_DEBUG')) return response()->json([
        //             'message' => $exceptions->getMessage(),
        //             'file'    => $exceptions->getFile(),
        //             'line'    => $exceptions->getLine(),
        //             'code'    => $exceptions->getCode(),
        //         ], $code, $headers);
        //     }
        // }

        // return response('', $code, $headers);

    })->create();
