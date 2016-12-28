<?php

namespace App\Exceptions;

use Exception;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that should not be reported.
     *
     * @var array
     */
    protected $dontReport = [
        HttpException::class,
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
        \Log::error($e);
//        dump($e);
        if (!$e instanceof NotFoundHttpException) {
//            dump(1);
//            dd();
            if (\Config::get('settings.environment') == 'production') {
                $data = [
                    'exception' => $e,
                    'url' => \Request::url(),
                    'method' => \Request::method()
                ];
                \Mail::send('emails.site_error', $data, function ($message) {
//            $message->from($email_app);
                    $message->to(\Config::get('settings.error_email'))->subject(\Config::get('settings.app_name') . ' Error');
                });
//        dd();
                \Log::info('Error Email sent to ' . \Config::get('settings.error_email'));
//                return Response::view('errors.500', array(), 500);
            }
        }

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
//        dump($e);
//        dump($e->getStatusCode());
//        dd();
        return parent::render($request, $e);
    }
}
