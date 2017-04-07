@extends('partials.admin_nav')

@section('content')
<div class="container">
    <h2 class="page-header">ユーザーの一覧</h2>
    <p class="pull-right"><a class="btn btn-success" href="{{ route('admin.user.create')}}">新規ユーザー作成</a></p>
    <table class="table table-hover todo-table">
        <thead>
        <tr>
            <th>性</th>
            <th>名</th>
            <th>性別</th>
            <th>メールアドレス</th>
            <th>電話番号</th>
            <th>開始日</th>
            <th>店舗名</th>
        </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
                <tr>
                    <td>{{ $user->first_name }}</td>
                    <td>{{ $user->last_name }}</td>
                    <td>{{ $user->sex }}</td>
                    <!-- <td>{{ $user->birthday }}</td> -->
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->tel }}</td>
                    <td>{{ $user->start_date }}</td>
                    <td>{{ $user->store_name }}</td>
                    <td></td>
                    <td></td>
                    <!--<td><a class="btn btn-primary" href="user/{{$user->id}}/edit">編集</a></td>-->

                    <td>
                        <a class="btn btn-primary" href="{{ route('admin.user.edit', $user->id) }}">編集</a>
                    </td>

                    {!! Form::open(['route'=>['admin.user.destroy',$user->id],'method'=>'DELETE']) !!}


                    <td><button class="btn btn-danger" type="submit">削除</button></td>

                    {!! Form::close() !!}
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
<div class="col-xs-12 col-md-offset-5">
    <a href="{{ route('admin.') }}" class="btn btn-primary">戻る</a>
</div>
@endsection