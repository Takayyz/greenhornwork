@extends('partials.admin_nav')

@section('content')

  <h2 class="page-header header-gradient">研修生一覧</h2>
  {!! Form::open(['route' => 'admin.user.index', 'method' => 'GET', 'class' => 'user-search clearfix']) !!}
<div class="button-wrapper">
  <a class="button" href="{{ route('admin.user.create')}}">研修生を追加</a>
  <a　class="button" href="#openModal">研修生を検索</a>
</div>

<div id="openModal" class="modalDialog">
  <div>
    <a href="#close" title="Close" class="close">X</a>
    <table class="search-table">
      <thead class="search-thead">
      </thead>
      <div class="modal-header">研修生を検索</div>
      <tbody class="search-tbody">
        <tr>
          <td class="search-td">
            <label>
              名前
            </label>
          </td>
          <td class="search-td">
            {!! Form::input('text', 'last_name', null, ['class' => 'form-control', 'placeholder' => '名字', 'id' => 'last_name']) !!}
          </td>
          <td class="search-td">
          </td>
          <td class="search-td">
            {!! Form::input('text', 'first_name', null, ['class' => 'form-control', 'placeholder' => '名', 'id' => 'first_name']) !!}
          </td>
        </tr>

        <tr>
          <td class="search-td">
            <label for="store_id">
              店舗名
            </label>
          </td>
          <td class="search-td">
            {!! Form::select('store_id', [null => '店舗選択'] + array_pluck($stores, 'name', 'id'), null, ['class' => 'form-control', 'id' => 'store_id']) !!}
          </td>
        </tr>

        <tr>
          <td class="search-td">
            <label>
              性別
            </label>
          </td>
          <td class="search-td">
            <label for="sex">
              男
            </label>
            {!! Form::input('radio','sex', '男', null, ['class' => 'form-control']) !!}
            <label for="sex">
              女
            </label>
            {!! Form::input('radio','sex', '女', null, ['class' => 'form-control']) !!}
          </td>
        </tr>

        <tr>
        <td class="search-td">
            <label for="hire_date-start-date">
              開始日
            </label>
          </td>
          <td class="search-td">
            {!! Form::date('hire_date-start-date', null, ['class' => 'form-control']) !!}
          </td>
          <td class="search-td">
          </td>
          <td class="search-td">
            {!! Form::date('hire_date-end-date', null, ['class' => 'form-control']) !!}
          </td>
        </tr>
      </tbody>

      <tfoot class="search-tfoot">
        <tr class="search-tr">
          <td colspan="5" class="search-td">
          <div class="search-buton-wrapper">
          {!! Form::input('submit', '', '検索', ['class' => 'btn btn-success']) !!}
          </div>
          </td>
        </tr>
      </tfoot>
    </table>
  {!! Form::close() !!}
  </div>
</div>

<div class="content-wrapper">
  <table class="table table-hover todo-table">
    <thead>
      <tr>
        <th>姓</th>
        <th>名</th>
        <th>性別</th>
        <th>開始日</th>
        <th>店舗名</th>
      </tr>
    </thead>
    <tbody>
    @foreach($users as $user)
      <tr>
        <td>{{ $user->info->last_name }}</td>
        <td>{{ $user->info->first_name }}</td>
        <td>{{ $user->info->sex}}</td>
        @if($user->info->hire_date)
          <td>{{ date("Y/m/d", strtotime($user->info->hire_date)) }}</td>
        @else
          <td></td>
        @endif
        <td>{{ $user->info->store->name }}</td>
        <td>
          <a class="btn btn-success" href="{{ route('admin.user.show', $user->id) }}">詳細</a>
        </td>
      </tr>
    @endforeach
  </tbody>
  </table>
</div>
<div class="bottom-button-wrapper">
    <a href="{{ route('admin.') }}" class="bottom-button">ホームへ</a>
</div>
@endsection
