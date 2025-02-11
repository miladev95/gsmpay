<?php

namespace App\Exceptions;

use App\Helpers\ResponseHelper;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of exception types with their custom log levels.
     *
     * @var array<class-string<\Throwable>, \Psr\Log\LogLevel::*>
     */
    protected $levels = [];

    /**
     * A list of the exception types that should not be reported.
     *
     * @var array<int, class-string<\Throwable>>
     */
    protected $dontReport = [];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = ['password', 'password_confirmation'];

    /**
     * Report or log an exception.
     */
    public function report(Throwable $exception): void
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     */
    public function render($request, Throwable $exception)
    {
        dd("here");
        // Handle Validation Errors
        if ($exception instanceof ValidationException) {
            return ResponseHelper::error($exception->errors(), 422);
        }

        // Handle Authentication Errors
        if ($exception instanceof AuthenticationException) {
            return ResponseHelper::error('Unauthenticated', 401);
        }

        // Handle Not Found Errors
        if ($exception instanceof NotFoundHttpException) {
            return ResponseHelper::error('Resource not found', 404);
        }

        // Handle All Other Errors
        return ResponseHelper::error($exception->getMessage(), 500);
    }
}
