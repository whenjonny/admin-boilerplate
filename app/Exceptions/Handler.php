<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Session\TokenMismatchException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;

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
        if ($exception instanceof ServiceErrorException || $exception instanceof ExpireErrorException) {
            \Log::info('exception', array($exception->getMessage()));
            return true;
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
        /*
         * Redirect if token mismatch error
         * Usually because user stayed on the same screen too long and their session expired
         */
        if ($exception instanceof TokenMismatchException) {
            return redirect()->route('frontend.auth.login');
        }

        /*
         * All instances of GeneralException redirect back with a flash message to show a bootstrap alert-error
         */
        if ($exception instanceof GeneralException) {
            return redirect()->back()->withInput()->withFlashDanger($exception->getMessage());
        }

        /** 
         * Judge is api or not
         */
        $isApi = false;
        if($request->is('api/'.config('infyom.laravel_generator.api_prefix').'/*')) {
            $isApi = true;
        }
       
        /**
         * Service Error Exception
         */
        if ($exception instanceof ServiceErrorException) {
            if ($isApi || $request->ajax() || $request->wantsJson()) {
                return response()->json(error($exception->getMessage()));
            } else {
                return response()->view('errors.500', [ 'message' => $exception->getMessage() ], 500);
            }
        }
        /**
         * Expire Error Exception
         */
        if ($exception instanceof ExpireErrorException) {

            if ($isApi || $request->ajax() || $request->wantsJson()) {
                // login expire
                return response()->json(error($exception->getMessage(), [], 2));
            } else {
                return response()->view('errors.500', [ 'message' => $exception->getMessage() ], 500);
            }
        }

        if ($isApi) {
            return response()->json(error($exception->getMessage()));
        } else {
            return response()->view('errors.500', [ 'message' => $exception->getMessage() ], 500);
        }
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

        return redirect()->guest(route('frontend.auth.login'));
    }
}
