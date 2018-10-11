<?php

namespace App\Exceptions;

use Auth;
use Exception;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\Response;
use Symfony\Component\Debug\Exception\FlattenException;
use Symfony\Component\HttpKernel\Exception\HttpException;

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
            } catch (Exception $e) {

            }
        }

        parent::report($exception);
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

    private function sentry(Exception $exception)
    {
        /**
         * @var \Raven_Client $sentry
         */
        $sentry = app('sentry');

        if( Auth::check() ) {
            $sentry->user_context([
                'id'    => Auth::user()->id,
                'name'  => Auth::user()->name,
                'email' => Auth::user()->email
            ]);
        }

        $sentry->extra_context([
            'ip'                => isset($_SERVER['REMOTE_ADDR']) ? $_SERVER['REMOTE_ADDR'] : null,
            'x-forwarded-for'   => isset($_SERVER['HTTP_X_FORWARDED_FOR']) ? $_SERVER['HTTP_X_FORWARDED_FOR'] : null
        ]);

        $sentry->captureException($exception);
    }


    /*
    protected function renderJsonHttpException(HttpException $exception)
    {
        return response()->json([
            'status'    => $exception->getStatusCode(),
            'error'     => $exception->getMessage()
        ], $exception->getStatusCode(), $exception->getHeaders());
    }
    */
/*
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
