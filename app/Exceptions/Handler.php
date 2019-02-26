<?php

namespace App\Exceptions;

use Auth;
use Exception;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Sentry\State\Scope;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that should not be reported.
     *
     * @var array
     */
    protected $dontReport = [
        \Illuminate\Auth\AuthenticationException::class,
        \Illuminate\Auth\Access\AuthorizationException::class,
        \Symfony\Component\HttpKernel\Exception\HttpException::class,
        \Illuminate\Database\Eloquent\ModelNotFoundException::class,
        \Illuminate\Session\TokenMismatchException::class,
        \Illuminate\Validation\ValidationException::class,
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    /**
     * Report or log an exception.
     *
     * @param  \Exception $exception
     * @return void
     * @throws Exception
     */
    public function report(Exception $exception)
    {
        if ( $this->shouldReport($exception) && app()->bound('sentry') ) {
            try {
                $this->sentry($exception);
            } catch (Exception $e) {}
        }

        parent::report($exception);
    }

    /**
     * @param Exception $exception
     */
    private function sentry(Exception $exception)
    {
        $sentry = app('sentry');

        if( Auth::check() ) {
            \Sentry\configureScope(function (Scope $scope): void {
                $scope->setUser([
                    'id'    => Auth::user()->id,
                    'name'  => Auth::user()->name,
                    'email' => Auth::user()->email
                ]);

            });
        }

        \Sentry\configureScope(function (Scope $scope): void {
            $scope->setExtra('ip', isset($_SERVER['REMOTE_ADDR']) ? $_SERVER['REMOTE_ADDR'] : null);
        });

        $sentry->captureException($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $exception
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $exception)
    {
        return parent::render($request, $exception);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param AuthenticationException $exception
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    protected function unauthenticated($request, AuthenticationException $exception)
    {
        return $request->expectsJson()
            ? response()->json(['message' => $exception->getMessage()], 401)
            : redirect()->guest($exception->redirectTo() ?? '/');
    }


    /*
    protected function renderJsonHttpException(HttpException $exception)
    {
        return response()->json([
            'status'    => $exception->getStatusCode(),
            'error'     => $exception->getMessage()
        ], $exception->getStatusCode(), $exception->getHeaders());
    }


    protected function prepareResponse($request, Exception $e)
    {
        if ($this->isHttpException($e)) {
            if( $request->expectsJson() )
                return $this->toIlluminateResponse($this->renderJsonHttpException($e), $e);
            else
                return $this->toIlluminateResponse($this->renderHttpException($e), $e);
        } else {
            return $this->toIlluminateResponse($this->convertExceptionToResponse($e), $e);
        }
    }
    */
}
