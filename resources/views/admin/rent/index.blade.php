@extends('partials.admin_nav')

@section('content')

  <h1 class="brand-header">貸出物一覧</h1>
  <div class="btn-wrapper">
    <a href="#" class="btn">貸出物の検索</a>
    <a class="btn btn-success" href="{{ route('admin.rent.create') }}">貸出物の登録</a>
  </div>
  <div class="content-wrapper">
    <table class="table table-hover">
      <thead>
        <tr>
          <th>名称</th>
          <th>種類</th>
        </tr>
      </thead>
      <tbody>
      @foreach($items as $item)
        <tr>
          <td>{{ $item->name }}</td>
          <td>{{ $item->category->category }}</td>
          <td><a class="btn btn-success" href="{{ route('admin.rent.show', $item->id) }}">詳細</a></td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>

  <div class="bottom-btn-wrapper">
    <a href="{{ route('admin.home') }}" class="bottom-button">ホームへ</a>
  </div>
@endsection