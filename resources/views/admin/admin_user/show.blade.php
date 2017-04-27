@extends('partials.admin_nav')

@section('content')

    <h2 class="page-header header-gradient">管理者ユーザー詳細情報</h2>

    <div class="button-wrapper">   
        <a class="button" href="{{ route('admin.adminuser.edit', $adminuser->id) }}">編集</a>
        <a class="button-danger btn" type="submit">この管理者ユーザーを削除する</a>
      {!! Form::close() !!}
    </div>

  <div class="container">
  <ul class="list-group list-group">
    <li class="list-group-item list-group-item-info">
      ユーザー名
    </li>
    <li class="list-group-item">
      {{ $adminuser->name }}
    </li>
    <li class="list-group-item list-group-item-info">
      性
    </li>
    <li class="list-group-item">
      {{ $adminuser->info->last_name }}
    </li>
    <li class="list-group-item list-group-item-info">
      名
    </li>
    <li class="list-group-item">
      {{ $adminuser->info->first_name }}
    </li>
    <li class="list-group-item list-group-item-info">
      性別
    </li>
    <li class="list-group-item">
      {{ $adminuser->info->sex }}
    </li>
    <li class="list-group-item list-group-item-info">
      生年月日
    </li>
    <li class="list-group-item">
      {{ date("Y/m/d", strtotime($adminuser->info->birthday)) }}
    </li>
    <li class="list-group-item list-group-item-info">
      メールアドレス
    </li>
    <li class="list-group-item">
      {{ $adminuser->info->email }}
      <p class="pull-right"><a href="{{ route('admin.adminuser.mailedit', $adminuser->id) }}">メールアドレスの変更はこちら</a></p>
    </li>
    <li class="list-group-item list-group-item-info">
      電話番号
    </li>
    <li class="list-group-item">
      {{ $adminuser->info->tel }}
    </li>
    <li class="list-group-item list-group-item-info">
      管理者権限
    </li>
    <li class="list-group-item">
      {{ $adminuser->privileges == 1? 'スーパーアドミン': 'アドミン' }}
    </li>
  </ul>
</div>
<div class="col-md-offset-5">
    <a href="{{ route('admin.user.index') }}" class="button">管理者ユーザー一覧画面へ</a>
</div>
@endsection
