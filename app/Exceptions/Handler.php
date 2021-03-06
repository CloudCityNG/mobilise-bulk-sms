<?php

namespace App\Exceptions;

use App\Lib\Mailer\LogEmail;
use Exception;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Session\TokenMismatchException;
use Illuminate\Support\Facades\Input;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

use Illuminate\Validation\ValidationException;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Symfony\Component\HttpKernel\Exception\HttpException;

class Handler extends ExceptionHandler
{

    /**
     * A list of the exception types that should not be reported.
     *
     * @var array
     */
    protected $dontReport = [
        'Symfony\Component\HttpKernel\Exception\HttpException',
        AuthorizationException::class,
        HttpException::class,
        ModelNotFoundException::class,
        ValidationException::class,

    ];

    /**
     * Report or log an exception.
     *
     * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
     *
     * @param  \Exception $e
     * @return void
     */
    public function report(Exception $e)
    {
        //.(new LogEmail())->genericEmail("EXCEPTION ENCOUNTERED", $e);
        return parent::report($e);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Exception $e
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $e)
    {
//        if ( $e instanceof PayPalConnectionException ) :
//            flash()->overlay("HTTP Connection Error. Please try again later");
//            return redirect()->to('user/credit-purchase');
//            //return response(view('errors.404'), 404);
//        endif;


        //register a notfoundhttpexception to show a 404 error page
        if ($e instanceof NotFoundHttpException) :
            return response(view('errors.404'), 404);
        endif;


        if ($e instanceof TokenMismatchException) :
            return redirect()->back()->withInput(Input::all())->withErrors(['form-request' => 'Form has expired. Please refresh and try again']);
        endif;


        if ($this->isHttpException($e)) {
            return $this->renderHttpException($e);
        } else {
            return parent::render($request, $e);
        }
    }

}
