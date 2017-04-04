@extends('partials.admin_nav')

@section('content')
<div class="container">
<h2 class="page-header">管理者ユーザーの一覧</h2>
    <p class="pull-right"><a class="btn btn-success" href="{{ route('admin.adminuser.create') }}">新規ユーザー作成</a></p>
<table class="table table-hover todo-table">
    <thead>
    <tr>
        <th>性</th>
        <th>名</th>
        <th>性別</th>
        <th>生年月日</th>
        <th>メールアドレス</th>
        <th>電話番号</th>
    </tr>
    </thead>
    <tbody>
    @foreach($adminusers as $adminuser)
    <tr>

       <td>{{ $adminuser->info->last_name }}</td>
        <td>{{ $adminuser->info->first_name }}</td>
        <td>{{ $adminuser->info->sex }}</td>
        <td>{{ date("Y/m/d", strtotime($adminuser->info->birthday)) }}</td>
        <td>{{ $adminuser->info->email }}</td>
        <td>{{ $adminuser->info->tel }}</td>
       <td>
            <a class="btn btn-primary" href="{{ route('admin.adminuser.show', $adminuser->id) }}">詳細</a>
        </td>
        <td>
          {!! Form::open(['route' => ['admin.adminuser.destroy', $adminuser->id], 'method'=>'DELETE']) !!}
            <button class="btn btn-danger" type="submit">削除</button>
          {!! Form::close() !!}
        </td>
    </tr>
    @endforeach
</tbody>
</table>
</div>
@endsection
