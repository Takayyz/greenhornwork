@extends('partials.admin_nav')

@section('content')
<h2 class="page-header header-gradient">店舗一覧</h2>

<div class="button-wrapper">
<a class="button delete-margin" href="{{ url('admin/store/create') }}">店舗の登録</a>
</div>

<div class="content-wrapper">

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
          <a href="{{ route('admin.store.edit', $store->id) }}" type="submit" class="btn btn-success pull-right">
              店舗情報の編集
          </a>
      </td>
    </tr>
    @endforeach
  </tbody>
</table>
</div>
  <div class="bottom-button-wrapper">
    <a href="{{ route('admin.home') }}" class="bottom-button">ホームへ</a>
  </div>
</div>
@endsection
