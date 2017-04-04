@extends('layouts.app')

@section('content')
<div class="container">
  <p class="pull-right"><a href="{{ url('admin/user') }}">一覧に戻る</a></p>
  <div class="panel-heading">
    <h2>ユーザー詳細情報</h2>
  </div>
  <div class="panel-body">

      <div>
        <h3>性</h3>
        {{ $user->last_name }}
      </div>

      <div>
        <h3>名</h3>
        {{ $user->first_name}}
      </div>

      <div>
      <h3>性別</h3>
        {{ $user->sex }}
      </div>

      <div>
        <h3>メールアドレス</h3>
        {{ $user->email}}
      </div>

      <div>
        <h3>電話番号</h3>
        {{ $user->tel}}
      </div>

      <div>
        <h3>入社日</h3>
        {{ $user->birthday}}
      </div>

      <div>
        <h3>店舗名</h3>
        {{ $user->store->name}}
      </div>

      
  </div>
  <p class="pull-right"><a class="btn btn-primary" href="{{ $user->id }}/edit">編集</a></p>
</div>
@endsection