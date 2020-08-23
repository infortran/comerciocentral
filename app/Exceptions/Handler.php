<?php

namespace App\Exceptions;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
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
     * @param  \Throwable  $exception
     * @return void
     *
     * @throws \Exception
     */
    public function report(Throwable $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Throwable  $exception
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @throws \Throwable
     */
    public function render($request, Throwable $exception)
    {

        if (!$request->expectsJson() && $exception instanceof MethodNotAllowedHttpException) {
            return redirect('/');
        }
        if($exception instanceof ModelNotFoundException){
            return redirect('/');
        }
        if($this->isHttpException($exception)){
            switch($exception->getStatusCode()){
                case 404:
                    return redirect('/');
                    break;
                // internal error
                case 500:
                    return \Response::view('custom.500',array(),500);
                    break;

                default:
                    return $this->renderHttpException($exception);
                    break;
            }
        }
        return parent::render($request, $exception);
    }
}
