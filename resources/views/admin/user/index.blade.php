@extends('partials.admin_nav')

@section('content')
<div class="container">
  <h2 class="page-header">ユーザーの一覧</h2>
  <div class="back-btn-box">
    <a href="{{ route('admin.') }}" class="btn btn-primary">戻る</a>
  </div>

  {!! Form::open(['route' => 'admin.user.search', 'method' => 'GET', 'class' => 'user-search clearfix']) !!}
    <table class="search-table">
      <thead class="search-thead">
        <tr>
          <h3 class="search-header">ユーザー検索</h3>
        </tr>
      </thead>
      <tbody class="search-tbody">
        <tr>
          <td class="search-td">
            <label for="user_name">
              ユーザー名
            </label>
          </td>
          <td></td>
          <td class="search-td">
            {!! Form::input('text', 'user_name', null, ['class' => 'form-control', 'placeholder' => 'ユーザー名', 'id' => 'user_name']) !!}　
          </td>
          <td colspan="2"></td>
        </tr>
        <tr>
          <td class="search-td">
            <label>
              性別
            </label>
          </td>
          <td></td>
          <td class="search-td left">
            <label>
              男性　{!! Form::input('radio', 'sex', '男') !!}
            </label>
            <label>
              　女性　{!! Form::input('radio', 'sex', '女') !!}　
            </label>
          </td>
          <td class="search-td">
          </td>
          <td></td>
        </tr>

        <tr>
          <td class="search-td">
            <label>
              姓名
            </label>
          </td>
          <td class="search-td">
            <label for="last_name">
              姓
            </label>
          </td>
          <td class="search-td">
            {!! Form::input('text', 'last_name', null, ['class' => 'form-control', 'placeholder' => '姓', 'id' => 'last_name']) !!}
          </td>
          <td class="search-td">
            <label for="first_name">
              名
            </label>
          </td>
          <td class="search-td">
            {!! Form::input('text', 'first_name', null, ['class' => 'form-control', 'placeholder' => '名', 'id' => 'first_name']) !!}
          </td>
        </tr>

        <tr>
          <td class="search-td">
            <label for="birthday-start-date">
              生年月日
            </label>
          </td>
          <td class="search-td">
            <label for="birthday-start-date">
              始め
            </label>
          </td>
          <td class="search-td">
            {!! Form::input('date', 'birthday-start-date', null, ['class' => 'form-control', 'id' => 'birthday-start-date']) !!}
          </td>
          <td class="search-td">
            <label for="birthday-end-date">
              終わり
            </label>
          </td>
          <td class="search-td">
            {!! Form::input('date', 'birthday-end-date', null, ['class' => 'form-control', 'id' => 'birthday-end-date']) !!}
          </td>
        </tr>

        <tr>
          <td class="search-td">
            <label for="email">
              メールアドレス
            </label>
          </td>
          <td></td>
          <td class="search-td">
            {!! Form::input('text', 'email', null, ['class' => 'form-control', 'placeholder' => 'gizutech@gmail.com', 'id' => 'email']) !!}
          </td>
        </tr>
        <tr>
          <td class="search-td">
            <label for="tel">
              電話番号
            </label>
          </td>
          <td></td>
          <td class="search-td">
            {!! Form::input('text', 'tel', null, ['class' => 'form-control', 'placeholder' => '0312345678', 'id' => 'tel']) !!}
          </td>
        </tr>

        <tr>
          <td class="search-td">
            <label for="hire_date-start-date">
              開始日
            </label>
          </td>
          <td class="search-td">
            <label for="hire_date-start-date">
              始め
            </label>
          </td>
          <td class="search-td">
            {!! Form::input('date', 'hire_date-start-date', null, ['class' => 'form-control', 'id' => 'hire_date-start-date']) !!}　
          </td>
          <td class="search-td">
            <label for="hire_date-end-date">
              終わり
            </label>
          </td>
          <td class="search-td">
            {!! Form::input('date', 'hire_date-end-date', null, ['class' => 'form-control', 'id' => 'hire_date-end-date']) !!}　
          </td>
        </tr>

        <tr>
          <td class="search-td">
            <label for="store_id">
              店舗名
            </label>
          </td>
          <td></td>
          <td class="search-td">
            {!! Form::select('store_id', [null => '店舗選択'] + array_pluck($stores, 'name', 'id'), null, ['class' => 'form-control', 'id' => 'store_id']) !!}
          </td>
        </tr>
      </tbody>

      <tfoot class="search-tfoot">
        <tr class="search-tr">
          <td colspan="5" class="search-td">
            {!! Form::input('submit', '', '検索', ['class' => 'btn btn-primary']) !!}
          </td>
        </tr>
      </tfoot>
    </table>
  {!! Form::close() !!}

  <p class="pull-right create-user-btn-box"><a class="btn btn-success" href="{{ route('admin.user.create')}}">新規ユーザー作成</a></p>
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
