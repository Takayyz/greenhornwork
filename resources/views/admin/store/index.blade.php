@extends('partials.admin_nav')

@section('content')
<div class="container">
<h2 class="page-header">店舗一覧</h2>
<p class="pull-right"><a class="btn btn-success" href="{{ url('admin/store/create') }}">作成</a></p>
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
      <td><a class="btn btn-primary pull-right" href="{{ url('admin/store', $store->id)}}">研修生一覧</a></td>
      <td>
        {!! Form::open(['route' => ['store.destroy', $store->id], 'method' => 'DELETE']) !!}
          <button type ="submit" class="btn btn-danger pull-right">削除</button>
        {!! Form::close() !!}
      </td>
    </tr>
    @endforeach
  </tbody>
</table>
</div>
@endsection
