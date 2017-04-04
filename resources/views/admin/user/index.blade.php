@extends('partials.admin_nav')

@section('content')
<div class="container">
<h2 class="page-header">ユーザーの一覧</h2>
    <p class="pull-right"><a class="btn btn-success" href="{{ route('admin.user.create')}}">新規ユーザー作成</a></p>
<table class="table table-hover todo-table">
    <thead>
    <tr>
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

        <td>{{ $user->last_name }}</td>
        <td>{{ $user->first_name }}</td>
        <td>{{ $user->sex }}</td>
        <td>{{ date("Y/m/d", strtotime($user->birthday)) }}</td>
        <td>{{ $user->email }}</td>
        <td>{{ $user->tel }}</td>
        <td>{{ date("Y/m/d", strtotime($user->hire_date)) }}</td>
        <td>{{ $user->store->name }}</td>

        <td></td>
        <td></td>
        <!--<td><a class="btn btn-primary" href="user/{{$user->id}}/edit">編集</a></td>-->

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

@endsection