<?php

namespace App\Exceptions;

use Exception;
use Symfony\Component\HttpKernel\Exception as Errors;
use Illuminate\Auth\AuthenticationException;
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
        $error_message = $exception->getMessage();

        //  エラーかどうかを判断。。
        if(!$error_message) {
          $statusCode = $exception->getStatusCode();
          switch ($statusCode) {
              case 400:
                  $error_message = 'Bad Request';
                  break;
              case 401:
                  $error_message = '認証に失敗しました';
                  break;
              case 403:
                  $error_message = 'アクセス権がありません';
                  break;
              case 404:
                  $error_message = 'ページが見つかりません';
                  break;
              case 408:
                  $error_message = 'タイムアウトです';
                  break;
              case 414:
                  $error_message = 'リクエストURIが長すぎます';
                  break;
              case 500:
                  $error_message = 'Internal Server Error';
                  break;
              case 503:
                  $error_message = 'Service Unavailable';
                  break;
              default:
                  $error_message = '予期しないエラーが起きました。管理者に連絡して下さい';
                  break;
          }
        } else {
          //  問題が無ければ普通に処理。
          return parent::render($request, $exception);
        }

        //　viewに渡すデータをここで入力
        $data = [
          'exception' => $exception,
          'error_message' => $error_message
        ];

        //　errors直下にcommonファイルがあればそちらを使用。ここでエラーが全て処理される。
        if (view()->exists('errors.common')) {
          return response(view('errors.common', $data), $statusCode);
        }

        //  そのステータスコードに対応しているファイルが存在しているかどうか確認。例）404.blade.php
        if (view()->exists('errors.' . $statusCode)) {
          return response(view('errors.' . $statusCode, $data), $statusCode);
        }
        return parent::render($request, $exception);
    }

    /**
     * Convert an authentication exception into an unauthenticated response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Illuminate\Auth\Authenticati\onException  $exception
     * @return \Illuminate\Http\Response
     */
    protected function unauthenticated($request, AuthenticationException $exception)
    {
        if ($request->expectsJson()) {
            return response()->json(['error' => 'Unauthenticated.'], 401);
        }

        if(in_array('admin', $exception->guards())) {
          return redirect()->guest('admin/login');
        }

        return redirect()->guest('login');
    }

    /**
     * Create a Symfony response for the given exception.
     *
     * @param  \Exception  $e
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    protected function convertExceptionToResponse(Exception $e)
    {
        if (config('app.debug')) {
            return $this->renderExceptionWithWhoops($e);
        }

        return parent::convertExceptionToResponse($e);
    }

    /**
     * Render an exception using Whoops.
     *
     * @param  \Exception $e
     *
     * @return \Illuminate\Http\Response
     */
    protected function renderExceptionWithWhoops(Exception $e)
    {
        $whoops = new \Whoops\Run();
        $whoops->pushHandler(new \Whoops\Handler\PrettyPageHandler());

        return response()->make(
            $whoops->handleException($e),
            method_exists($e, 'getStatusCode') ? $e->getStatusCode() : 500,
            method_exists($e, 'getHeaders') ? $e->getHeaders() : []
        );
    }

    // protected function renderHttpException(HttpException $exception)
    // {
    //   $status = $e->getStatusCode();
    //   return response()->view("errors.common", compact('exception', 'status'));
    // }
}
