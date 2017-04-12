@extends('partials.admin_nav')

@section('content')
<div class="container">
  <h2 class="page-header">ユーザーの一覧</h2>
  <div class="col-xs-10"></div>
  <div class="col-xs-2">
    <a href="{{ route('admin.') }}" class="btn btn-primary">戻る</a>
  </div>

  <div class="search-box">
    <div class="inner-box">
      {!! Form::open(['route' => 'admin.user.search', 'method' => 'GET']) !!}
        <h3>ユーザー検索</h3>
        <div class="col-xs-12">
          <div class="col-xs-2">
            ユーザー名
          </div>
          <div class="col-xs-3">
            {!! Form::input('text', 'user_name', null, ['class' => 'form-control']) !!}　
          </div>
          <div class="col-xs-2">
            性別
          </div>
          <div class="col-xs-3">
            <div class="col-xs-6">
              <label>
                男性　{!! Form::input('radio', 'sex', '男') !!}　
              </label>
            </div>
            <div class="col-xs-6">
              <label>
                　女性　{!! Form::input('radio', 'sex', '女') !!}　
              </label>
            </div>
          </div>
        </div>

        <div class="col-xs-12">
          <div class="col-xs-2">
            姓
          </div>
          <div class="col-xs-3">
            {!! Form::input('text', 'last_name', null, ['class' => 'form-control', 'placeholder' => '姓']) !!}
          </div>
          <div class="col-xs-2">
            名
          </div>
          <div class="col-xs-3">
            {!! Form::input('text', 'first_name', null, ['class' => 'form-control', 'placeholder' => '名']) !!}
          </div>
        </div>

        <div class="col-xs-12">
          <div class="col-xs-2">
            生年月日
          </div>
          <div class="col-xs-3">
            始め　{!! Form::input('date', 'birthday-start-date', null, ['class' => 'form-control']) !!}　
          </div>　
          <div class="col-xs-2">
          </div>
          <div class="col-xs-3">
            終わり　{!! Form::input('date', 'birthday-end-date', null, ['class' => 'form-control']) !!}　
          </div>
        </div>

        <div class="col-xs-12">
          <div class="col-xs-2">
            メールアドレス
          </div>
          <div class="col-xs-3">
            {!! Form::input('text', 'email', null, ['class' => 'form-control', 'placeholder' => 'gizutech@gmail.com']) !!}
          </div>
          <div class="col-xs-2">
            電話番号
          </div>
          <div class="col-xs-3">
            {!! Form::input('text', 'tel', null, ['class' => 'form-control', 'placeholder' => '0312345678']) !!}
          </div>
        </div>

        <div class="col-xs-12">
          <div class="col-xs-2">
            開始日
          </div>
          <div class="col-xs-3">
            始め　{!! Form::input('date', 'hire_date-start-date', null, ['class' => 'form-control']) !!}　
          </div>　
          <div class="col-xs-2">
          </div>
          <div class="col-xs-3">
            終わり　{!! Form::input('date', 'hire_date-end-date', null, ['class' => 'form-control']) !!}　
          </div>
        </div>

        <div class="col-xs-12">
          <div class="col-xs-2">
            店舗名
          </div>
          <div class="col-xs-3">
            {!! Form::select('store_id', [null => 'Please Select'] + array_pluck($stores, 'name', 'id')) !!}
          </div>
        </div>

        <div class="col-xs-9"></div>
        <div class="col-xs-3">
          {!! Form::input('submit', '', 'ユーザー検索', ['class' => 'btn btn-primary']) !!}
        </div>
      {!! Form::close() !!}
    </div>
  </div>

  <p class="pull-right"><a class="btn btn-success" href="{{ route('admin.user.create')}}">新規ユーザー作成</a></p>
  <table class="table table-hover todo-table">
    <thead>
      <tr>
        <th>ユーザー名</th>
        <th>姓</th>
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
        @if($user->info->birthday)
          <td>{{ date("Y/m/d", strtotime($user->info->birthday)) }}</td>
        @else
          <td></td>
        @endif
        <td>{{ $user->info->email }}</td>
        <td>{{ $user->info->tel }}</td>
        @if($user->info->hire_date)
          <td>{{ date("Y/m/d", strtotime($user->info->hire_date)) }}</td>
        @else
          <td></td>
        @endif
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
@endsection
