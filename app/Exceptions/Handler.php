<?php

namespace App\Exceptions;

use App\Api\Helpers\ExceptionReport;
use Exception;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;

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
     * @param  \Exception  $exception
     * @return void
     *
     * @throws \Exception
     */
    public function report(Exception $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $exception
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @throws \Exception
     */
    public function render($request, Exception $exception)
    {
        //ajax请求我们才捕捉异常
        if ($request->ajax()){
            // 将方法拦截到自己的ExceptionReport
            $reporter = ExceptionReport::make($exception);
            if ($reporter->shouldReturn()){
                return $reporter->report();
            }
            if(env('APP_DEBUG')){
                //开发环境，则显示详细错误信息
                return parent::render($request, $exception);
            }else{
                //线上环境,未知错误，则显示500
                return $reporter->prodReport();
            }
        }

        return parent::render($request, $exception);
    }
}
