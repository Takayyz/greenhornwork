@extends('partials.admin_nav')

@section('content')

  <h2 class="page-header header-gradient">研修生の詳細情報</h2>

  <div class="button-wrapper">
    {!! Form::open(['route'=>['admin.user.destroy',$user->id],'method'=>'DELETE']) !!}
      <a class="button" href="{{ $user->id }}/edit">編集</a>
      <button class="button-danger btn" type="submit">削除</button>      
    {!! Form::close() !!}
  </div>

  <div class="container">
    <ul class="user-info-list">
      <li>
        <div class="profile icon"></div>
        <h3>ユーザー名</h3>
        {{ $user->name }}
      </li>
      
      <li>
        <div class="profile icon"></div>
        <h3>苗字</h3>
        {{ $user->info->last_name }}
      </li>   

      <li>
        <div class="profile icon"></div>
        <h3>名前</h3>
        {{ $user->info->first_name}}
      </li>
    
      <li>
        <div class="profile icon"></div>
        <h3>性別</h3>
        {{$user->info->sex}}
      </li>
        
      <li>
        <div class="profile icon"></div>
        <h3>誕生日</h3>
        {{date("Y/m/d", strtotime($user->info->birthday))}}
      </li>

      <li>
        <div class="profile icon"></div>
        <h3>メールアドレス</h3>
        {{$user->info->email}}
      </li>
  
      <li>
        <div class="profile icon"></div>
        <h3>電話番号</h3>
        {{$user->info->tel}}
      </li>

      <li>
        <div class="profile icon"></div>
        <h3>入社日</h3>
        {{date("Y/m/d", strtotime($user->info->hire_date))}}
      </li>
  
      <li>
        <div class="profile icon"></div>
        <h3>店舗名</h3>
        {{$user->info->store->name}}
      </li>
    </ul>
  </div>
  <div class="bottom-button-wrapper">
    <a href="{{ route('admin.home') }}" class="bottom-button">ホームへ</a>
  </div>
@endsection