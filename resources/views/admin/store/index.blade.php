@extends('partials.admin_nav')

@section('content')
<h2 class="page-header header-gradient">店舗一覧</h2>
<div class="container">
<table class="table table-hover todo-table">
  <thead>
  <tr>
    <th>店舗名</th>
    <th></th>
  </tr>
  </thead>
  <tbody>
    @foreach($stores as $store)
    <tr>
      <td>{{ $store->name }}</td>
      <td><a class="btn btn-success pull-right" href="{{ route('admin.store.show', $store->id)}}">研修生一覧</a></td>
      <td>
          <a href="{{ route('admin.store.edit', $store->id) }}" type ="submit" class="btn btn-success pull-right">
              店舗情報の編集
          </a>
      </td>
    </tr>
    @endforeach
  </tbody>
</table>
<div class="col-md-offset-5">
 <div class="bottom-button-wrapper">
    <a class="button" href="{{ url('admin/store/create') }}">新しい店舗の登録</a>
    <a href="{{ route('admin.') }}" class="bottom-button">ホームへ</a>
  </div>
</div>
</div>
@endsection
