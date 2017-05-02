@extends('partials.admin_nav')

@section('content')

    <h2 class="page-header header-gradient">管理者ユーザー詳細情報</h2>

    <div class="button-wrapper">
      {!! Form::open(['route' => ['admin.adminuser.destroy', $adminuser->id], 'method' => 'DELETE']) !!}
        <a class="button" href="{{ route('admin.adminuser.edit', $adminuser->id) }}">編集</a>
        <button class="button-danger btn" type="submit">削除</button>
      {!! Form::close() !!}
    </div>

  <div class="container">
  <ul class="list-group list-group">
    <ul class="user-info-list">

      <li>
        <div class="profile icon"></div>
        <h3>ユーザー名</h3>
        {{ $adminuser->name }}
      </li>

    <li>
        <div class="profile icon"></div>
        <h3>苗字</h3>
        {{ $adminuser->info->last_name }}
      </li>

    <li>
        <div class="profile icon"></div>
        <h3>名前</h3>
        {{ $adminuser->info->first_name}}
      </li>

    <li>
        <div class="profile icon"></div>
        <h3>性別</h3>
        {{$adminuser->info->sex}}
      </li>

    <li>
        <div class="profile icon"></div>
        <h3>誕生日</h3>
        {{date("Y/m/d", strtotime($adminuser->info->birthday))}}
      </li>

    <li>
        <div class="profile icon"></div>
        <h3>メールアドレス</h3>
        {{$adminuser->info->email}}
      </li>
  
    <!--   <p class="pull-right"><a href="{{ route('admin.adminuser.mailedit', $adminuser->id) }}">メールアドレスの変更はこちら</a></p> -->

   <li>
        <div class="profile icon"></div>
        <h3>電話番号</h3>
        {{$adminuser->info->tel}}
    </li>

    <li>
      <div class="profile icon"></div>
      <h3>管理者権限</h3>
      {{ $adminuser->privileges == 1? 'スーパーアドミン': 'アドミン' }}
    </li>
  </ul>
</div>
<div class="bottom-button-wrapper">
    <a href="{{ route('admin.user.index') }}" class="button">管理者ユーザー一覧画面へ</a>
</div>
@endsection
