<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laravel</title>

    <link href="{{ asset('/css/app.css') }}" rel="stylesheet">

    <!-- Fonts -->
    <link href='//fonts.googleapis.com/css?family=Roboto:400,300' rel='stylesheet' type='text/css'>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <style>
        .todo-table td {
            vertical-align: middle !important;
        }
    </style>
</head>
<body>
<div class="container">
<h2 class="page-header">ユーザーの一覧</h2>
    <p class="pull-right"><a class="btn btn-success" href="/todo/create">新規ユーザー作成</a></p>
<table class="table table-hover todo-table">
    <thead>
    <tr>
        <th>名前</th>
        <th>メールアドレス</th>
        <th>電話番号</th>
        <th>権限</th>
        <th></th>
    </tr>
    </thead>
    <tbody>
    <tr>
        <td>ギズモ太郎</td>
        <td>gizumo@gmail.com</td>
        <td>080-2048-5741</td>
        <td>１</td>
        <td><a class="btn btn-info" href="">編集</a></td>
        <td><button class="btn btn-danger" type="submit">削除</button></td>
    </tr>
    </tbody>
</table>
</div>
<!-- Scripts -->
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.1/js/bootstrap.min.js"></script>
</body>
</html>