@extends('partials.admin_nav')

@section('content')
<h2 class="page-header header-gradient">{{ $store->name }}</h2>
<div class="container">
<table class="table table-hover todo-table">
  <thead>
  <tr>
    <th>研修生一覧</th>
    <th></th>
  </tr>
</thead>
  <tbody>
    @foreach($userList as $user)
    <tr>
      <td>{{ $user->last_name }}{{ $user->first_name }}</td>
      <td><a class="btn btn-success" href="{{ route('admin.user.show', $user->id) }}">詳細</a></td>
    </tr>
    @endforeach()
  </tbody>
</table>
<div class="col-md-offset-5">
 <div class="bottom-button-wrapper">
    <a href="{{ route('admin.store.index') }}" class="button">店舗一覧へ</a>
</div>
@endsection
