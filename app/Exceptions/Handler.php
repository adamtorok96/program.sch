<?php

namespace App\Exceptions;

use Auth;
use Exception;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\Response;
use Symfony\Component\Debug\Exception\FlattenException;

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
     * Report or log an exception.
     *
     * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
     *
     * @param  \Exception  $exception
     * @return void
     */
    public function report(Exception $exception)
    {
        if ( $this->shouldReport($exception) && app()->bound('sentry') ) {
            try {
                $this->sentry($exception);
            } catch (Exception $e) {}
        }

        if ( $this->isHttpException($exception) ) {
            return $this->renderHttpException($exception);
        }

        if( $exception instanceof AuthenticationException ) {
            return parent::report($exception);
        }

        if ( config('app.debug') ) {
            return $this->renderExceptionWithWhoops($exception);
        }

        parent::report($exception);
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
            'ip' => isset($_SERVER['REMOTE_ADDR']) ? $_SERVER['REMOTE_ADDR'] : null
        ]);

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
     * Convert an authentication exception into an unauthenticated response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Illuminate\Auth\AuthenticationException  $exception
     * @return \Illuminate\Http\Response
     */
    protected function unauthenticated($request, AuthenticationException $exception)
    {
        if ($request->expectsJson()) {
            return response()->json(['error' => 'Unauthenticated.'], 401);
        }

        return redirect()->guest('/');
    }

    /**
     * Render an exception using Whoops.
     *
     * @param  \Exception $exception
     * @return \Illuminate\Http\Response
     */
    protected function renderExceptionWithWhoops(Exception $exception)
    {
        $whoops = new \Whoops\Run;
        $whoops->pushHandler(new \Whoops\Handler\PrettyPageHandler());

        $fe = FlattenException::create($exception);

        return new Response(
            $whoops->handleException($exception),
            $fe->getStatusCode(),
            $fe->getHeaders()
        );
    }
}
