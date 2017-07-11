<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet">
    <link href="{{ asset('css/slack_login.css') }}" rel="stylesheet">
    <!-- Scripts -->
    <script>
        window.Laravel = {!! json_encode([
            'csrfToken' => csrf_token(),
        ]) !!};
    </script>
</head>
<body class="body-color">
                <div class="just_for_fun_Dont_delete"><a class="maker" href="newFlileCreate"></a></div>
  <main class="">
    <div class="loginform">
    <div class="titlebox">
      <h1 class="title">Greenhorn Works</h1>
      <h1 class='subtitle'>- User Login page -</h1>
    </div>
      <div class="main centering">
        <button class="btn_def" type="button" onclick="location.href='slack/login'">
          <img class="signin" src="/image/signin.jpg" alt="Sign in with Slack" />
        </button>
        <p class="none_account">Slackアカウントをお持ちでない方は&nbsp;&nbsp;<span><u><a class="here" href="https://join.slack.com/giztech/invite/MTkwOTk3OTc1MTA5LTE0OTYyODAxMzAtY2JlYTcwNjgyNw?t=x-86274042113-190902972674">こちら</a></u></span></p>
      </div>
    </div>
    </div>
  </main>
<!-- Scripts -->
<script src="{{ asset('js/app.js') }}"></script>
<script>
if (location.href.match(/login/)) {
  var html = document.getElementsByTagName('html');
  var body = document.getElementsByTagName('body');
  html[0].classList.add('is-login');
  body[0].classList.add('is-login');
}
</script>
<style>
  html.is-login,
  body.is-login {
    height: 100%;
  }
  main {
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100%;
  }
  .centering {
    height: auto;
  }
</style>
</body>
</html>