@extends('partials.admin_nav')

@section('content')

  <h1 class="brand-header">貸出一覧</h1>
  <div class="btn-wrapper">
    <a href="#" class="btn">貸出物の検索</a>
    <a class="btn btn-success" href="{{ route('admin.rent.create') }}">貸出物の登録</a>
  </div>
  <div class="content-wrapper">
    <table class="table table-hover">
      <thead>
        <tr>
          <th>貸出物名</th>
          <th>種類</th>
          <th>状態</th>
          <th>貸出者</th>
        </tr>
      </thead>
      <tbody>
      @foreach($items as $item)
        <tr>
          <td>{{ $item->name }}</td>
          <td>{{ $item->item_category_id }}</td>
          <td>状態</td>
          <td>user_name</td>
          <td><a class="btn btn-success" href="#">詳細</a></td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>

  <div class="bottom-btn-wrapper">
    <a href="{{ route('admin.home') }}" class="bottom-button">ホームへ</a>
  </div>
@endsection