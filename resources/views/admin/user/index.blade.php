@extends('partials.admin_nav')

@section('content')
<div class="container">
  <h2 class="page-header">ユーザーの一覧</h2>
  <p class="pull-right"><a class="btn btn-success" href="{{ route('admin.user.create')}}">新規ユーザー作成</a></p>
  <table class="table table-hover todo-table">
    <thead>
      <tr>
        <th>ユーザー名</th>
        <th>性</th>
        <th>名</th>
        <th>性別</th>
        <th>生年月日</th>
        <th>メールアドレス</th>
        <th>電話番号</th>
        <th>開始日</th>
        <th>店舗名</th>
      </tr>
    </thead>
    <tbody>
    @foreach($users as $user)
      <tr>   
      　　<td>{{ $user->name }}</td>
        <td>{{ $user->info->last_name }}</td>
        <td>{{ $user->info->first_name }}</td>
        <td>{{ $user->info->sex }}</td>
        <td>{{ date("Y/m/d", strtotime($user->info->birthday)) }}</td>
        <td>{{ $user->info->email }}</td>
        <td>{{ $user->info->tel }}</td>
        <td>{{ date("Y/m/d", strtotime($user->info->hire_date)) }}</td>
        <td>{{ $user->info->store->name }}</td> 
        <td>
          <a class="btn btn-primary" href="{{ route('admin.user.show', $user->id) }}">詳細</a>
        </td>
        <td>
          {!! Form::open(['route'=>['admin.user.destroy',$user->id],'method'=>'DELETE']) !!}
          <button class="btn btn-danger" type="submit">削除</button>
          {!! Form::close() !!}
        </td>
      </tr>
    @endforeach
  </tbody>
  </table>
</div>
<div class="col-xs-12 col-md-offset-5">
    <a href="{{ route('admin.') }}" class="btn btn-primary">戻る</a>
</div>
@endsection