<?php

namespace App\Exceptions;

use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\Routing\Exception\RouteNotFoundException;
use Illuminate\Auth\AuthenticationException;
use Throwable;

class Handler extends ExceptionHandler
{
    use \App\Traits\ResponseMessage;

    /**
     * The list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     */
    public function register(): void
    {
        $this->reportable(function (Throwable $e) {
            //
        });

        $this->renderable(fn(MethodNotAllowedHttpException $exception) => $this->failsMessage($exception->getMessage()));

        $this->renderable(fn(RouteNotFoundException $exception) => $this->failsMessage($exception->getMessage()));
    }

    public function render($request, Throwable $exception)
    {
        if ($request->expectsJson()) {
            return $this->failsMessage(__('auth.token_invalid'));
        }

        return parent::render($request, $exception);
    }
}
