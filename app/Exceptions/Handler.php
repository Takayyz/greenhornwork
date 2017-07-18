<?php

namespace App\Exceptions;

use Exception;
use Symfony\Component\HttpKernel\Exception as Errors;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\Exceptions\PostTooLargeException;
use Illuminate\Session\TokenMismatchException;
use Illuminate\Validation\ValidationException;

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
      //ログインしていない状態でログインが必要なページにアクセスした場合の処理
      if($exception instanceof AuthenticationException) {
        return parent::render($request, $exception);
      }

      //POSTでデータ送信をした際に、post_max_sizeを超えた場合の処理
      if($exception instanceof PostTooLargeException) {
        $errMsg = 'ファイルサイズ超過です。2MB以内で投稿してください。';
        return back()->with('error', $errMsg);
      }

      //セッションのトークンとフォームのトークンが合わない場合の処理
      if($exception instanceof TokenMismatchException) {
        return redirect('/');
      }

      if($exception instanceof ValidationException){
        return parent::render($request, $exception);
      }

      //その他の例外が発生した場合の処理
      return $this->otherException($exception);
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

    protected function otherException($exception)
    {
      //各ステータスコードに沿ったメッセージ
      $MESSAGES = [
        400 => 'Bad Request',
        401 => '認証に失敗しました',
        403 => 'アクセス権がありません',
        404 => 'ページが見つかりません',
        405 => 'アクセス権がありません',
        408 => 'タイムアウトです',
        414 => 'リクエストURIが長過ぎます',
        500 => 'Internal Server Error',
        503 => 'Service Unavailable'
      ];

      //上記ステータスコード以外、ステータスコードが存在しない場合に使用するメッセージ
      $MESSAGE_UNEXPECTED = "予期しないエラーが起きました。管理者に連絡して下さい";

      $statusCode = "";

      if(method_exists($exception, 'getStatusCode')) {
        $statusCode = $exception->getStatusCode();
      }

    //   $error_message = $MESSAGES[$statusCode] ?? $MESSAGE_UNEXPECTED;
      if(isset($MESSAGES[$statusCode]))
        $error_message = $MESSAGES[$statusCode];
      else
        return parent::render($request, $exception);

      //　viewに渡すデータを入力
      $data = [
        'exception' => $exception,
        'error_message' => $error_message
      ];

      return response(view('errors.common', $data));

    }

}
